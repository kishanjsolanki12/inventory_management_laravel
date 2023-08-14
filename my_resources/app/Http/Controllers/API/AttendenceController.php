<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Attendence;
use App\Models\PayoutTherapist;

use App\Http\Resources\ProgramResource;
use DB;
class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Attendence::latest()->get();
        return response()->json([ProgramResource::collection($data), 'Programs fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'therapist_id' => 'required',
            'patient_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $attendence = Attendence::create([
            'therapist_id' => $request->therapist_id,
            'patient_id' => $request->patient_id,
            'therapy_type' => $request->therapy_type,
            'is_attend' => $request->is_attend,
            'cancel_by' => !empty($request->cancel_by)?$request->cancel_by:NULL,
            //'payment_collection' => $request->payment_collection,
            //'payout_therapist' => $request->payout_therapist,
            'reason' => !empty($request->reason)?$request->reason:NULL,
            'treatment_date' => $request->treatment_date,
            'treatment_time' => $request->treatment_time,
            'treatment_duration' => $request->treatment_duration,
            'created_by' => $request->therapist_id,
            'created_at' => date('Y-m-d'),

         ]);
        
        return response()->json(['Created successfully.',$attendence]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendence = Attendence::find($id);
        if (is_null($attendence)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ProgramResource($attendence)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'desc' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $attendence->name = $request->name;
        $attendence->desc = $request->desc;
        $attendence->save();
        
        return response()->json(['Attendence updated successfully.', new ProgramResource($attendence)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        $attendence->delete();

        return response()->json('Attendence deleted successfully');
    }
    public function get_entry(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'therapist_id' => 'required'
        ]);
         $therapist_id = $request->therapist_id;
         $year = !empty($request->year)?$request->year:date('Y');
         $month = !empty($request->month)?$request->month:'';
         if(!empty($month))
         {
            $month = ' and MONTH(treatment_date) = '.$month;
         }
         $attendence = Attendence::whereRaw('treatment_date',$therapist_id)->where('therapist_id',$therapist_id)->whereRaw('YEAR(treatment_date) = '.$year.$month)->get()->toArray();
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $attendence = !empty($attendence)?$attendence:array('status'=>0,'message'=>'No data found');
        return response()->json($attendence);
    }
    
    public function get_payout(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'therapist_id' => 'required'
        ]);
         $therapist_id = $request->therapist_id;
         $year = !empty($request->year)?$request->year:date('Y');
         $month = !empty($request->month)?$request->month:'';
         if(!empty($month))
         {
            $month = ' and MONTH(treatment_date) = '.$month;
         }
         $attendence = PayoutTherapist::select(DB::raw("users.name as patient_name,t.name as therapiest_name,payout_to_therapist.price,payout_to_therapist.created_at"))->leftjoin("users","users.id","=","payout_to_therapist.patient_id")->leftjoin("users as t","t.id","=","payout_to_therapist.therapiest_id")->where('payout_to_therapist.therapiest_id',$therapist_id)->whereRaw('YEAR(payout_to_therapist.created_at) = '.$year.$month)->get()->toArray();
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $attendence = !empty($attendence)?$attendence:array('status'=>0,'message'=>'No data found');
        return response()->json($attendence);
    }
}