<?php $next_month = $month +1;
$next_year = ($next_month == 12)?($year+1):$year;?>
<div class="table-responsive">
    <table  style="width:100%">
        <tbody>
            <tr class="text-left border-b-2 border-gray-300">
                 <td style="cursor: blue;"><h3>Physiocares</h3>
                   <p>B 303 Shree Laxmi Narayan Residency</p>
                   <p>South Bopal, Ahmedabad, Gujarat, India</p>
                   <p>380058</p>
                   <p>M - +91 9558841222</p>
                 </td>

                
            </tr>
        </tbody>
        
    </table>
    <table  style="width:100%">
        <tbody>
            <tr class="text-left border-b-2 border-gray-300">
                 <td style="cursor: blue;"><h1>Invoice</h1></td>
            </tr>
           
        </tbody>
        
    </table>
      </table>
    <table  style="width:100%">
        <tbody>
            <tr class="text-left border-b-2 border-gray-300">
                 <td style="cursor: blue;">
                   <p><b>From</b></p>
                   <p>Physiocares</p>
                 </td>
                 <td style="cursor: blue;">
                   <p><b>Payable to</b></p>
                   <p>{{!empty($hospital->name)?ucfirst($hospital->name):''}}</p>
                 </td>
                 <td style="cursor: blue;">
                   <p><b>Recipt #</b></p>
                   <p>{{!empty($hospital->id)?$hospital->id:''}}</p>
                 </td>

            </tr>
             <tr class="text-left border-b-2 border-gray-300">
                 <td style="cursor: blue;">
                   <p><b>Visit Month</b></p>
                   <p><?=date('F', mktime(0, 0, 0, $month, 10)); // March?> - <?=$year?> </p>
                 </td>
                 <!-- <td style="cursor: blue;">
                   <p><b>Treatment</b></p>
                   <p><?=!empty($patient_treatment->treatments)?$patient_treatment->treatments:''?></p>
                 </td> -->
                 <!-- <td style="cursor: blue;">
                   <p><b>Due date</b></p>
                   <p>03-<?=$next_month?>-<?=$next_year?></p>
                 </td> -->

            </tr>
        </tbody>
        
    </table>
    <table  style="width:100%">
        <tbody>
            <tr class="text-left border-b-2 border-gray-300">
                 <td style="color: : blue;"><b>Description</b></td>
                 <td style="color: : blue;"><b>No. of Visits</b></td>
                 <td ><b>Visit Charge</b></td>
                 <td ><b>Total Price</b></td>

            </tr>
            <?php if(!empty($patient_treatment)){ 
              $total_amount = 0;
              foreach($patient_treatment as $row) {?>
             <tr class="text-left border-b-2 border-gray-300">
                 <td>
                   <p>{{!empty($row->patient_name)?ucfirst($row->patient_name):''}} ({{!empty($row->treatment_title)?$row->treatment_title:''}} - {{!empty($row->type_name)?$row->type_name:''}})</p>
                 </td>
                 <td >
                   <p>{{!empty($row->no_of_visit)?$row->no_of_visit:''}}</p>
                 </td>
                 <td >
                   <p>{{!empty($row->therapy_final_amount)?$row->therapy_final_amount:''}}</p>
                 </td>
                 <td >
                   <p>{{$row->amount = ($row->no_of_visit*$row->therapy_final_amount)}}</p>
                   <?php $total_amount = $total_amount +  $row->amount?>
                 </td>
            </tr>
            <?php } } ?>
             <?php 
            $total_final_amount = 0;
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
                      $day_amount = number_format((float)($therapy_final_amount/$total_day), 2, '.', '');
                        $package_amount = number_format((float)($day_amount*$drow->total_visit), 2, '.', '');
                    }
                ?>
                <tr class="text-left border-b-2 border-gray-300">
                 <td>
                   <p>{{!empty($drow->patient_name)?ucfirst($drow->patient_name):''}} ({{!empty($drow->treatment_title)?$drow->treatment_title:''}} - {{!empty($drow->type_name)?$drow->type_name:''}})</p>
                 </td>
                 <td >
                   <p>
                   <?php 
                    echo !empty($drow->total_visit)?$drow->total_visit:'0';
                  
                    ?></p>
                 </td>
                 <td >
                  <p>
                  <?php if($drow->package_type == '1' || $drow->package_type == '5'){
                    echo !empty($drow->therapy_final_amount)?$drow->therapy_final_amount:'0';
                  }else{
                   // echo !empty($day_amount)?round($day_amount):'0';
                  } ?>
                   </p>
                 </td>
                 <td >
                   <p>
                  <?php if($drow->package_type == '1' || $drow->package_type == '5'){
                     $total_amount = number_format(($drow->total_visit*$drow->therapy_final_amount), 2, '.', ''); 
                   $total_final_amount = round($total_final_amount + $total_amount);
                   echo $total_amount;
                  }else{
                    echo !empty($package_amount)?round($package_amount):'0';
                    $total_final_amount = round($total_final_amount + $package_amount);
                  } ?>
                   </p>
                 </td>
                  </tr>
                <?php
              }
              ?>
              <?php
            } ?>
            <tr class="text-left border-b-2 border-gray-300">
                 <td colspan="2">
                 </td>
                 <td>
                   Subtotal
                 </td>
                 <td>
                   <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?=!empty($total_amount)?$total_amount+$total_final_amount:'0'?>
                 </td>
                 
            </tr>
            
           <!--   <tr>
        <td colspan="3" style="border-top: 1px soild">&nbsp;</td>
        
              <td style="color: #FF1493;font-size: 20px;" ><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><span class="final_amount">{{!empty($payout_to_therapist[0]->deduction)?($total_amount - $payout_to_therapist[0]->deduction):$total_amount}}</span></b></td>
              
            </tr> -->
        </tbody>
        
    </table>
    <hr>
   
    <hr>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
</div>