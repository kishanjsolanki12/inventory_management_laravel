<?php

namespace App\Imports;


//use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Patients;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\LeadFrom;
use App\Models\MOP;
use DB;
class PatientsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
       $i=0;
        foreach ($rows as $row)
        {
          
          if($i > 0 && !empty($row[1]))
          {
            if(!empty($row[1]))
            {
                $LeadFrom = LeadFrom::where('lead_title', trim($row[3]))->first();
                $lead_from = '';
                if(!empty($LeadFrom->lead_title))
                {
                    $lead_from = $LeadFrom->id;
                }
                //country
                $country_id = '';
                if(!empty($row[10]))
                {
                    $Country = Country::where('country_name', trim($row[10]))->first();
                    
                    if(!empty($Country->country_name))
                    {
                        $country_id = $Country->id;
                    }
                }
                //state
                $state_id = '';
                if(!empty($row[11]))
                {
                    $State = State::where('state_name', trim($row[11]))->first();
                    if(!empty($State->state_name))
                    {
                        $state_id = $State->id;
                    }
                }
                //city
                $city_id = '';
                if(!empty($row[12]))
                {
                    $City = City::where('city_name', trim($row[12]))->first();
                    
                    if(!empty($City->city_name))
                    {
                        $city_id = $City->id;
                    }
                }
                //area
                $area_id = '';
                if(!empty($row[13]))
                {
                    $Area = Area::where('area_name', trim($row[13]))->first();
                    
                    if(!empty($Area->area_name))
                    {
                        $area_id = $Area->id;
                    }
                }
                //mop
                $mop_id = '';
                if(!empty($row[18]))
                {
                    $MOP = MOP::where('mop_title', trim($row[18]))->first();
                    
                    if(!empty($MOP->mop_title))
                    {
                        $mop_id = $MOP->id;
                    }
                }
                

                $lead_type = array('Marketing Lead'=>'1',
                    'Confirmed Patient'=>'2',
                    'Cancelled'=>'3','Completed'=>'4');
                $badge = array('Normal User'=>'1',
                    'Premium User'=>'2',
                    'Super Premium User'=>'3');

                $patient_data = array(
                    //'id' => $product_id,
                    'lead_type' => !empty($lead_type[trim($row[1])])?$lead_type[trim($row[1])]:'',
                    'cancel_reason' => !empty($row[2])?$row[2]:NULL,
                    'lead_from' => $lead_from,
                    'first_name' =>!empty($row[4])?$row[4]:NULL,
                    'last_name' => !empty($row[5])?$row[5]:NULL,
                    'email' => !empty($row[6])?$row[6]:NULL,
                    'mobilenumber' => !empty($row[7])?$row[7]:NULL,
                    'alternet_mobile_no' => !empty($row[8])?$row[8]:NULL,
                    'address' => !empty($row[9])?$row[9]:NULL,
                    'country' => $country_id,
                    'state' => $state_id,
                    'city' => $city_id,
                    'area' => $area_id,
                    'pincode'=> !empty($row[14])?$row[14]:NULL,
                    'google_location'=> !empty($row[15])?$row[15]:NULL,
                    'latitude'=> !empty($row[16])?$row[16]:NULL,
                    'longitude' => !empty($row[17])?$row[17]:NULL,
                    'mop' => $mop_id,
                    'patient_relative_name' => !empty($row[19])?$row[19]:NULL,
                    'patient_mobile_no' => !empty($row[20])?$row[20]:NULL,
                    'is_premium' => !empty($badge[trim($row[21])])?$badge[trim($row[21])]:'',
                    'status' => '1',
                    'is_deleted'=>'0'
                );
                $patient_data['created_at'] = date('Y-m-d H:i:s');
                $patient_data['created_by'] = auth()->id();
                  
                Patients::create($patient_data)->id;

               //pr($patient_data);
            }
           
            }$i++;
        }//exit;
        
    } 
}
