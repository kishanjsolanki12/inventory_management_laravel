<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

use App\Models\CompanyPayout;
use App\Models\PatientInvoices;
use App\Models\DailyTherapistVisitTransection;
use App\Models\Attendence;
use App\Models\AssignPatientToTherapist;
use App\Models\PayoutTherapist;
use App\Models\PatientTherapyCharges;
use App\Models\Area;
use App\Models\PayoutLeadProvider;
use App\Models\PhysiocareVisitCount;
use App\Models\Therapist;
use App\Models\MissingDailyVisit;

use Illuminate\Support\Facades\Storage;


use Maatwebsite\Excel\Facades\Excel;
//use Storage;
use File;
use DB;
use Auth;
use Mail;
use Illuminate\Http\Request;
//require __DIR__ . '/vendor/autoload.php';

use phpseclib\Net\SFTP;


class CronController extends Controller
{   

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

        /* $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);

         $this->middleware('permission:product-create', ['only' => ['create','store']]);

         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:product-delete', ['only' => ['destroy']]);*/

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()
    {

       $reportData = DailyTherapistVisitTransection::select(DB::raw("SUM(case when ap.visit_status = 1 then 1 else 0 end) as total_running_visit"))
                    ->leftjoin("user_store_addresses","user_store_addresses.id","=","orders.store_address_id")
                    ->leftjoin("status_type","status_type.id","=","orders.status")
                    ->leftjoin("country as c1","c1.id","=","orders.delivery_country")
                    ->leftjoin("currency","currency.id","=","orders.currency")
        ->where('orders.is_yusen_confirm','1') 
        ->orderBy('orders.id','asc')
        ->whereRaw('YEAR(orders.planned_ship_date) = YEAR(CURDATE())')
        ->paginate(500);
       $status = StatusType::where("id",">","1")->get();
        return view('order.index', ['orders' => $orders,'status' => $status]);

    }
    public function patient_monthly_package_invoice()
    {
        $month = date("m",strtotime("-1 month"));
        $year = ($month == '12')?date("Y")-1:date("Y");
        $daily_visit = DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,d.therapist_id,SUM(IF(daily_therapist_visit_transection.is_attend = 1, 1, 0)) AS total_visit,pt.package_type,pt.week_days,pt.starting_date")
        ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
        ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
        ->orderBy('daily_therapist_visit_transection.id','desc')
        ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and (pt.package_type = 2 or pt.package_type = 3 or pt.package_type = 4)')
        ->groupBy('daily_therapist_visit_transection.patients_treatments_id')
        ->get();
        //prd($daily_visit);
        if(!empty($daily_visit))
        {
            
            foreach ($daily_visit as $row) {
                $package_type = ($row->package_type == 1 && $row->package_type == 5)?'2':'1';
                $month = date('m',strtotime($row->treatment_date));
                $year = date('Y',strtotime($row->treatment_date));
                $cur_month = date('m');
                $cur_year = date('Y');
               
                    
                    $therapy_package_charge = PatientTherapyCharges::where('patient_treatment_id',$row->patients_treatments_id)->where('patient_id',$row->patient_id)->where('therapy_id','8')->first();
                     
                    $patient_invoice = PatientInvoices::selectRaw("patient_invoices.*")
                      ->where('patient_invoices.month',$month)
                      ->where('patient_invoices.year',$year)
                      ->where('patient_invoices.patient_id',$row->patient_id)
                      ->first();
                    $package_amount = '0';
                    $start_date = $row->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    if($row->week_days == 2)
                    {
                      $total_day = '13';
                    }
                    if($row->week_days == 3)
                    {
                      $total_day = '11';
                    }
                    
                    if($row->package_type == '2')//30days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
                      if($row->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($row->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      if($row->week_days == 1)
                      {
                        $total_day = '30';
                      }
                        $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$row->total_visit), 2, '.', '');
                    }
                    if($row->package_type == '3')//15days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 15 days'));
                      if($row->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      else if($row->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($row->week_days == 1)
                      {
                        $total_day = '15';
                      }
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$row->total_visit), 2, '.', '');
                    }
                    if($row->package_type == '4')//10days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 10 days'));
                      if($row->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($row->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($row->week_days == 1)
                      {
                        $total_day = '10';
                      }
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$row->total_visit), 2, '.', '');
                    }
                    $final_amount = $package_amount;
                     
