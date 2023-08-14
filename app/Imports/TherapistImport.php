<?php

namespace App\Imports;


//use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Therapist;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\LeadFrom;
use App\Models\MOP;
use App\Models\Designation;
use App\Models\Education;
use DB;
use Hash;
class TherapistImport implements ToCollection
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
                //country
                if(!empty($row[5]))
                {
                    $therapistemail = Therapist::where('email', trim($row[5]))->first();       
                    
                }
                if(empty($therapistemail->email))
                {
                    if(!empty($row[19]))
                    {
                        $Designation = Designation::where('designation_title', trim($row[19]))->first();
                        $designation_id = '';
                        if(!empty($Designation->designation_title))
                        {
                            $designation_id = $Designation->id;
                        }
                    }
                    //education
                    $education_id = '';
                    if(!empty($row[18]))
                    {
                        //education
                        $Education = Education::where('education_title', trim($row[18]))->first();
                        
                        if(!empty($Education->education_title))
                        {
                            $education_id = $Education->id;
                        }
                    }
                    //country
                    $country_id = '';
                    if(!empty($row[9]))
                    {
                        $Country = Country::where('country_name', trim($row[9]))->first();
                        
                        if(!empty($Country->country_name))
                        {
                            $country_id = $Country->id;
                        }
                    }
                    //state
                    $state_id = '';
                    if(!empty($row[10]))
                    {
                        $State = State::where('state_name', trim($row[10]))->first();
                        
                        if(!empty($State->state_name))
                        {
                            $state_id = $State->id;
                        }
                    }
                    //city
                    $city_id = '';
                    if(!empty($row[11]))
                    {
                        $City = City::where('city_name', trim($row[11]))->first();
                        
                        if(!empty($City->city_name))
                        {
                            $city_id = $City->id;
                        }
                    }
                    //area
                    $area_id = '';
                    if(!empty($row[12]))
                    {
                        $Area = Area::where('area_name', trim($row[12]))->first();
                        
                        if(!empty($Area->area_name))
                        {
                            $area_id = $Area->id;
                        }
                    }
                    //mop
                    $mop_id = '';
                    if(!empty($row[21]))
                    {
                        $MOP = MOP::where('mop_title', trim($row[21]))->first();
                        
                        if(!empty($MOP->mop_title))
                        {
                            $mop_id = $MOP->id;
                        }
                    }
                    

                    $therapist_type = array('Special Therapist'=>'1',
                        'Normal Therapist'=>'2');
                    $interview_status = array(
                        'Pending'=>'1',
                        'Selected'=>'2',
                        'Rejected'=>'3');
                    $badge = array('Good'=>'1',
                        'Better'=>'2',
                        'Best'=>'3');
                    $therapist_data = array(
                        //'id' => $product_id,
                        'therapist_type' => !empty($therapist_type[trim($row[1])])?$therapist_type[trim($row[1])]:'',
                        'therapist_badge'=> !empty($badge[trim($row[2])])?$badge[trim($row[2])]:'',
                        'first_name' => !empty($row[3])?$row[3]:NULL,
                        'last_name' => !empty($row[4])?$row[4]:NULL,
                        'email' => !empty($row[5])?$row[5]:NULL,
                        'mobilenumber' =>!empty($row[6])?$row[6]:NULL,
                        'alternet_mobile_no' => !empty($row[7])?$row[7]:NULL,
                        'address' => !empty($row[8])?$row[8]:NULL,
                        'country' => $country_id,
                        'state' => $state_id,
                        'city' => $city_id,
                        'area' => $area_id,
                        'pincode'=> !empty($row[13])?$row[13]:NULL,
                        'google_location'=> !empty($row[14])?$row[14]:NULL,
                        'latitude'=> !empty($row[15])?$row[15]:NULL,
                        'longitude' => !empty($row[16])?$row[16]:NULL,
                        'joining_date' => !empty($row[17])?date('Y-m-d',strtotime($row[17])):NULL,
                        'education' => $education_id,
                        'designation' => $designation_id,
                        'specialization' => !empty($row[20])?$row[20]:NULL,
                        'mop' => $mop_id,
                        'interview_status' => !empty($interview_status[trim($row[22])])?$interview_status[trim($row[22])]:'',
                        'reject_reason' => !empty($row[23])?$row[23]:NULL,
                        'years_of_experience' => !empty($row[24])?$row[24]:NULL,
                        'PAN_card' => !empty($row[25])?$row[25]:NULL,
                        'aadhar_card_no' => !empty($row[26])?$row[26]:NULL,
                        'password' => !empty($row[27])?\Hash::make(trim($row[27])):NULL,
                        'status' => '1',
                        'is_deleted'=>'0'
                    );
                    $therapist_data['created_at'] = date('Y-m-d H:i:s');
                    $therapist_data['created_by'] = auth()->id();
                      
                    Therapist::create($therapist_data)->id;
                } //therapist email condition
               //pr($therapist_data);
            }
           
            }$i++;
        }
        
    } 
}
