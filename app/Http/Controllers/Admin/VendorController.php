<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;
// use App\Models\VendorManager;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use Spatie\Permission\Models\Role;

use DB;
use Auth;

use Hash;

use Illuminate\Support\Arr;



class VendorController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {
      // $id = auth()->id();
      // prd($id);
      if(Auth::user()->hasRole('Vendor')) {
        $vendor_id=auth()->id();
        return redirect()->to("admin/vendor_management/$vendor_id/edit");

      }else{
        $users = User::orderBy('id','DESC')->whereHas(
          'roles', function($q){
              $q->where('name', 'Vendor');
          }
      )->paginate(20);

      }


// prd($users);
        foreach ($users as $user) {
            $roles = $user->getRoleNames();

            $user->roleName = isset($roles[0])?$roles[0]:'';
        }
        $roles = Role::pluck('name','id')->all();

        return view('admin.vendor_management.index', ['users' => $users,'roles'=>$roles]);
    }



    function fetch_data(Request $request)
    {

        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $per_page = $request->get('per_page');
            $role = $request->get('role');
            $query = $request->get('query');
            $role_query = '';
            if(!empty($role))
            {
                $role_query = 'm.role_id = '.$role.' and ';
            }
            $query = str_replace(" ", "%", $query);
            $users =     User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Vendor');
                }
            )->whereRaw('(users.first_name like "%'.$query.'%" or users.email like "%'.$query.'%")')
                        ->orderBy($sort_by, $sort_type)
                        ->paginate($per_page);
            //dd($users);
            /* $users = DB::table('users')
                        ->where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orderBy($sort_by, $sort_type)
                        ->paginate(5);*/

            foreach ($users as $user) {
                $roles = $user->getRoleNames();

                $user->roleName = isset($roles[0])?$roles[0]:'';
            }

            return view('admin.vendor_management.user_pagination_data', compact('users'))->render();
        }
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $roles = Role::pluck('name','name')->all();
        $countries = Country::where('status','1')->where('is_deleted','0')->get();
        $area = Area::where('status','1')->orderBy('area_name','asc')->get();

        $length = 4;
        $randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        return view('admin.vendor_management.create',compact('roles','countries','area','randomletter'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

       $validatedAttributes = request()->validate([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'     => 'required|email|unique:users',
            /*'role'  => 'required',*/
            'password'  => 'min:6|confirmed',
            'password_confirmation'   => 'required',
            'mobilenumber'  => 'required',
            'address'  => 'sometimes',
            'area'  => 'sometimes',
            /*'city'  => 'sometimes',
            'state'  => 'sometimes',*/
            'pincode'  => 'sometimes',
            /*'country'  => 'sometimes',
            'google_location'  => 'sometimes',
            'latitude'  => 'sometimes',
            'longitude'  => 'sometimes',*/

        ]);

        $validatedAttributes['password'] = \Hash::make($validatedAttributes['password']);


        $postData = request()->all();
        // pr($postData);
        $upload = '';
        $image = $request->file('image_name');
        // prd($image);
        if(!empty($image))
        {

          $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
          $file_type = $image->getClientMimeType();
          $image->move(public_path('images'),$upload);

          $validatedAttributes['image'] =  $upload;

        }
        $validatedAttributes['role'] = 'Vendor';
        $validatedAttributes['gender'] = $request['gender'];
        $validatedAttributes['refferal_code'] = $request['refferal_code'];

        // Create user
        $user = User::create($validatedAttributes);

        // Apply role (can be more than one but fixed to one for now!)
        $user->syncRoles([$validatedAttributes['role']]);

        // Get permissions related to the users role
        $rolePerms = Role::where('name', $validatedAttributes['role'])->with('permissions')->orderBy('id', 'asc')->first()->toArray();

        $perms = array();
        foreach ($rolePerms['permissions'] as $key => $perm) {
            $perms[] = $perm['name'];
        }

        // Sync perms for this user
        $user->syncPermissions([$perms]);

        return redirect()->route('vendor_management.index')->with('message', 'Vendor created successfully');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
      if(!Auth::user()->hasRole('Vendor')) {

        $user = User::find($id);
        $roles = Role::orderBy('id', 'asc')->pluck('name', 'id')->toArray();
        $userRoles = $user->getRoleNames();
        $user->roleName = $userRoles[0];
        return view('admin.vendor_management.show',compact('user','roles'));

    }else{

      return redirect('admin/vendor_management');
    }
  }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $user = User::find($id);

        $roles = Role::orderBy('id', 'asc')->pluck('name', 'id')->toArray();

        $userRoles = $user->getRoleNames();

        $user->roleName = $userRoles[0];


        $countries = Country::where('status','1')->get();
        $state = State::where('status','1')->where('country_id',$user->country)->get();
        $city = City::where('status','1')->where('state_id',$user->state)->get();
        $area = Area::where('status','1')->orderBy('area_name','asc')->get();

        return view('admin.vendor_management.edit', ['user' => $user, 'roles' => $roles,'countries'=>$countries,'state'=>$state,'city'=>$city,'area'=>$area]);

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request,$id)

    {
        $user = User::find($id);
      // prd($user);
        if($request['password'] == '') {

            $validatedAttributes = request()->validate([
                'first_name'  => 'required',
                'last_name'  => 'required',
                'email'     => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
                /*'role'  => 'required',*/
                'active'    => 'sometimes',
                'mobilenumber'  => 'required',
                'address'  => 'sometimes',
                'area'  => 'sometimes',
                /*'city'  => 'sometimes',
                'state'  => 'sometimes',*/
                'pincode'  => 'sometimes',
                /*'country'  => 'sometimes',
                'google_location'  => 'sometimes',
                'latitude'  => 'sometimes',
                'longitude'  => 'sometimes',*/

            ]);

        } else {

            $validatedAttributes = request()->validate([
                'first_name'  => 'required',
                'last_name'  => 'required',
                'email'     => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
               /* 'role'  => 'required',*/
                'password'  => 'sometimes|required_with:password_confirmation|string|min:6',
                'password_confirmation'   => 'sometimes|required_with:password|same:password',
                'mobilenumber'  => 'required',
                'address'  => 'sometimes',
                'area'  => 'sometimes',
                /*'city'  => 'sometimes',
                'state'  => 'sometimes',*/
                'pincode'  => 'sometimes',
                /*'country'  => 'sometimes',
                'google_location'  => 'sometimes',
                'latitude'  => 'sometimes',
                'longitude'  => 'sometimes',*/

            ]);

        }
        $upload = '';
        $image = $request->file('image_name');
        // prd($image);
        if(!empty($image))
        {

          $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
          $file_type = $image->getClientMimeType();
          $image->move(public_path('images'),$upload);

          $validatedAttributes['image'] =  $upload;

        }
        $validatedAttributes['role'] = 'Vendor';
        $validatedAttributes['gender'] = $request['gender'];
        if(isset($validatedAttributes['password']) && $validatedAttributes['password'] != '') $validatedAttributes['password'] = \Hash::make($validatedAttributes['password']);
          $postData = request()->all();
        // prd($validatedAttributes);
        $user->update($validatedAttributes);

        // Re-sync role (can be more than one but fixed to one for now!)
        $user->syncRoles([$validatedAttributes['role']]);

        // Get permissions related to the users role
        $rolePerms = Role::where('name', $validatedAttributes['role'])->with('permissions')->orderBy('id', 'asc')->first()->toArray();

        $perms = array();
        foreach ($rolePerms['permissions'] as $key => $perm) {
            $perms[] = $perm['name'];
        }

        // Re-sync perms for this user
        $user->syncPermissions([$perms]);

        return redirect()->route('vendor_management.index')->with('message', 'Vendor updated successfully');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::find($id)->delete();

        return redirect()->route('vendor_management.index')

                        ->with('message','Vendor deleted successfully');


    }

     /*
    @Description    : Get list of states by country id
    @Author         : Niral Patel
    @input          : country_id
    @output         : List of all states of that country
    @Date           : 14-05-2022
   *    /*

   */
    public function get_state(Request $request){
    $country_id = $request->get('country_id');

    $state = State::where('status','1')->where('country_id',$country_id)->get()->toArray();
    $html = '<option value="">Select State</option>';
    if(!empty($state)){
      foreach($state as $val){
        $html .= "<option value='".$val['id']."'>".ucwords($val['state_name'])."</option>";
      }
    }
    echo $html;
  }
  /*
    @Description    : Get list of city by state id
    @Author         : Niral Patel
    @input          : country_id
    @output         : List of all city of that state
    @Date           : 14-05-2022
   *
   */
    public function get_city(Request $request){
    $state_id = $request->get('state_id');

    $city = City::where('status','1')->where('state_id',$state_id)->get()->toArray();
    $html = '<option value="">Select City</option>';
    if(!empty($city)){
      foreach($city as $val){
        $html .= "<option value='".$val['id']."'>".ucwords($val['city_name'])."</option>";
      }
    }
    echo $html;
  }
  /*
    @Description    : Get list of areas by country id
    @Author         : Niral Patel
    @input          : country_id
    @output         : List of all areas of that country
    @Date           : 14-05-2022
   *
   */
    public function get_area(Request $request){
    $city_id = $request->get('city_id');

    $area = Area::where('status','1')->where('city_id',$city_id)->orderBy('area_name','asc')->get()->toArray();
    $html = '<option value="">Select Area</option>';
    if(!empty($area)){
      foreach($area as $val){
        $html .= "<option value='".$val['id']."'>".ucwords($val['area_name'])."</option>";
      }
    }
    echo $html;
  }





}