                  if(!empty($patient_invoice))
                  {
                    
                    $insert_invoice= array(
                    "patient_id" => $row->patient_id,
                    "month" => $month,
                    "year" => $year,
                    "package_type" => $package_type,
                    "package_visit" => $row->total_visit,
                    "package_amount" => $day_amount,
                    "package_total_amount" => $patient_invoice->package_amount + $final_amount,
                    "final_amount" => !empty($final_amount)?($patient_final_amount + $final_amount):'0',
                    "updated_by" => auth()->id(),
                    "updated_at" => date('Y-m-d H:i:s'),
                  );
                    pr($insert_invoice);
                    //update
                PatientInvoices::where('patient_invoices.month',$month)
                  ->where('patient_invoices.year',$year)
                  ->where('patient_invoices.patient_id',$row->patient_id)->update($insert_invoice);
                  }
                  else{
                    echo 'add';
                    $insert_invoice= array(
                      "patient_id" => $row->patient_id,
                      "month" => $month,
                      "year" => $year,
                      "package_type" => $package_type,
                      "package_visit" => $row->total_visit,
                      "package_amount" => $day_amount,
                      "package_total_amount" => $final_amount,                      
                      "final_amount" => !empty($final_amount)?($patient_final_amount + $final_amount):'0',
                      "created_by" => auth()->id(),
                      "created_at" => date('Y-m-d H:i:s'),
                    );
                     pr($insert_invoice);
                    //add
                    PatientInvoices::create($insert_invoice);
                  }
            }
        }
    }
    public function lead_provider_commision_package()
    {
        $month = date("m",strtotime("-1 month"));
        $year = ($month == '12')?date("Y")-1:date("Y");
        $daily_visit = DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,pt.lead_provider_id,pt.is_commision,pt.commision_percentage")
        ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
        ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
        ->orderBy('daily_therapist_visit_transection.id','desc')
        ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and (pt.package_type = 2 or pt.package_type = 3 or pt.package_type = 4)')
        ->get();
        
        if(!empty($daily_visit))
        {
        $cur_month = date('m');
        $cur_year = date('Y');
        foreach ($daily_visit as $row) 
        {
         $month = date('m',strtotime($row->treatment_date));
         $year = date('Y',strtotime($row->treatment_date));
         $lead_provider_id = $row->lead_provider_id;
         $is_commision = $row->is_commision;
         $commision_percentage = $row->commision_percentage;

         $package_type = ($row->package_type == 1 && $row->package_type == 5)?'2':'1';
         
          $payout_to_lead_provider = PayoutLeadProvider::selectRaw("payout_to_lead_provider.*")
          ->where('payout_to_lead_provider.month',$month)
          ->where('payout_to_lead_provider.year',$year)
          ->where('payout_to_lead_provider.lead_provider_id',$row->lead_provider_id)
          ->first();

          /*$therapy_charge = AssignPatientToTherapist::where('patient_id',$row->patient_id)->where('patient_treatement_id',$row->patients_treatments_id)->where('therapist_id',$row->therapist_id)->orderBy('id','desc')->first();*/

          //prd($payout_to_lead_provider);
          
          if(!empty($payout_to_lead_provider))
          {
              if(!empty($row->is_attend) && !empty($is_commision))
              {
                $patient_charge = !empty($row->therapy_final_amount)?$row->therapy_final_amount:'0';
                $lead_provider_commision = ($patient_charge*$row->commision_percentage)/100;
                 $insert_invoice= array(
                    "payout_type"=>'1',
                    "lead_provider_id" => $row->lead_provider_id,
                    "month" => $month,
                    "year" => $year,
                    "amount"=> $payout_to_lead_provider->amount + $lead_provider_commision,
                    "updated_by" => auth()->id(),
                    "updated_at" => date('Y-m-d H:i:s'),
                  );
                // prd( $insert_invoice);
                PayoutLeadProvider::where('payout_to_lead_provider.month',$month)
                ->where('payout_to_lead_provider.year',$year)
                ->where('payout_to_lead_provider.therapiest_id',$row->therapiest_id)->update($insert_invoice);
              }
              
          }
          else
          {
              if(!empty($row->is_attend) && !empty($is_commision))
              {
                $patient_charge = !empty($row->therapy_final_amount)?$row->therapy_final_amount:'0';
                $lead_provider_commision = ($patient_charge*$row->commision_percentage)/100;
                 $insert_invoice= array(
                    "payout_type"=>'1',
                    "lead_provider_id" => $row->lead_provider_id,
                    "month" => $month,
                    "year" => $year,
                    "amount"=>  $lead_provider_commision,
                    "created_by" => auth()->id(),
                    "created_at" => date('Y-m-d H:i:s'),
                  );
                 //prd( $insert_invoice);
                 PayoutLeadProvider::create($insert_invoice);
              }
              
          }
        }
      }
    }
    public function lead_provider_commision_visit()
    {
        $month = date("m",strtotime("-1 month"));
        $year = ($month == '12')?date("Y")-1:date("Y");
        $daily_visit = DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,d.therapist_id,pt.lead_provider_id,pt.is_commision,pt.commision_percentage")
        ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
        ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
        ->orderBy('daily_therapist_visit_transection.id','desc')
        ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and (pt.package_type = 1 or pt.package_type = 5)')
        ->groupBy('daily_therapist_visit_transection.patients_treatments_id')
        ->get();
        //prd($daily_visit);
        if(!empty($daily_visit))
        {
        $cur_month = date('m');
        $cur_year = date('Y');
        foreach ($daily_visit as $row) 
        {
         $month = date('m',strtotime($row->treatment_date));
         $year = date('Y',strtotime($row->treatment_date));
         $lead_provider_id = $row->lead_provider_id;
         $is_commision = $row->is_commision;
         $commision_percentage = $row->commision_percentage;

         $package_type = ($row->package_type == 1 && $row->package_type == 5)?'2':'1';
         
          $payout_to_lead_provider = PayoutLeadProvider::selectRaw("payout_to_lead_provider.*")
          ->where('payout_to_lead_provider.month',$month)
          ->where('payout_to_lead_provider.year',$year)
          ->where('payout_to_lead_provider.lead_provider_id',$row->lead_provider_id)
          ->first();

          //prd($payout_to_lead_provider);
          
          if(!empty($payout_to_lead_provider))
          {
              if(!empty($row->is_attend) && !empty($is_commision))
              {
                $patient_charge = !empty($row->therapy_final_amount)?$row->therapy_final_amount:'';
                $lead_provider_commision = ($patient_charge*$row->commision_percentage)/100;
                 $insert_invoice= array(
                    "payout_type"=>'1',
                    "lead_provider_id" => $row->lead_provider_id,
                    "month" => $month,
                    "year" => $year,
                    "amount"=> $payout_to_lead_provider->amount + $lead_provider_commision,
                    "updated_by" => auth()->id(),
                    "updated_at" => date('Y-m-d H:i:s'),
                  );
                 //prd($insert_invoice);
                 PayoutLeadProvider::where('payout_to_lead_provider.month',$month)
              ->where('payout_to_lead_provider.year',$year)
              ->where('payout_to_lead_provider.lead_provider_id',$row->lead_provider_id)->update($insert_invoice);
              }
              
              
          }
          else
          {
              if(!empty($row->is_attend) && !empty($is_commision) && !empty($row->lead_provider_id))
              {
                $patient_charge = !empty($row->therapy_final_amount)?$row->therapy_final_amount:'';
                $lead_provider_commision = ($patient_charge*$row->commision_percentage)/100;
                 $insert_invoice= array(
                    "payout_type"=>'1',
                    "lead_provider_id" => $row->lead_provider_id,
                    "month" => $month,
                    "year" => $year,
                    "amount"=> $lead_provider_commision,
                    "created_by" => auth()->id(),
                    "created_at" => date('Y-m-d H:i:s'),
                  );
                 
                 PayoutLeadProvider::create($insert_invoice);
              }
              
              
          }
        }
      }
     
    }
    public function insert_area()
    {
        $area_array = array('Ahmedabad Airport','Ambawadi','Ambli','Ambli Bopal','Amraiwadi','Anand Nagar','Asarwa','Aslali','Astodia','Ayojan Nagar','Badarkha','Bagodara','Bahiyal','Bapunagar','Bardolpura','Barejadi','Bavla','Bayad','Behrampura','Bhadaj','Bhadiyad','Bhadra','Bhat','Bhatta','Bhojva','Bholad','Bodakdev','Bopal','Calico Mills','Chaloda','Chanakyapuri','Chandkheda','Chandlodiya','Changodar','Chekhla','Chharodi','Chiloda','CTM','D Colony','Dabhoda','Dahegam','Dani Limda','Dariapur','Daxini Society','Delhi Chakla','Delhi Darwaja','Detroj','Dholera','Dudheshwar','Ellis Bridge','Gandhi Ashram','Geratpur','Ghatlodiya','Gheekanta','Ghodasar','Ghuma','Gift City','Girdhar Nagar','Gita Mandir','Godhavi','Gokuldham','Gomtipur','Gota','Gulbai Tekra','Gurukul','Hansol','Hathijan','Hatkeshwar','Isanpur','Jagatpur','Jalila','Jamalpur','Janta Nagar','Jashoda Nagar','Jawahar Chowk','Jetalpur','Jivraj Park','Jodhpur','Juhapura','Juna Wadaj','Kabir Chowk','Kadi','Kalapi Nagar','Kali','Kalol','Kalupur','Kalyanpura','Kamiyala','Kankaria','Kathwada','Kauka','Keshav Nagar','Khadia','Khamasa','Khanpur','Kharna','Kheda','Khodiar Nagar','Khodiyar Nagar','Khokhra','Koba','Kolat','Kotarpur','Koteshwar','Kothgangad','Krishnanagar','Kuber Nagar','Kudasan','Kuha','Lal Darwaza','Lambha','Law Garden','Laxmanpura','Lothal Bhurhki','Madhupura','Mahadev Nagar','Mahudara','Makarba','Mandal','Manek Chowk','Maninagar','Maninagar East','Manipur','Mankol','Meghani Nagar','Memnagar','Mirzapur','Mithakhali','Moraiya','Motera','Nalsarovar','Nana Chiloda','Nandej','Nandol','Naranpura','Narayan Nagar','Naroda','Naroda GIDC','Narol','Narolgam','Nasmed','Nava Naroda','Nava Vadaj','Navarangpura Gam','Navjivan','Navrang Pura','Nehru Nagar','New Maninagar','New Ranip','Nikol','Nirnay Nagar','Noblenagar','Odhav','Odhav GIDC','Ognaj','Paldi','Palodia','Pankore Naka','Patthar Kuva','Pethapur','Prahlad Nagar','Prahlad Nagar Extension','Purshottam Nagar','Raikhad','Railway Colony','Raipur','Rakanpur','Rakhial','Ramdev Nagar','Rampura','Rancharda','Ranip','Ranna Park','Ranpur','Raska','Ratan Pol','Raysan','Revdi Bazar','Sabarmati','Sachana','Sadar Bazar','Saffrony','Saijpur Bogha','Sanand','Sanathal','Santej','Sarangpur','Saraspur','Sardar Colony','Sardar Nagar','Sargaasan','Sarkhej','Satadhar','Satellite','Satellite Extension','Satlasana','Science City','Shah E Alam Roja','Shahibaug','Shahpur','Shantipura','Sharda Nagar','Shastri Nagar','Shela','Shilaj','Shyamal','Sindhi Ambawadi','Sola','South Bopal','Subhash Bridge','Sughad','Sukhrampura','Tavdipura','Teen Darwaja','Thakkarbapa Nagar','Thaltej','Thol','Tragad','Unali','Urjanagar','Usmanpura','Vadaj','Vadsar','Vaishnodevi Circle','Vasna','Vastral','Vastrapur','Vatva','Vatva GIDC','Vavol','Vejalpur','Vejalpur Gam','Vinchhiya','Vinzol','Virochan Nagar','Visalpur','Wadaj');
        foreach($area_array as $ar)
        {
            $area = Area::where('area_name',$ar)->get()->toArray();
            pr($area);
            if(empty($area))
            {
                 $insert_data =  array(
                  'state_id' => '1',
                  'city_id' => '1',
                  'area_name' => $ar,
                  'created_date' => date('Y-m-d H:i:s'),
                  'created_by' => '1',
                  'status' => '1'
                );
                 pr($insert_data);
                Area::create($insert_data);
            }
            else
            {
              pr($ar);
            }
        }
          
      }

    public function physiocare_visit_count_insert()
    {
      $date = date('Y-m-d',strtotime("-1 days"));
      $therapists = Therapist::selectRaw("therapists.id,therapists.total_available_visit")->where('status','1')->where('is_deleted','0')->orderBy('id','desc')->get();
      if(!empty($therapists))
      {
        foreach($therapists as $row)
        {
            $therapist_visit = AssignPatientToTherapist::selectRaw('count(*) as visit')->where('therapist_id',$row->id)->where('visit_status','1')->first();

            $total_visit_count = !empty($therapist_visit->visit)?$therapist_visit->visit:'0';
            $total_t_visit_count = !empty($therapists->total_available_visit)?$therapists->total_available_visit:'8';
            $total_available_visit = ($total_t_visit_count >= $total_visit_count)?($total_t_visit_count - $total_visit_count):'0';
            $data =  array(
              'therapist_id' => $row->id,
              'total_visit_count' => $total_visit_count,
              'available_for_visit' => $total_available_visit,
              'date' =>$date
            );
            pr($data);
            $exist =PhysiocareVisitCount::selectRaw('id')->where('therapist_id',$row->id)->where('date',$date)->first();
            if(empty($exist))
            {
              PhysiocareVisitCount::create($data);
            }
            

        }
      }

    }
    public function insert_missing_daily_visit()
    {
       $missing_date = date('Y-m-d',strtotime("-2 days"));
       $missing_day = date('D',strtotime("-2 days"));
       $running_treatment = AssignPatientToTherapist::selectRaw('assign_patients_to_therapiest.*,pt.week_days,pt.package_type,pt.visit_time')->leftjoin("patients_treatments as pt","pt.id","=","assign_patients_to_therapiest.patient_treatement_id")->where('visit_status','1')->get();
        //prd($running_treatment);
      if(!empty($running_treatment))
      {
        $cur_month = date('m');
        $cur_year = date('Y');
        foreach ($running_treatment as $row) 
        {   

            $start_date = $row->starting_date;
            $end_date = $missing_date;
            $add = 0;
            if($row->week_days == 1)
            {
              $add = 1;
            }
            if($row->week_days == 2)
            {
              $total_day = '13';
              $days2 = array('Mon','Tue','Wed','Thu','Fri','Sat');
              if(in_array($missing_day,$days2))
              {
                $add = 1;
              }
            }
            if($row->week_days == 3)
            {
              $total_day = '11';
              $days3 = array('Mon','Tue','Wed','Thu','Fri');
              if(in_array($missing_day,$days3))
              {
                $add = 1;
              }
            }
            if($row->week_days == 4)
              {
               
                $days4 = array('Mon','Wed','Fri');
                if(in_array($missing_day,$days4))
                {
                  $add = 1;
                }
              }
              if($row->week_days == 5)
              {
               
                $days5 = array('Tue','Thu','Sat');
                  if(in_array($missing_day,$days5))
                  {
                    $add = 1;
                  }
              }
            
            if($row->package_type == '2')//30days monthly
            {
              $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
              
                $package_amount = '0';
            }
            if($row->package_type == '3')//15days monthly
            {
              $end_date = date('Y-m-d', strtotime($start_date. ' + 15 days'));
              
                $package_amount = number_format((float)($day_amount*$row->total_visit), 2, '.', '');
            }
            if($row->package_type == '4')//10days monthly
            {
              $end_date = date('Y-m-d', strtotime($start_date. ' + 10 days'));
              
              
            }
            if(!empty($add))
            {
              if($end_date >=  $missing_date)
              {
                $daily_therapist_visit_entry = DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.id")
                      ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
                      ->where('daily_therapist_visit_transection.therapist_id',$row->therapist_id)
                      ->where('daily_therapist_visit_transection.patient_id',$row->patient_id)
                      ->where('daily_therapist_visit_transection.patients_treatments_id',$row->patient_treatement_id)
                      ->where('daily_therapist_visit_transection.treatment_date',$missing_date)
                      ->where('daily_therapist_visit_transection.treatment_time',$row->visit_time)
                      ->first();
                  if(empty($daily_therapist_visit_entry))
                  {
                      $m_visit_entry = MissingDailyVisit::selectRaw("*")
                      ->where('missing_daily_visit.therapist_id',$row->therapist_id)
                      ->where('missing_daily_visit.patient_id',$row->patient_id)
                      ->where('missing_daily_visit.patients_treatments_id',$row->patient_treatement_id)
                      ->where('missing_daily_visit.treatment_date',$missing_date)
                      ->where('missing_daily_visit.treatment_time',$row->visit_time)
                      ->first();
                      if(empty($m_visit_entry))
                      {
                        $insert_data['therapist_id'] = $row->therapist_id;
                        $insert_data['patient_id'] = $row->patient_id;
                        $insert_data['patients_treatments_id'] = $row->patient_treatement_id;
                        $insert_data['treatment_date'] = $missing_date;
                        $insert_data['treatment_time'] = $row->visit_time;
                        pr($insert_data);
                        MissingDailyVisit::create($insert_data);
                      }
                      
                }
              }
            }
            
        }
      }
    }

}   