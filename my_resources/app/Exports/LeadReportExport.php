<?php
  
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\DailyTherapistVisitTransection;
use App\Models\PatientsTreatments;
use DB;
class LeadReportExport implements FromView,WithColumnFormatting
{
    protected $id;

    function __construct($sort_by,$sort_type,$month,$year,$query,$per_page) {
            $this->sort_by = $sort_by;
            $this->sort_type = $sort_type;
            $this->month = $month;
            $this->year = $year;
            $this->query = $query;
            $this->per_page = $per_page;
     }
    public function view(): View
    {
            $home_visit =  DailyTherapistVisitTransection::selectRaw('(SELECT count(DISTINCT o1.patient_id) as total_patient FROM daily_therapist_visit_transection as o1 left join patients_treatments as pi on pi.id= o1.patients_treatments_id WHERE (o1.is_attend = 1 and pi.visit_type = 1 and DATE_FORMAT(o1.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(o1.treatment_date, "%Y") = "'.$this->year.'")) as total_patient,SUM(case when pt.visit_type = 1 then 1 else 0 end) as home_visit,SUM(case when pt.visit_type = 2 then 1 else 0 end) as hospital_visit,SUM(case when pt.visit_type = 3 then 1 else 0 end) as clinic_visit,SUM(case when pt.visit_type = 1 then therapy_final_amount else 0 end) as home_final_amount,SUM(case when pt.visit_type = 2 then therapy_final_amount else 0 end) as hospital_final_amount,SUM(case when pt.visit_type = 3 then therapy_final_amount else 0 end) as clinic_final_amount')
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$this->year.'"')
            //->groupBy('daily_therapist_visit_transection.therapist_id')
           // ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 
            
        $hospital_visit = DailyTherapistVisitTransection::selectRaw('(SELECT count(DISTINCT o1.patient_id) as total_patient FROM daily_therapist_visit_transection as o1 left join patients_treatments as pi on pi.id= o1.patients_treatments_id WHERE (o1.is_attend = 1 and pi.visit_type = 2 and pi.hospital_id = pt.hospital_id  and DATE_FORMAT(o1.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(o1.treatment_date, "%Y") = "'.$this->year.'")) as total_patient,pt.hospital_id,h.name as hospital_name,count(pt.hospital_id) as hos_visit,SUM(case when pt.visit_type = 2 then therapy_final_amount else 0 end) as hospital_final_amount')
            
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            ->leftjoin("master_hospitals as h","h.id","=","pt.hospital_id")
            ->leftjoin("master_clinics as c","c.id","=","pt.clinic_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('pt.visit_type = 2 and daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$this->year.'"')
            ->groupBy('pt.hospital_id')
            //->groupBy('pt.clinic_id')
           // ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 
          //prd($hospital_visit);
          $clinic_visit = DailyTherapistVisitTransection::selectRaw('(SELECT count(DISTINCT o1.patient_id) as total_patient FROM daily_therapist_visit_transection as o1 left join patients_treatments as pi on pi.id= o1.patients_treatments_id WHERE (o1.is_attend = 1 and pi.visit_type = 3 and pi.clinic_id = pt.clinic_id  and DATE_FORMAT(o1.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(o1.treatment_date, "%Y") = "'.$this->year.'")) as total_patient,pt.clinic_id,c.name as clinic_name,count(pt.clinic_id) as clinic_visit,SUM(case when pt.visit_type = 3 then therapy_final_amount else 0 end) as clinic_final_amount')
            
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            ->leftjoin("master_hospitals as h","h.id","=","pt.hospital_id")
            ->leftjoin("master_clinics as c","c.id","=","pt.clinic_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('pt.visit_type = 3 and daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$this->year.'"')
            //->groupBy('pt.hospital_id')
            ->groupBy('pt.id')
           // ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 

            $online_session = DailyTherapistVisitTransection::selectRaw('(SELECT count(DISTINCT o1.patient_id) as total_patient FROM daily_therapist_visit_transection as o1 left join patients_treatments as pi on pi.id= o1.patients_treatments_id WHERE (o1.is_attend = 1 and pi.visit_type = 3 and DATE_FORMAT(o1.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(o1.treatment_date, "%Y") = "'.$this->year.'")) as total_patient,pt.clinic_id,c.name as clinic_name,count(pt.clinic_id) as clinic_visit,SUM(case when pt.visit_type = 3 then therapy_final_amount else 0 end) as clinic_final_amount')
            
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            ->leftjoin("master_hospitals as h","h.id","=","pt.hospital_id")
            ->leftjoin("master_clinics as c","c.id","=","pt.clinic_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('pt.visit_type = 3 and daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$this->month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$this->year.'"')
            //->groupBy('pt.hospital_id')
            ->groupBy('pt.id')
           // ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 
            
        return view('admin.reports.lead_report.export', [
            'home_visit' => $home_visit,
            'hospital_visit' => $hospital_visit,
            'clinic_visit' => $clinic_visit,
            'online_session' => $online_session,
            'month' => $this->month,
            'year' => $this->year,
            
        ]);
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            
            
        ];
    }
}
?>