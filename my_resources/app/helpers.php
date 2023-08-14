<?php
function change_Datetime_Format($date,$format=''){
	if(!empty($format))
	{
		return date($format, strtotime($date));

	}
	else
	{
		//return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');    
		return date('d-m-Y h:i a', strtotime($date)); 	
	}
    
}
function change_Date_Format($date,$format=''){
    if(!empty($format))
    {
        return date($format, strtotime($date));

    }
    else
    {
        //return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');    
        return date('d-m-Y', strtotime($date));   
    }
    
}
function change_time_Format($time,$format=''){
    if(!empty($format))
    {
        return date($format, strtotime($time));

    }
    else
    {
        //return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');    
        return date('H:i A', strtotime($time));   
    }
    
}
    function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

   
    function prd($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        die;
    } 
     
        
    function add_patient_invoice($daily_visit_id,$update_type='',$old_therapy_type='',$old_therapy_amount='')
    {
      //echo $daily_visit_id;
      $daily_visit = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,pt.payment_collected_by")
      ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
      ->leftjoin("therapists as t","t.id","=","d.therapist_id")
      ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
       ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
      ->orderBy('daily_therapist_visit_transection.id','desc')
      ->where('pt.payment_collected_by','1')
      ->where('daily_therapist_visit_transection.id',$daily_visit_id)
      ->first();
      
      if(!empty($daily_visit))
      {
          $rp_count = 0;$ct_count = 0;$dn_count = 0;$fu_count = 0;$fc_count = 0;$ij_count = 0;$ms_count=0;
           $rp_amount = 0;$ct_amount = 0;$dn_amount = 0;$fu_amount = 0;$fc_amount = 0;$ij_amount = 0;$ms_amount=0;

          $rp_total_amount = 0;$ct_total_amount = 0;$dn_total_amount = 0;$fu_total_amount = 0;$fc_total_amount = 0;$ij_total_amount = 0;$ms_total_amount=0;
          $month = date('m',strtotime($daily_visit->treatment_date));
          $year = date('Y',strtotime($daily_visit->treatment_date));
          $package_type = ($daily_visit->package_type == 1 && $daily_visit->package_type == 5)?'2':'1';


          $patient_invoice = App\Models\PatientInvoices::selectRaw("patient_invoices.*")
          ->where('patient_invoices.month',$month)
          ->where('patient_invoices.year',$year)
          ->where('patient_invoices.patient_id',$daily_visit->patient_id)
          ->first();

          if(!empty($patient_invoice))
          {
            if(empty($update_type))
            {

               //echo 'add';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "patient_id" => $daily_visit->patient_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                //update
                 /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
              ->where('patient_invoices.year',$year)
              ->where('patient_invoices.patient_id',$daily_visit->patient_id)->update($insert_invoice);*/

            }
           else
           {
           // echo 'else';
              if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "patient_id" => $daily_visit->patient_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.patient_id',$daily_visit->patient_id)->update($insert_invoice);*/

                //check old entry change
              if(!empty($old_therapy_type) && !empty($old_therapy_amount))//update visit
              {
                echo 'here';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "patient_id" => $daily_visit->patient_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count-$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount-$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count-$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount-$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count-$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount-$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count-$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount-$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count-$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount-$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count-$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount-$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count-$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount-$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount - ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.patient_id',$daily_visit->patient_id)->update($insert_invoice);*/
              }

           }
              
          }
          else
          {
             $insert_invoice= array(
              "patient_id" => $daily_visit->patient_id,
              "month" => $month,
              "year" => $year,
              "package_type" => $package_type,
              "package_amount" => !empty($package_amount)?$package_amount:'',
              "rp_count" => ($daily_visit->therapy_id == 1)?'1':NULL,
              "rp_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "rp_total_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "ct_count" => ($daily_visit->therapy_id == 3)?'1':NULL,
              "ct_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "ct_total_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "dn_count" => ($daily_visit->therapy_id == 2)?'1':NULL,
              "dn_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "dn_total_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "fu_count" => ($daily_visit->therapy_id == 4)?'1':NULL,
              "fu_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fu_total_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fc_count" => ($daily_visit->therapy_id == 7)?'1':NULL,
              "fc_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "fc_total_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "ij_count" => ($daily_visit->therapy_id == 5)?'1':NULL,
              "ij_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ij_total_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ms_count" => ($daily_visit->therapy_id == 6)?'1':NULL,
              "ms_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "ms_total_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "final_amount" => !empty($daily_visit->therapy_final_amount)?$daily_visit->therapy_final_amount:'0',
              "created_by" => auth()->id(),
              "created_at" => date('Y-m-d H:i:s'),

            );
             //pr($insert_invoice);
            //add
            App\Models\PatientInvoices::create($insert_invoice);
          }
        
      }
    }
    function add_hospital_invoice($daily_visit_id,$update_type='',$old_therapy_type='',$old_therapy_amount='')
    {
      //echo $daily_visit_id;
      $daily_visit = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,pt.hospital_id,pt.payment_collected_by")
      ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
      ->leftjoin("therapists as t","t.id","=","d.therapist_id")
      ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
       ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
      ->orderBy('daily_therapist_visit_transection.id','desc')
      ->where('pt.payment_collected_by','2')
      ->where('daily_therapist_visit_transection.id',$daily_visit_id)
      ->first();
      
      if(!empty($daily_visit))
      {
          $rp_count = 0;$ct_count = 0;$dn_count = 0;$fu_count = 0;$fc_count = 0;$ij_count = 0;$ms_count=0;
           $rp_amount = 0;$ct_amount = 0;$dn_amount = 0;$fu_amount = 0;$fc_amount = 0;$ij_amount = 0;$ms_amount=0;

          $rp_total_amount = 0;$ct_total_amount = 0;$dn_total_amount = 0;$fu_total_amount = 0;$fc_total_amount = 0;$ij_total_amount = 0;$ms_total_amount=0;
          $month = date('m',strtotime($daily_visit->treatment_date));
          $year = date('Y',strtotime($daily_visit->treatment_date));
          $package_type = ($daily_visit->package_type == 1 && $daily_visit->package_type == 5)?'2':'1';


          $patient_invoice = App\Models\HospitalInvoices::selectRaw("hospital_invoices.*")
          ->where('hospital_invoices.month',$month)
          ->where('hospital_invoices.year',$year)
          ->where('hospital_invoices.hospital_id',$daily_visit->hospital_id)
          ->first();

          if(!empty($patient_invoice))
          {
            if(empty($update_type))
            {

               //echo 'add';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "hospital_id" => $daily_visit->hospital_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                //update
                 /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
              ->where('patient_invoices.year',$year)
              ->where('patient_invoices.hospital_id',$daily_visit->hospital_id)->update($insert_invoice);*/

            }
           else
           {
           // echo 'else';
              if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "hospital_id" => $daily_visit->hospital_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.hospital_id',$daily_visit->hospital_id)->update($insert_invoice);*/

                //check old entry change
              if(!empty($old_therapy_type) && !empty($old_therapy_amount))//update visit
              {
                echo 'here';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "hospital_id" => $daily_visit->hospital_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count-$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount-$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count-$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount-$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count-$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount-$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count-$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount-$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count-$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount-$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count-$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount-$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count-$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount-$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount - ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.hospital_id',$daily_visit->hospital_id)->update($insert_invoice);*/
              }

           }
              
          }
          else
          {
             $insert_invoice= array(
              "hospital_id" => $daily_visit->hospital_id,
              "month" => $month,
              "year" => $year,
              "package_type" => $package_type,
              "package_amount" => !empty($package_amount)?$package_amount:'',
              "rp_count" => ($daily_visit->therapy_id == 1)?'1':NULL,
              "rp_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "rp_total_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "ct_count" => ($daily_visit->therapy_id == 3)?'1':NULL,
              "ct_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "ct_total_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "dn_count" => ($daily_visit->therapy_id == 2)?'1':NULL,
              "dn_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "dn_total_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "fu_count" => ($daily_visit->therapy_id == 4)?'1':NULL,
              "fu_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fu_total_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fc_count" => ($daily_visit->therapy_id == 7)?'1':NULL,
              "fc_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "fc_total_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "ij_count" => ($daily_visit->therapy_id == 5)?'1':NULL,
              "ij_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ij_total_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ms_count" => ($daily_visit->therapy_id == 6)?'1':NULL,
              "ms_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "ms_total_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "final_amount" => !empty($daily_visit->therapy_final_amount)?$daily_visit->therapy_final_amount:'0',
              "created_by" => auth()->id(),
              "created_at" => date('Y-m-d H:i:s'),

            );
             //pr($insert_invoice);
            //add
            App\Models\HospitalInvoices::create($insert_invoice);
          }
        
      }
    }
    function add_clinic_invoice($daily_visit_id,$update_type='',$old_therapy_type='',$old_therapy_amount='')
    {
      //echo $daily_visit_id;
      $daily_visit = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,pt.clinic_id,pt.payment_collected_by")
      ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
      ->leftjoin("therapists as t","t.id","=","d.therapist_id")
      ->leftjoin("patients as p","p.id","=","daily_therapist_visit_transection.patient_id")
       ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
      ->orderBy('daily_therapist_visit_transection.id','desc')
      ->where('pt.payment_collected_by','3')
      ->where('daily_therapist_visit_transection.id',$daily_visit_id)
      ->first();
      if(!empty($daily_visit))
      {
          $rp_count = 0;$ct_count = 0;$dn_count = 0;$fu_count = 0;$fc_count = 0;$ij_count = 0;$ms_count=0;
           $rp_amount = 0;$ct_amount = 0;$dn_amount = 0;$fu_amount = 0;$fc_amount = 0;$ij_amount = 0;$ms_amount=0;

          $rp_total_amount = 0;$ct_total_amount = 0;$dn_total_amount = 0;$fu_total_amount = 0;$fc_total_amount = 0;$ij_total_amount = 0;$ms_total_amount=0;
          $month = date('m',strtotime($daily_visit->treatment_date));
          $year = date('Y',strtotime($daily_visit->treatment_date));
          $package_type = ($daily_visit->package_type == 1 && $daily_visit->package_type == 5)?'2':'1';


          $patient_invoice = App\Models\ClinicInvoices::selectRaw("clinic_invoices.*")
          ->where('clinic_invoices.month',$month)
          ->where('clinic_invoices.year',$year)
          ->where('clinic_invoices.clinic_id',$daily_visit->clinic_id)
          ->first();

          if(!empty($patient_invoice))
          {
            if(empty($update_type))
            {

               //echo 'add';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "clinic_id" => $daily_visit->clinic_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                //update
                 /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
              ->where('patient_invoices.year',$year)
              ->where('patient_invoices.clinic_id',$daily_visit->clinic_id)->update($insert_invoice);*/

            }
           else
           {
           // echo 'else';
              if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "clinic_id" => $daily_visit->clinic_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count+$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount+$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count+$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount+$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count+$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount+$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count+$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount+$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count+$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount+$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count+$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount+$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count+$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount+$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount + ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.clinic_id',$daily_visit->clinic_id)->update($insert_invoice);*/

                //check old entry change
              if(!empty($old_therapy_type) && !empty($old_therapy_amount))//update visit
              {
                echo 'here';
                if($daily_visit->therapy_id == 1)
                {
                  $rp_count = 1;
                  $rp_amount = $daily_visit->therapy_final_amount;
                  $rp_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 2)
                {
                  $dn_count = 1;
                  $dn_amount = $daily_visit->therapy_final_amount;
                  $dn_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 3)
                {
                  $ct_count = 1;
                  $ct_amountt = $daily_visit->therapy_final_amount;
                  $ct_total_amountt = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 4)
                {
                  $fu_count =  1;
                  $fu_amount = $daily_visit->therapy_final_amount;
                  $fu_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 5)
                {
                  $ij_count =  1;
                  $ij_amount =$daily_visit->therapy_final_amount;
                  $ij_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 6)
                {
                  $ms_count = 1;
                  $ms_amount = $daily_visit->therapy_final_amount;
                  $ms_total_amount = $daily_visit->therapy_final_amount;
                }
                if($daily_visit->therapy_id == 7)
                {
                  $fc_count = $patient_invoice->fc_count + 1;
                  $fc_amount = $daily_visit->therapy_final_amount;
                  $fc_total_amount = $daily_visit->therapy_final_amount;
                }
                $insert_invoice= array(
                "clinic_id" => $daily_visit->clinic_id,
                "month" => $month,
                "year" => $year,
                "package_type" => $package_type,
                "package_amount" => !empty($package_amount)?$package_amount:'',
                "rp_count" => $patient_invoice->rp_count-$rp_count,
                "rp_amount" => !empty($rp_amount)?$rp_amount:$patient_invoice->rp_amount,
                "rp_total_amount" =>$patient_invoice->rp_total_amount-$rp_total_amount,

                "fc_count" => $patient_invoice->fc_count-$fc_count,
                "fc_amount" => !empty($fc_amount)?$fc_amount:$patient_invoice->fc_amount,
                "fc_total_amount" =>$patient_invoice->fc_total_amount-$fc_total_amount,

                "ct_count" => $patient_invoice->ct_count-$ct_count,
                "ct_amount" => !empty($ct_amount)?$ct_amount:$patient_invoice->ct_amount,
                "ct_total_amount" =>$patient_invoice->ct_total_amount-$ct_total_amount,

                "dn_count" => $patient_invoice->dn_count-$dn_count,
                "dn_amount" => !empty($dn_amount)?$dn_amount:$patient_invoice->dn_amount,
                "dn_total_amount" =>$patient_invoice->dn_total_amount-$dn_total_amount,

                "fu_count" => $patient_invoice->fu_count-$fu_count,
                "fu_amount" => !empty($fu_amount)?$fu_amount:$patient_invoice->fu_amount,
                "fu_total_amount" =>$patient_invoice->fu_total_amount-$fu_total_amount,

                "ij_count" => $patient_invoice->ij_count-$ij_count,
                "ij_amount" => !empty($ij_amount)?$ij_amount:$patient_invoice->ij_amount,
                "ij_total_amount" =>$patient_invoice->ij_total_amount-$ij_total_amount,
               
                "ms_count" => $patient_invoice->ms_count-$ms_count,
                "ms_amount" => !empty($ms_amount)?$ms_amount:$patient_invoice->ms_amount,
                "ms_total_amount" =>$patient_invoice->ms_total_amount-$ms_total_amount,
               
                
                "final_amount" => $patient_invoice->final_amount - ($rp_amount + $fc_amount + $ct_amount + $dn_amount + $fu_amount + $ij_amount  + $ms_amount),
                "updated_by" => auth()->id(),
                "updated_at" => date('Y-m-d H:i:s'),
              );
                //pr($insert_invoice);
                  //update
                   /*App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.clinic_id',$daily_visit->clinic_id)->update($insert_invoice);*/
              }

           }
              
          }
          else
          {
             $insert_invoice= array(
              "clinic_id" => $daily_visit->clinic_id,
              "month" => $month,
              "year" => $year,
              "package_type" => $package_type,
              "package_amount" => !empty($package_amount)?$package_amount:'',
              "rp_count" => ($daily_visit->therapy_id == 1)?'1':NULL,
              "rp_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "rp_total_amount" => ($daily_visit->therapy_id == 1)?$daily_visit->therapy_final_amount:NULL,
              "ct_count" => ($daily_visit->therapy_id == 3)?'1':NULL,
              "ct_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "ct_total_amount" => ($daily_visit->therapy_id == 3)?$daily_visit->therapy_final_amount:NULL,
              "dn_count" => ($daily_visit->therapy_id == 2)?'1':NULL,
              "dn_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "dn_total_amount" => ($daily_visit->therapy_id == 2)?$daily_visit->therapy_final_amount:NULL,
              "fu_count" => ($daily_visit->therapy_id == 4)?'1':NULL,
              "fu_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fu_total_amount" => ($daily_visit->therapy_id == 4)?$daily_visit->therapy_final_amount:NULL,
              "fc_count" => ($daily_visit->therapy_id == 7)?'1':NULL,
              "fc_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "fc_total_amount" => ($daily_visit->therapy_id == 7)?$daily_visit->therapy_final_amount:NULL,
              "ij_count" => ($daily_visit->therapy_id == 5)?'1':NULL,
              "ij_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ij_total_amount" => ($daily_visit->therapy_id == 5)?$daily_visit->therapy_final_amount:NULL,
              "ms_count" => ($daily_visit->therapy_id == 6)?'1':NULL,
              "ms_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "ms_total_amount" => ($daily_visit->therapy_id == 6)?$daily_visit->therapy_final_amount:NULL,
              "final_amount" => !empty($daily_visit->therapy_final_amount)?$daily_visit->therapy_final_amount:'0',
              "created_by" => auth()->id(),
              "created_at" => date('Y-m-d H:i:s'),

            );
             //pr($insert_invoice);
            //add
            App\Models\ClinicInvoices::create($insert_invoice);
          }
        
      }
    }
    function add_therapiest_invoice($daily_visit_id,$is_add)
    {
        //echo $daily_visit_id;
        $daily_visit = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,pt.package_type,d.therapist_id")
        ->leftjoin("daily_visit_attendence as d","d.id","=","daily_therapist_visit_transection.attendence_therapist_id")
        ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
        ->orderBy('daily_therapist_visit_transection.id','desc')
        ->where('daily_therapist_visit_transection.id',$daily_visit_id)
        ->first();
        //prd($daily_visit);
        if(!empty($daily_visit))
        {
           $month = date('m',strtotime($daily_visit->treatment_date));
           $year = date('Y',strtotime($daily_visit->treatment_date));
           $daily_visit->therapist_id;
           $package_type = ($daily_visit->package_type == 1 && $daily_visit->package_type == 5)?'2':'1';
            $therapy_charge = App\Models\AssignPatientToTherapist::where('patient_id',$daily_visit->patient_id)->where('patient_treatement_id',$daily_visit->patients_treatments_id)->where('therapist_id',$daily_visit->therapist_id)->orderBy('id','desc')->first();
            //pr($therapy_charge);
            $payout_to_therapist = App\Models\PayoutTherapist::selectRaw("payout_to_therapist.*")
            ->where('payout_to_therapist.month',$month)
            ->where('payout_to_therapist.year',$year)
            ->where('payout_to_therapist.therapist_id',$daily_visit->therapist_id)
            ->where('payout_to_therapist.patient_treatment_id',$daily_visit->patients_treatments_id)
            ->first();

            //pr($payout_to_therapist);
            if(!empty($payout_to_therapist))
            { 
                $therapist_amount = !empty($therapy_charge->therapist_amount)?$therapy_charge->therapist_amount:'0';
                if(!empty($is_add))
                { 
                    $insert_invoice= array(
                      "therapist_id" => $daily_visit->therapist_id,
                      "patient_id" => $daily_visit->patient_id,
                      "patient_treatment_id" => $daily_visit->patients_treatments_id,
                      "no_of_visit"=> $payout_to_therapist->no_of_visit + 1,
                      "visit_charge"=> $therapist_amount,
                      "month" => $month,
                      "year" => $year,
                      "amount"=> $payout_to_therapist->amount + $therapist_amount,
                      "updated_by" => auth()->id(),
                      "updated_at" => date('Y-m-d H:i:s'),
                    );
                   //pr( $insert_invoice);
                }
                else
                {
                  $insert_invoice= array(
                    "therapist_id" => $daily_visit->therapist_id,
                    "patient_id" => $daily_visit->patient_id,
                    "patient_treatment_id" => $daily_visit->patients_treatments_id,
                    "no_of_visit"=> $payout_to_therapist->no_of_visit - 1,
                    "visit_charge"=> $therapist_amount,
                    "month" => $month,
                    "year" => $year,
                    "amount"=> $payout_to_therapist->amount - $therapist_amount,
                    "updated_by" => auth()->id(),
                    "updated_at" => date('Y-m-d H:i:s'),
                  );
                  //pr( $insert_invoice);
                }
                //pr($insert_invoice);
                App\Models\PayoutTherapist::where('payout_to_therapist.month',$month)
                ->where('payout_to_therapist.year',$year)
                ->where('payout_to_therapist.therapist_id',$daily_visit->therapist_id)->where('payout_to_therapist.patient_treatment_id',$daily_visit->patients_treatments_id)->update($insert_invoice);
            }
            else
            {              
              if(!empty($is_add))
                {
                $insert_invoice= array(
                    "therapist_id" => $daily_visit->therapist_id,
                    "patient_id" => $daily_visit->patient_id,
                    "patient_treatment_id" => $daily_visit->patients_treatments_id,
                    "no_of_visit"=> 1,
                    "visit_charge"=> !empty($therapy_charge->therapist_amount)?$therapy_charge->therapist_amount:'0',
                    "month" => $month,
                    "year" => $year,
                    "amount"=> !empty($therapy_charge->therapist_amount)?$therapy_charge->therapist_amount:'0',
                    "created_by" => auth()->id(),
                    "created_at" => date('Y-m-d H:i:s'),
                  );
                //pr($insert_invoice);
                App\Models\PayoutTherapist::create($insert_invoice);
                }
            }
        }
    }
    //count day between 2 dates
    function daycount($day, $startdate, $counter)
    {
        if($startdate >= time())
        {
            return $counter;
        }
        else
        {
            return daycount($day, strtotime("next ".$day, $startdate), ++$counter);
        }
    }
     function update_final_amount($patient_id,$treatment_date)
    {
     
      //get patient daily visit
      $month = date('m',strtotime($treatment_date));
      $year = date('Y',strtotime($treatment_date));
      $total_final_amount = 0;
      if(!empty($patient_id))
      {
         /* $daily_visit_patients = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.patient_id")
           ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and daily_therapist_visit_transection.attendence_therapist_id = "'.$daily_visit_id.'"')
          ->groupBy('daily_therapist_visit_transection.patient_id')
              ->get(); 
          if(!empty($daily_visit_patients))
          {
            foreach ($daily_visit_patients as $prow) 
            {*/
                //$patient_id = $prow->patient_id;
                $patient_invoices_desc = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date")
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_packged = 0 and daily_therapist_visit_transection.is_attend = 1 and pt.payment_collected_by = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and daily_therapist_visit_transection.patient_id = "'.$patient_id.'"')
            ->groupBy('daily_therapist_visit_transection.therapist_id')
            ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 

                  $patient_invoices_pack = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date,group_concat(distinct mt1.type_name) as therapy_list")
                      ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
                      ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.is_packged")
                      ->leftjoin("master_therapy_type as mt1","mt1.id","=","daily_therapist_visit_transection.therapy_id")
                      ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
                      //->orderBy('daily_therapist_visit_transection.id','desc')
                      ->whereRaw('daily_therapist_visit_transection.therapy_id <= 8 and daily_therapist_visit_transection.is_packged = 8 and daily_therapist_visit_transection.is_attend = 1 and pt.payment_collected_by = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and daily_therapist_visit_transection.patient_id = "'.$patient_id.'"')
                      ->groupBy('daily_therapist_visit_transection.therapist_id')
                      ->groupBy('daily_therapist_visit_transection.is_packged')
                      ->get(); 

                  if(!empty($patient_invoices_pack)){
                  foreach ($patient_invoices_pack as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    if($drow->week_days == 2)
                    {
                      $total_day = '13';
                    }
                    if($drow->week_days == 3)
                    {
                      $total_day = '11';
                    }
                    
                    if($drow->package_type == '2')//30days monthly
                    {
                      //pr($drow);
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      if($drow->week_days == 1)
                      {
                        $total_day = '30';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                        $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '3')//15days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 15 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      else if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '15';
                      }
                      $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '4')//10days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 10 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '10';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                        
                    }
                    if($drow->package_type == '1' || $drow->package_type == '5'){
                       $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                     $total_final_amount = $total_final_amount + $total_amount;
                    }else{  
                      $total_final_amount = $total_final_amount + $package_amount;
                    } 
                  }
                }
                if(!empty($patient_invoices_desc)){
                  foreach ($patient_invoices_desc as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    
                    
                    
                     if($drow->package_type == '1' || $drow->package_type == '5'){
                         $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                       $total_final_amount = $total_final_amount + $total_amount;
                      } 
                  }
                }
                //update total_amoumt
                App\Models\PatientInvoices::where('patient_invoices.month',$month)
                ->where('patient_invoices.year',$year)
                ->where('patient_invoices.patient_id',$patient_id)->update(array('final_amount'=>round($total_final_amount)));
            /*}
            
          }*/
      
      }
    }
     function update_final_amount_hospital($hospital_id,$treatment_date)
    {
     
      //get patient daily visit
      $month = date('m',strtotime($treatment_date));
      $year = date('Y',strtotime($treatment_date));
      $total_final_amount = 0;
      if(!empty($hospital_id))
      {
         /* $daily_visit_patients = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.patient_id")
           ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and daily_therapist_visit_transection.attendence_therapist_id = "'.$daily_visit_id.'"')
          ->groupBy('daily_therapist_visit_transection.patient_id')
              ->get(); 
          if(!empty($daily_visit_patients))
          {
            foreach ($daily_visit_patients as $prow) 
            {*/
                //$patient_id = $prow->patient_id;
                $patient_invoices_desc = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date")
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_packged = 0 and daily_therapist_visit_transection.is_attend = 1 and pt.visit_type = 2 and pt.payment_collected_by = 2 and  DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and pt.hospital_id = "'.$hospital_id.'"')
            ->groupBy('daily_therapist_visit_transection.therapist_id')
            ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 

                  $patient_invoices_pack = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date,group_concat(distinct mt1.type_name) as therapy_list")
                      ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
                      ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.is_packged")
                      ->leftjoin("master_therapy_type as mt1","mt1.id","=","daily_therapist_visit_transection.therapy_id")
                      ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
                      //->orderBy('daily_therapist_visit_transection.id','desc')
                      ->whereRaw('daily_therapist_visit_transection.therapy_id <= 8 and daily_therapist_visit_transection.is_packged = 8 and daily_therapist_visit_transection.is_attend = 1 and pt.visit_type = 2 and pt.payment_collected_by = 2 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and pt.hospital_id = "'.$hospital_id.'"')
                      ->groupBy('daily_therapist_visit_transection.therapist_id')
                      ->groupBy('daily_therapist_visit_transection.is_packged')
                      ->get(); 

                  if(!empty($patient_invoices_pack)){
                  foreach ($patient_invoices_pack as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    if($drow->week_days == 2)
                    {
                      $total_day = '13';
                    }
                    if($drow->week_days == 3)
                    {
                      $total_day = '11';
                    }
                    
                    if($drow->package_type == '2')//30days monthly
                    {
                      //pr($drow);
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      if($drow->week_days == 1)
                      {
                        $total_day = '30';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                        $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '3')//15days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 15 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      else if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '15';
                      }
                      $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '4')//10days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 10 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '10';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                        
                    }
                    if($drow->package_type == '1' || $drow->package_type == '5'){
                       $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                     $total_final_amount = $total_final_amount + $total_amount;
                    }else{  
                      $total_final_amount = $total_final_amount + $package_amount;
                    } 
                  }
                }
                if(!empty($patient_invoices_desc)){
                  foreach ($patient_invoices_desc as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    
                    
                    
                     if($drow->package_type == '1' || $drow->package_type == '5'){
                         $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                       $total_final_amount = $total_final_amount + $total_amount;
                      } 
                  }
                }

                //update total_amoumt

                App\Models\HospitalInvoices::where('hospital_invoices.month',$month)
                ->where('hospital_invoices.year',$year)
                ->where('hospital_invoices.hospital_id',$hospital_id)->update(array('final_amount'=>round($total_final_amount)));
            /*}
            
          }*/
      
      }
    }
     function update_final_amount_clinic($clinic_id,$treatment_date)
    {
     
      //get patient daily visit
      $month = date('m',strtotime($treatment_date));
      $year = date('Y',strtotime($treatment_date));
      $total_final_amount = 0;
      if(!empty($clinic_id))
      {
         /* $daily_visit_patients = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.patient_id")
           ->whereRaw('daily_therapist_visit_transection.is_attend = 1 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and daily_therapist_visit_transection.attendence_therapist_id = "'.$daily_visit_id.'"')
          ->groupBy('daily_therapist_visit_transection.patient_id')
              ->get(); 
          if(!empty($daily_visit_patients))
          {
            foreach ($daily_visit_patients as $prow) 
            {*/
                //$patient_id = $prow->patient_id;
                $patient_invoices_desc = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date")
            ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
            ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.therapy_id")
            ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
            //->orderBy('daily_therapist_visit_transection.id','desc')
            ->whereRaw('daily_therapist_visit_transection.is_packged = 0 and daily_therapist_visit_transection.is_attend = 1 and pt.visit_type = 3 and pt.payment_collected_by = 3 and  DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and pt.clinic_id = "'.$clinic_id.'"')
            ->groupBy('daily_therapist_visit_transection.therapist_id')
            ->groupBy('daily_therapist_visit_transection.therapy_id')
            ->get(); 

                  $patient_invoices_pack = App\Models\DailyTherapistVisitTransection::selectRaw("daily_therapist_visit_transection.*,count(daily_therapist_visit_transection.id) as total_visit,concat(u1.first_name,' ',u1.last_name) as therapist_name,mt.type_name,mt.type_full_name,pt.package_type,pt.week_days,pt.starting_date,group_concat(distinct mt1.type_name) as therapy_list")
                      ->leftjoin("therapists as u1","u1.id","=","daily_therapist_visit_transection.therapist_id")
                      ->leftjoin("master_therapy_type as mt","mt.id","=","daily_therapist_visit_transection.is_packged")
                      ->leftjoin("master_therapy_type as mt1","mt1.id","=","daily_therapist_visit_transection.therapy_id")
                      ->leftjoin("patients_treatments as pt","pt.id","=","daily_therapist_visit_transection.patients_treatments_id")
                      //->orderBy('daily_therapist_visit_transection.id','desc')
                      ->whereRaw('daily_therapist_visit_transection.therapy_id <= 8 and daily_therapist_visit_transection.is_packged = 8 and daily_therapist_visit_transection.is_attend = 1 and pt.visit_type = 3 and pt.payment_collected_by = 3 and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%m") = "'.$month.'" and DATE_FORMAT(daily_therapist_visit_transection.treatment_date, "%Y") = "'.$year.'" and pt.clinic_id = "'.$clinic_id.'"')
                      ->groupBy('daily_therapist_visit_transection.therapist_id')
                      ->groupBy('daily_therapist_visit_transection.is_packged')
                      ->get(); 

                  if(!empty($patient_invoices_pack)){
                  foreach ($patient_invoices_pack as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    if($drow->week_days == 2)
                    {
                      $total_day = '13';
                    }
                    if($drow->week_days == 3)
                    {
                      $total_day = '11';
                    }
                    
                    if($drow->package_type == '2')//30days monthly
                    {
                      //pr($drow);
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      if($drow->week_days == 1)
                      {
                        $total_day = '30';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                        $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '3')//15days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 15 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      else if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '15';
                      }
                      $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                    if($drow->package_type == '4')//10days monthly
                    {
                      $end_date = date('Y-m-d', strtotime($start_date. ' + 10 days'));
                      if($drow->week_days == 4)
                      {
                        $monday = daycount("monday", strtotime($end_date), 0);
                        $wednesday = daycount("wednesday", strtotime($end_date), 0);
                        $friday = daycount("friday", strtotime($end_date), 0);
                        $total_day = $monday+$wednesday+$friday;
                      }
                      if($drow->week_days == 5)
                      {
                        $tuesday = daycount("tuesday", strtotime($end_date), 0);
                        $thursday = daycount("thursday", strtotime($end_date), 0);
                        $saturday = daycount("saturday", strtotime($end_date), 0);
                        $total_day = $tuesday+$thursday+$saturday;
                      }
                      else if($drow->week_days == 1)
                      {
                        $total_day = '10';
                      }
                        $total_day = !empty($total_day)?$total_day:'1';
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                        
                    }
                    if($drow->package_type == '1' || $drow->package_type == '5'){
                       $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                     $total_final_amount = $total_final_amount + $total_amount;
                    }else{  
                      $total_final_amount = $total_final_amount + $package_amount;
                    } 
                  }
                }
                if(!empty($patient_invoices_desc)){
                  foreach ($patient_invoices_desc as $drow) {
                    
                    $therapy_package_charge = App\Models\PatientTherapyCharges::where('patient_treatment_id',$drow->patients_treatments_id)->where('patient_id',$drow->patient_id)->where('therapy_id','8')->first();
                    $package_amount = '0';
                    $start_date = $drow->starting_date;
                    $therapy_final_amount =  $therapy_package_charge->therapy_amount;
                    if(!empty($patient_invoice))
                    {
                      $patient_final_amount = $patient_invoice->final_amount;
                    }
                    else
                    {
                      $patient_final_amount =  0;
                    }
                    
                    
                    
                     if($drow->package_type == '1' || $drow->package_type == '5'){
                         $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                       $total_final_amount = $total_final_amount + $total_amount;
                      } 
                  }
                }

                //update total_amoumt

                App\Models\ClinicInvoices::where('clinic_invoices.month',$month)
                ->where('clinic_invoices.year',$year)
                ->where('clinic_invoices.clinic_id',$clinic_id)->update(array('final_amount'=>round($total_final_amount)));
            /*}
            
          }*/
      
      }
    }
    //monthly expense
    function get_month_expence($month,$year)
    {
        $company_expense = App\Models\CompanyExpenses::selectRaw('sum(amount) as total_amount')
            ->whereRaw('company_expenses.month = '.$month.' and company_expenses.year = '.$year)
            ->first(); 
        $company_payout = App\Models\CompanyPayout::selectRaw('sum(amount) as total_amount')
            ->whereRaw('company_payout.payout_done = 1 and company_payout.month = '.$month.' and company_payout.year = '.$year)
            ->first();       
         $payout_to_therapist = App\Models\PayoutTherapist::selectRaw('sum(amount) as total_amount')
            ->whereRaw('payout_to_therapist.payout_done = 1 and payout_to_therapist.month = '.$month.' and payout_to_therapist.year = '.$year)
            ->first(); 

            $company_expense_amount =   !empty($company_expense->total_amount)?$company_expense->total_amount:'0';
            $company_payout_amount =   !empty($company_payout->total_amount)?$company_payout->total_amount:'0';
            $payout_to_therapist_amount =   !empty($payout_to_therapist->total_amount)?$payout_to_therapist->total_amount:'0';
            return $company_expense_amount +  $company_payout_amount + $payout_to_therapist_amount;       
    }
    //monthly income
    function get_month_income($month,$year)
    {
         $patient_invoices = App\Models\PatientInvoices::selectRaw('sum(final_amount) as total_amount')
            ->whereRaw('patient_invoices.payment_collected = 1 and patient_invoices.month = '.$month.' and patient_invoices.year = '.$year)
            ->first(); 
        $patient_invoices_amount =   !empty($patient_invoices->total_amount)?$patient_invoices->total_amount:'0';
        return  $patient_invoices_amount;              
    }
    function get_setting($field)
    {
       $settings = App\Models\Settings::selectRaw('*')->first(); 
       return $settings->$field;
    }
    function get_total_visit($patient_id,$therapist_id,$treatment_date)
    {
      //echo $patient_id;echo $therapist_id;echo $treatment_date;
       $patient_invoices_desc = App\Models\DailyTherapistVisitTransection::selectRaw("SUM(case when daily_therapist_visit_transection.is_attend = 1 then 1 else 0 end) as total_attend,SUM(case when daily_therapist_visit_transection.is_attend = 0 then 1 else 0 end) as total_not_attend")
            ->whereRaw('daily_therapist_visit_transection.treatment_date = "'.$treatment_date.'" and daily_therapist_visit_transection.patient_id = "'.$patient_id.'" and daily_therapist_visit_transection.therapist_id = "'.$therapist_id.'"')
            ->groupBy('daily_therapist_visit_transection.treatment_date')
            ->first(); 
            $data = array();
            if(!empty($patient_invoices_desc))
            {
              $data['total_attend'] = $patient_invoices_desc['total_attend'];
              $data['total_not_attend'] = $patient_invoices_desc['total_not_attend'];
            }
            //pr($data);
            return $data;

    }
?>