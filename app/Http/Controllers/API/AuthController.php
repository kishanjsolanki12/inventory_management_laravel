<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Validation\Rule;

use HasApiTokens;
use Validator;
use App\Models\User;
use App\Models\TempUser;
use App\Models\Wishlist;
use App\Models\AddToCart;
use App\Models\AddAddress;
use App\Models\Category;
use App\Models\Offers;
use App\Models\ProductManager;
use App\Models\BrandManager;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Settings;
use App\Models\PromoCode;
use App\Models\OrderManagementTransection;
use App\Models\CMSManager;

use App\Models\ProductImages;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',

            'email' => 'sometimes|string|email|max:255|unique:users',

            'password' => 'sometimes|string|min:8',

            'mobilenumber' => 'sometimes',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $mData = User::where('mobilenumber',$request->mobilenumber)->first();

        if(!empty($mData))

        {

             return response()

                    ->json(['status'=>'error','message' => 'The mobile number has already been taken.'], 200);

        }
        // $user = User::create([
        //     'first_name' => $request->name,
        //     'email' => $request->email,
        //     'mobilenumber' => $request->mobilenumber,
        //     'user_type' => $request->user_type,
        //     'password' => Hash::make($request->password)
        //  ]);

         $user = TempUser::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobilenumber' => $request->mobilenumber,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password)



         ]);

        

        $digits = 4;

        // $rand_num = rand(pow(10, $digits-1), pow(10, $digits)-1);

        //$rand_n = 'TU'.strtoupper($request->first_name).$user->id.$rand_num;

        // $length = 4;
        $rand_num = "666666";

        TempUser::where('id',$user->id)->update(array('sms_code'=>$rand_num)); 
        // $randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

        //qrimage

        
                        //$updateUser['qr_image']= $image_name;

        // TempUser::where('id',$user->id)->update(array('refferal_code'=>$rand_num)); 

        //$token = $user->createToken('auth_token')->plainTextToken;

        $userData = TempUser::where('id',$user->id)->first();

        return response()

            ->json(['status'=>'success','token'=>Crypt::encryptString($userData->id),'message' => 'Registered successfully.','data' => $userData ]);


    
    }

    public function login(Request $request)
    {
        // pr($request->sms_code);
    //    prd($request->mobilenumber);
        /*if (Auth::attempt($request->only('mobilenumber','sms_code')))
        {
            return response()

                   ->json(['status'=>'error','message' => 'Invalid mobile'], 401);
        }*/

        if(empty($request->mobilenumber))
        {
             return response()->json(['status'=>'error','message' => "Mobile number field required.",'code'=>'401' ]);
        }
        $user_data = User::where('mobilenumber', $request['mobilenumber'])->first();
        if(!empty($user_data))
        {
             // $user_id = $user_data->id;
                $rand_num = "666666";

               User::where('id',$user_data->id)->update(array('sms_code'=>$rand_num));
        }
        else
        {
                $user = TempUser::create([

               /* 'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,*/
                'mobilenumber' => $request->mobilenumber,
                'user_type' => '1',
                /*'password' => Hash::make($request->password)*/
             ]);

            $digits = 4;

            // $rand_num = rand(pow(10, $digits-1), pow(10, $digits)-1);

            //$rand_n = 'TU'.strtoupper($request->first_name).$user->id.$rand_num;

            // $length = 4;
            $rand_num = "666666";

            TempUser::where('id',$user->id)->update(array('sms_code'=>$rand_num)); 
        }
       

        return response()->json(['status'=>'succses','message' => "Send otp Succsefully" ,"code"=>200]);
        
        // $user = User::where('email', $request['email'])->firstOrFail();
        // $get_otp = User::where('mobilenumber', $request['mobilenumber'])->first();
        // // prd($get_otp);
        // $otp = $get_otp['sms_code'];
        // $user_id = $get_otp['id'];
        // // prd($otp);

        // if($otp == '666666')
        // {
        //     $data = User::where('id',$user_id)->update(array('sms_code' => NULL));

        //     return response()->json(['status'=>'Succses','message' => "login Succsefully" ], 200);
        // }else{
        //     return response()

        //            ->json(['status'=>'error','message' => 'Invalid Otp'], 401);
        // }

        // $user = User::where('email', $request['email'])->firstOrFail();

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()
        //     ->json(['message' => 'Login Succsefully ', 'token_type' => 'Bearer', ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        // auth()->user()->tokens()->delete();

        return ['status' => 'success', 'code' => 200,
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    

    

    // $system_sms = "654321";
   // Home Api

    
   public function LoginVerifyUser(Request $request)
    {

    $user_id = $request['system_user_id'];

    $user_input_sms = $request['sms_code'];

    $mobile_number = $request['mobilenumber'];



  

    $system_sms = User::selectRaw("*")->where('mobilenumber',$mobile_number)->orderBy('id', 'asc')->first();
    
    if(!empty($system_sms))
    {
        if(!empty($system_sms->sms_code) && $system_sms->sms_code == $user_input_sms)
        {
          return response()->json([ 'status' => 'success','token'=>Crypt::encryptString($system_sms->id),  'code' => 200, "message" => 'OTP is verified successful.']);

        }else{

          $data = "User not Verified";
          return response()->json([ 'status' => 'failed',  'code' => 422, "data" =>$data, "message" => 'OTP is not verified.']);

        }
    }
    else
    {
        $tempUser = TempUser::selectRaw("*")->where('mobilenumber',$mobile_number)->orderBy('id', 'asc')->first();
        if(!empty($tempUser))
        {
            if(!empty($tempUser->sms_code) && $tempUser->sms_code == $user_input_sms)
            {
                 $data = TempUser::where('id',$tempUser->id)->update(array('sms_code' => NULL));
                 $userData = User::create([
                    'sms_code' => $tempUser->sms_code,
                   /* 'first_name' => $tempUser->first_name,
                    'last_name' => $tempUser->last_name,
                    'email' => $tempUser->email,*/
                    'mobilenumber' => $tempUser->mobilenumber,
                    'user_type' => '1',
                   /* 'password' => Hash::make($request->password)*/
                     ]);

                

                  TempUser::where('mobilenumber',$mobile_number)->delete();

                  return response()->json([ 'status' => 'success','token'=>Crypt::encryptString($userData->id),  'code' => 200, "message" => 'OTP is verified successful.']);
           

            }else{

              $data = "User not Verified";
              return response()->json([ 'status' => 'failed',  'code' => 403,"message" => 'User not Verified']);

            }
        }
        else
        {
              return response()->json([ 'status' => 'failed',  'code' => 403,  "message" => 'Invalid mobile number']);

        }

    }
    // prd($system_sms);
    

    


    }
      // List of Party
  public function product_list(Request $request)
  {
    $page_no = $request->page;
    $search = $request->search;
    $offset = 20;

    if(!empty($page_no))
    {
      $page_no = $page_no*$offset;
    }
    else{
      $page_no = 0;
    }
    

    $req_filter = $request->filter;
    $req_sort = $request->sort;
    $filter_field = 'product_management.id';

    $sort ='desc';

    if(!empty($req_filter) && $req_filter == 'price')
    {

      $filter_field = 'product_management.mrp_price';

      $sort ='ASC';

    }else if(!empty($req_filter) && $req_filter == 'rating')
    {
        $filter_field = 'product_management.rating';

        $sort ='ASC'; 
    }
    $query_search = '';
    if(!empty($search))
    {
     $query_search = ' and (product_management.product_name like "%'.$search.'%" or product_management.product_desc like "%'.$search.'%")';
    }
    $data1 =  ProductManager::selectRaw("product_management.*")->whereRaw('product_management.deleted_at is null'.$query_search)->skip($page_no)->take($offset)->orderBy($filter_field,$sort)->get()->toArray();
    
     $data = array();
     if(!empty($data1))
      {
        $i = 0;
        foreach ($data1 as $raw) {
          //pr($raw);
          foreach ($raw as $key => $value) {
            if($key == 'product_image')
            {   
              $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

            }else{
            $data[$i][$key] = !empty($value)?$value:"";
          }
        }
        
          $i++;
        }
      }

    return response()
    ->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
  }

    public function product_detail(Request $request)
    {

        $product_id = $request->product_id;
        $parent_id = $request->category_id;
        if(!empty($product_id))
        {
        $data  = array();

        $data1 = ProductManager::selectRaw("product_management.*")
                              
                              ->orderby('id','desc')
                              ->where('product_management.id',$product_id)
                              ->get()->toArray();
          
        //  prd($data1);
        $product_image = ProductImages::where('product_id',$product_id)->orderBy('id','DESC')->get();

         
          if(!empty($data1))
          {
            $i = 0;
            foreach ($data1 as $raw) {
              //pr($raw);
              foreach ($raw as $key => $value) {
                // $images = array();
                if($key == 'product_image')
                {   
                  
                 
                  $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";
                 
                
               
                }else{
                 
                  $data[$i][$key] = !empty($value)?$value:"";
                 
                  
                }
               
              
            }

            // Product Other Images
            $product_imagess = array();
            if(!empty($data[$i]['product_image']))
            {
              $product_imagess[] = $data[$i]['product_image'];
            }
            
            foreach($product_image as $row)
            {
              // prd($row->image_name);
              $product_imagess[] = URL('products_image').'/'.$row->image_name;
              
            }
            
            $data[$i]['other_image'] = $product_imagess;

            // Sub Category list
            /*$sub_category = Category::selectRaw("category.*")->where('parent_id',$parent_id)->orderby('id','desc')->where('status','1')->get()->toArray();

            $i = 0;
            foreach ($sub_category as $raw) {
              //pr($raw);
              foreach ($raw as $key => $value) {
                // $images = array();
                if($key == 'category_image')
                {    
                 
                  $data['sub_category'][$i][$key] = !empty($value)?URL('category_images').'/'.$value:"";
                 
                }else{
                 
                  $data['sub_category'][$i][$key] = !empty($value)?$value:"";
                   
                }
              }
              $i++;
            }*/
            
            $category_id = $data1[0]['category_id'];
            if(!empty($category_id))
            {
              $catdata1 = ProductManager::selectRaw("product_management.*")->orderby('id','desc')->where('category_id',$category_id)->limit(5)->get()->toArray();
              //prd($catdata1);
              if(!empty($catdata1))
              {
                $i = 0;
                foreach($catdata1 as $raw)
                {
                  foreach ($raw as $key => $value) 
                  {
                    
                    if($key == 'product_image')
                    {   
                      $data['similer_product'][$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

                    }else{

                      $data['similer_product'][$i][$key] = !empty($value)?$value:"";
                    }
                  }
                  $i++;
                }
              }
            }
             
            }
            
              

            }
          

        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);

      }else{

        return response()->json([ 'status' => 'error', 'message' => 'Data Not Found.'], 401);
      }
        
    }

    public function product_search(Request $request)
    {

        $search = $request->search;
        // prd($search);
        $data1 = ProductManager::selectRaw("product_management.*")
        ->leftjoin('category as c','product_management.category_id', '=','c.id')
        ->whereRaw('product_management.deleted_at = NULL and (product_management.product_name like "%'.$search.'%" or c.category_name like "%'.$search.'%" or product_management.product_desc like "%'.$search.'%")')
                ->orderby('id','desc')
                ->get()->toArray();
          $data = array();
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
              
              if($key == 'product_image')
              {   
                $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

              }else{

                $data[$i][$key] = !empty($value)?$value:"";
              }
            }
            $i++;
          }
        }
        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }

    public function product_search_rating(Request $request)
    {

        $search = $request->search;
        // prd($search);
        $data1 = ProductManager::selectRaw("product_management.*,('AVG(review) as AverageRating')")
                          ->leftjoin('product_review as pr','product_management.id', '=','pr.product_id')
                          ->whereRaw('product_management.deleted_at = NULL and (product_management.product_name like "%'.$search.'%")')
                          ->orderby('id','desc')
                          ->get()->toArray();
                          // prd($data);
                          $data = array();
        if(!empty($data1))
          {
            $i = 0;
            foreach($data1 as $raw)
            {
              foreach ($raw as $key => $value) 
              {
                
                if($key == 'product_image')
                {   
                  $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

                }else{

                  $data[$i][$key] = !empty($value)?$value:"";
                }
              }
              $i++;
            }
          }
        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }

    

    public function product_list_by_category(Request $request)
    {
        $category_id = $request->category_id;

        if(!empty($category_id))
        {

          $data1 = ProductManager::selectRaw("product_management.*")->orderby('id','desc')->where('category_id',$category_id)->get()->toArray();
          $data = array();
          if(!empty($data1))
          {
            $i = 0;
            foreach($data1 as $raw)
            {
              foreach ($raw as $key => $value) 
              {
                
                if($key == 'product_image')
                {   
                  $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

                }else{

                  $data[$i][$key] = !empty($value)?$value:"";
                }
              }
            }
          }
          return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        }else{

          return response()->json([ 'status' => 'error', 'message' => 'Data Not Found.'], 401);
        }
       

        
    }

    public function brand_list(Request $request)
    {
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }

        $data = BrandManager::selectRaw("brand_management.*")->orderby('id','desc')->skip($page_no)->take($offset)->where('status','1')->get()->toArray();

        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }
    public function UserVerifySMS(Request $request)

    {

    $user_id = $request['system_user_id'];

    $user_input_sms = $request['sms_code'];

    $mobile_number = $request['mobilenumber'];



  

    $system_sms = TempUser::selectRaw("*")->where('mobilenumber',$mobile_number)->orderBy('id', 'asc')->first();
    
   
    // prd($system_sms);
    

    if(!empty($system_sms->sms_code) && $system_sms->sms_code == $user_input_sms)

    {

      $data = TempUser::where('id',$system_sms->id)->update(array('sms_code' => NULL));



      $data = "User Verified";



      $userData = User::create([
        'sms_code' => $system_sms->sms_code,
        'first_name' => $system_sms->first_name,
        'last_name' => $system_sms->last_name,
        'email' => $system_sms->email,
        'mobilenumber' => $system_sms->mobilenumber,
        'user_type' => $system_sms->user_type,
        'password' => Hash::make($request->password)
         ]);

    

      TempUser::where('mobilenumber',$mobile_number)->delete();

      return response()->json([ 'status' => 'success','token'=>Crypt::encryptString($userData->id),  'code' => 200, "message" => 'OTP is verified successful.']);



    }else{

      $data = "User not Verified";



      return response()->json([ 'status' => 'failed',  'code' => 422, "data" =>$data, "message" => 'OTP is not verified.']);

    }


    }

     public function offers(Request $request)
    {
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }
        $data1 = Offers::selectRaw("offers.*")->orderby('id','desc')->skip($page_no)->take($offset)->where('status','1')->get()->toArray();
       
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
              
              if($key == 'offer_image')
              {   
                $data[$i][$key] = !empty($value)?URL('images').'/'.$value:"";

              }else{

                $data[$i][$key] = !empty($value)?$value:"";
              }
            }
            $i++;
          }
        }
        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }

    public function offers_details(Request $request)
    {
      

        $offer_id = $request->offer_id;
        if(!empty($offer_id))
        {
        $data = array();
          $data1 = Offers::selectRaw("offers.*")->orderby('id','desc')->where('id',$offer_id)->get()->toArray();
        // prd($data1);
       
          if(!empty($data1))
          {
            // echo 1 ;exit;
            $i = 0;
           
            foreach($data1 as $raw)
            {
              // prd($raw);
              foreach ($raw as $key => $value) 
              {
                
                
                if($key == 'offer_image')
                {   
                  $data[$i][$key] = !empty($value)?URL('images').'/'.$value:"";
  
                }else{
  
                  $data[$i][$key] = !empty($value)?$value:"";
                }
              }
              
            }
           
          }
         
          return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
          
        }else{

          return response()->json([ 'status' => 'error', 'message' => 'Data Not Found.'], 401);
        }
       
        
        
    }
    public function category_list(Request $request)
    {

        $search = $request->search;
       $data = array();
        $data1 = Category::selectRaw("category.*")->where('parent_id','0')->where('status','1')->where('deleted_at',NULL)->whereRaw('category_name like "%'.$search.'%" ')->orderby('id','desc')->limit(4)->get()->toArray();
         //prd($data1);
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
              if($key == 'category_image')
              {
                $data[$i][$key] = !empty($value)?URL('category_images').'/'.$value:"";
              }else{
              $data[$i][$key] = !empty($value)?$value:"";
            }
            }
            $i++;
          }
          
        }

        // $data = Category::selectRaw("category.*")->orderby('id','desc')->limit(10)->get();


        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }


    public function category_list_all(Request $request)
    {
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }
        $search = $request->search;

        $data1 = Category::selectRaw("category.*")->orderby('id','desc')->skip($page_no)->take($offset)->where('status','1')->where('parent_id','0')->where('deleted_at',NULL)->whereRaw('category_name like "%'.$search.'%" ')->get()->toArray();

        if(!empty($data1))
        {
          // echo 1 ;exit;
          $i = 0;
         
          foreach($data1 as $raw)
          {
           
            foreach ($raw as $key => $value) 
            {
            
              
              if($key == 'category_image')
              {   
                $data[$i][$key] = !empty($value)?URL('category_images').'/'.$value:"";

              }else{

                $data[$i][$key] = !empty($value)?$value:"";
              }
            }
            $i++;
          }
         
        }

        // $data = Category::selectRaw("category.*")->orderby('id','desc')->skip($page_no)->take($offset)->where('status','1')->get()->toArray();


        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }



    public function country(Request $request)
    {

      $data = Country::where('status','1')->get()->toArray();

      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
    }

    public function state(Request $request)
    {
      $country_id = $request->country_id;
      $data = State::where('status','1')->where('country_id',$country_id)->get()->toArray();

      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
    }
    public function city(Request $request)
    {
      $state_id = $request->state_id;
      $data = City::where('status','1')->where('state_id',$state_id)->get()->toArray();

      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
    }

    public function best_selling_product(Request $request)
    {
      $page_no = $request->page;
      $offset = 10;
  
      if(!empty($page_no))
      {
        $page_no = $page_no*$offset;
      }
      else{
        $page_no = 0;
      }

      
        $data1 = OrderManagementTransection::selectRaw("pm.id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc")
                ->leftjoin('product_management as pm','order_management_transection.product_id', '=','pm.id')
                ->orderby('order_management_transection.product_id','desc')
                ->where('order_management_transection.created_date', '>', now()->subDays(30)->endOfDay())
                ->where('pm.deleted_at',NULL)
                ->groupby('order_management_transection.product_id')
                ->skip($page_no)->take($offset)
                ->get()->toArray();

       
    
       
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {

              if($key == 'product_image')
              {
                $data[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";
              }else{
                $data[$i][$key] = !empty($value)?$value:"";
              }
                
            }
            $i++;
          }
        }else{
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "NO Data Found"]);
        }
     
      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
     
      
    }

    public function about_us(Request $request)
    {
      
    
      
        $data1 = CMSManager::selectRaw("cms_management.*")->where('id',1)->orderby('id','desc')->get()->toArray();
               
                

       
    
       
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {

              if($key == 'image_name')
              {
                $data[$i][$key] = !empty($value)?URL('images').'/'.$value:"";
              }else{
                $data[$i][$key] = !empty($value)?$value:"";
              }
                
            }
            $i++;
          }
        }
     
      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
     
      
    }

    public function sub_category(Request $request)
    {
      $parent_id = $request->category_id;
      $search = $request->search;
      // prd($parent_id);
      $data1 = Category::selectRaw("category.*")->where('parent_id',$parent_id)->whereRaw('category_name like "%'.$search.'%" ')->orderby('id','desc')->where('status','1')->get()->toArray();
         
       
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {

              if($key == 'category_image')
              {
                $data[$i][$key] = !empty($value)?URL('category_images').'/'.$value:"";
              }else{
                $data[$i][$key] = !empty($value)?$value:"";
              }
                
            }
            $i++;
          }
        }else{
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "NO Data Found"]);
        }
     
      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
     
      
    }
    public function get_address_by_pincode(Request $request)
    {
      $pincode = $request->pincode;
      if(empty($pincode))
        {
          return response()->json(['status'=>'error', 'code' => 401,'message' => 'Please enter pincode.']);
        }
        //$url = 'https://maps.googleapis.com/maps/api/geocode/json?address=94040';
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$pincode.'&key=AIzaSyCBBaRt1qSo1RGWB3rlh0Z_4Su_Dr1bfC0';
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        $result = json_decode($result, true);
        //pr($result);
        $address_array = array();
        
        if(isset($result['status']) && $result['status'] == 'OK')
        {
          if(!empty($result))
            {
              $lat=isset($result['results'][0]['geometry']['location']['lat'])?$result['results'][0]['geometry']['location']['lat']:'';
              $lng=isset($result['results'][0]['geometry']['location']['lng'])?$result['results'][0]['geometry']['location']['lng']:'';
              $components = $result["results"][0]["address_components"];

              if(!empty($result['results'][0]['address_components']))
              {
                $city = array_values($this->filter($components, "locality"))[0]["long_name"];
                if(empty($city))
                {
                   $city = array_values($this->filter($components, "administrative_area_level_3"))[0]["long_name"];
                }
                 $state = array_values($this->filter($components, "administrative_area_level_1"))[0]["long_name"];
                  $country = array_values($this->filter($components, "country"))[0]["long_name"];

              }
              
              // if($result['results'][0]['address_components']['2']['types'][0] == 'administrative_area_level_3')
              // {
              //   $city=isset($result['results'][0]['address_components']['2']['long_name'])?$result['results'][0]['address_components']['2']['long_name']:'';
              // }
              // else
              // {
              //   $state=isset($result['results'][0]['address_components']['2']['long_name'])?$result['results'][0]['address_components']['2']['long_name']:'';
              //   $country=isset($result['results'][0]['address_components']['3']['long_name'])?$result['results'][0]['address_components']['3']['long_name']:'';

              // }
              // if(empty($state))
              // {
              //  $state=isset($result['results'][0]['address_components']['3']['long_name'])?$result['results'][0]['address_components']['3']['long_name']:'';
              // }
              
              // if(empty($country))
              // {
              //   $country=isset($result['results'][0]['address_components']['4']['long_name'])?$result['results'][0]['address_components']['4']['long_name']:'';
              // }
              
             
             $address_array = array(
              'city' => !empty($city)?$city:'',
              'state' => $state,
              'country' => $country,
              'lat' => $lat,
              'lng' => $lng,
             );
            }
             return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$address_array]);
          
        }
        else
        {
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Something went wrong"]);
        }
        
       
         
        
    }
    // filter the address_components field for type : $type
    function filter($components, $type)
    {
        return array_filter($components, function($component) use ($type) {
            return array_filter($component["types"], function($data) use ($type) {
                return $data == $type;
            });
        });
    }

     public function home_api(Request $request)
    {
    // offer listing
      
      $data1 = Offers::selectRaw("offers.*")->orderby('id','desc')->limit(10)->where('status','1')->get()->toArray();
     
      if(!empty($data1))
      {
        $i = 0;
        foreach($data1 as $raw)
        {
          foreach ($raw as $key => $value) 
          {
            
            if($key == 'offer_image')
            {   
              $data['offer_list'][$i][$key] = !empty($value)?URL('images').'/'.$value:"";

            }else{

              $data['offer_list'][$i][$key] = !empty($value)?$value:"";
            }
          }
          $i++;
        }
      }
      


      //category Listing
      $search = $request->search;
     $data['category_list'] = array();
      $data1 = Category::selectRaw("category.*")->where('parent_id','0')->where('status','1')->where('deleted_at',NULL)->whereRaw('category_name like "%'.$search.'%" ')->orderby('id','desc')->limit(4)->get()->toArray();
       //prd($data1);
      if(!empty($data1))
      {
        $i = 0;
        foreach($data1 as $raw)
        {
          foreach ($raw as $key => $value) 
          {
            if($key == 'category_image')
            {
              $data['category_list'][$i][$key] = !empty($value)?URL('category_images').'/'.$value:"";
            }else{
            $data['category_list'][$i][$key] = !empty($value)?$value:"";
          }
          }
          $i++;
        }
        
      }



      // new arrival product 

      $data1 = ProductManager::selectRaw("product_management.*")->where('product_management.deleted_at',NULL)->orderby('id','desc')->limit(10)->get()->toArray();
        
        
        if(!empty($data1))
        {
          $i = 0;
          foreach ($data1 as $raw) {
            //pr($raw);
            foreach ($raw as $key => $value) {
              if($key == 'product_image')
              {   
                $data['new_arrival_product'][$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";
  
              }else{
              $data['new_arrival_product'][$i][$key] = !empty($value)?$value:"";
            }
          }
          
            $i++;
          }
        }

     

      // new tranding product

      $data1 = ProductManager::selectRaw("product_management.*")->where('deleted_at',NULL)->where('tranding_now','1')->orderby('id','desc')->limit(10)->get()->toArray();
        // prd($data1);
        
        if(!empty($data1))
        {
          $i = 0;
          foreach ($data1 as $raw) {
            //pr($raw);
            foreach ($raw as $key => $value) {
              if($key == 'product_image')
              {   
                $data['new_tranding_product'][$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";
  
              }else{
              $data['new_tranding_product'][$i][$key] = !empty($value)?$value:"";
            }
          }
          
            $i++;
          }
        }

      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
      
    }
  }