<?php 


namespace App\Http\Repositories\Admin;
use Illuminate\Http\Request;
use App\Http\Repositories\EloquentRepository;
use App\Providers;
use App\Specialization;
use App\Facility;
use App\Qualification;


class MasterRepository extends EloquentRepository{

//code start for provider...........
	public function allProvider(){
		return Providers::get();
	}
	public function storeProvider($request){
		$data = $this->validationProvider($request);
		return Providers::create($data);
	}
	public function updateProvider($request){
		$data = $this->validationProvider($request);
		return Providers::where('id',$request->id)->update($data);
	}
	public function destroyProvider($id){
		return Providers::Where('id',$id)->delete();
	}
	public function validationProvider($request,$id=null){
		$data = $request->validate([
			'name'=>'required',
			'slug'=>'required'
		]);
		 return $data;
    }

//end provider code...................
//code start for Specializations code...................
	public function allSpecializations(){
		return Specialization::get();
	}
	public function storeSpecializations($request){
		$data = $this->validationSpecializations($request);
		return Specialization::create($data);
	}
	public function updateSpecializations($request){
		$data = $this->validationSpecializations($request);
		return Specialization::where('id',$request->id)->update($data);
	}
	public function destroySpecializations($id){
		return Specialization::Where('id',$id)->delete();
	}
	public function validationSpecializations($request,$id=null){
		$data = $request->validate([
			'name'=>'required',
			'slug'=>'required'
		]);
		 return $data;
    }

    //code start for specialities code...................
	public function allFacility(){
		return Facility::get();
	}
	public function storeFacility($request){
		$data = $this->validationFacility($request);
		return Facility::create($data);
	}
	public function updateFacility($request){
		$data = $this->validationFacility($request);
		return Facility::where('id',$request->id)->update($data);
	}
	public function destroyFacility($id){
		return Facility::Where('id',$id)->delete();
	}
	public function validationFacility($request,$id=null){
		$data = $request->validate([
			'name'=>'required',
			'flag'=>'required',
			'slug'=>'required'
		]);
		$data['result_search'] = $request->result_search;
		 return $data;
    }
    //code start for Qualification code...................
	public function allQualification(){
		return Qualification::get();
	}
	public function storeQualification($request){
		$data = $this->validationQualification($request);
		return Qualification::create($data);
	}
	public function updateQualification($request){
		$data = $this->validationQualification($request);
		return Qualification::where('id',$request->id)->update($data);
	}
	public function destroyQualification($id){
		return Qualification::Where('id',$id)->delete();
	}
	public function validationQualification($request,$id=null){
		$data = $request->validate([
			'name'=>'required',
			'flag'=>'required'
		]);
		 return $data;
    }
}
?>