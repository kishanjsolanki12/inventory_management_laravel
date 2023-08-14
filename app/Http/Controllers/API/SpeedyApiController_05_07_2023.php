<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
use Validator;
use Socialite;
use App\Models\User;
use App\Models\Category;
use App\Models\Offers;
use App\Models\ProductManager;
use App\Models\BrandManager;
use App\Models\Wishlist;
use App\Models\ProductReview;
use App\Models\AddToCart;
use App\Models\AddAddress;
use App\Models\AddContect;
use App\Models\OrderManager;
use App\Models\Settings;
use App\Models\PromoCode;
use App\Models\OrderManagementTransection;
use App\Models\CMSManager;
use App\Models\OrderStatusTransaction;
use App\Models\OrderStatus;

use Image;
use File;
use DB;
use DateTime;

class SpeedyApiController extends Controller
{
  public function __construct()
    {
           $this->middleware('apibase');
            
    }
  
public function profile(Request $request)
{
    $user_id = $request->system_user_id;
    // User Profile 
    $users =  User::selectRaw('users.id,users.first_name,users.last_name,users.email,users.mobilenumber')->orderBy('users.id', 'asc')->where('users.id',$user_id)->get()->toArray();

   //$user[0]['qr_code_link'] = URL('qrcode').'/'.'qrcode_1.png';
     //$url = URL('qrcode').'/'.'qrcode_1.png';
   $url ='';
   if(!empty($users))
    {
      $i = 0;
      foreach($users as $raw)
      {
        foreach ($raw as $key => $value) 
        {
            $user[$i][$key] = !empty($value)?$value:"";
          
        }
      }
      return response()->json([ 'status' => 'success', 'code' => 200, "user" =>$user]);
    }else{
      return response()->json([ 'status' => 'error', 'code' => 403, "message" => " No Data Found. "]);
    }

 
    
 }

  public function update_profile(Request $request)
  {
     $user_id = $request->system_user_id;
      
      if(empty($request->first_name))
      {
          $msg1 = '';
          if(empty($request->first_name))
          {
              $msg1 .= 'first name,';
          }
         elseif(empty($request->last_name))
          {
              $msg1 .= 'last name,';
          }
          elseif(empty($request->email))
          {
              $msg1 .= 'email,';
          }
          return response()

                  ->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 401);

      }
      if(!empty($request->email))
      {
        $useremail =  $userData = User::selectRaw('users.id,users.first_name,users.last_name,users.email,users.mobilenumber')->where('id','!=',$user_id)->where('email',$request->email)->first();
        if(empty($useremail))
        {
           $updateUser = array(
              'first_name' => $request->first_name,
              'last_name' => $request->last_name,
              'email' => $request->email,
              
           );

          User::where('id',$user_id)->update($updateUser); 
          $userData = User::selectRaw('users.id,users.first_name,users.last_name,users.email,users.mobilenumber')->where('id',$user_id)->first();

          return response()
          ->json(['status'=>'success','code'=>'200','message' => 'Update profile successfully.','data' => $userData ]);
        }
        else
        {
           return response()
          ->json(['status'=>'error','code'=>'401','message' => 'Email already exists.']);
        }
      }
     
      
  }


    public function add_wishlist(Request $request)
    {
       $user_id = $request->system_user_id;
      if(empty($request->product_id))
      {
        $msg1 = 'product id'; 

        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      

       Wishlist::create([
  
  
  
        'product_id' => $request->product_id,
  
        'user_id' => $user_id,
        
  
        'created_date' => date('Y-m-d H:i:s'),
  
        'modified_date' => date('Y-m-d H:i:s'),
  
  
  
     ]);
  
     return response()->json([ 'status' => 'Success', 'code' => 403, "message" => "Data Add Successfully"]); 

    }

    public function wishlist_detail(Request $request)
    {

        $user_id = $request->system_user_id;
        // $product_id = $request->product_id;
        // pr($user_id);
        // prd($user_id);
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }
       
        $data1 = Wishlist::selectRaw("user_wishlist.*,p.product_name,p.mrp_price,p.product_image,p.product_desc")
            ->leftjoin('product_management as p','user_wishlist.product_id', '=','p.id')
                ->orderby('id','desc')
                ->where('user_wishlist.user_id',$user_id)
                // ->where('user_wishlist.product_id',$product_id)
                ->skip($page_no)->take($offset)
                ->get()->toArray();
                // prd($data1);

                if(!empty($data1))
                {
                  $i = 0;
                  foreach($data1 as $raw)
                  {
                    foreach ($raw as $key => $value) 
                    {
                      
                      if($key == 'product_image')
                      {   
                        $data[$i][$key] = !empty($value)?URL('product_image').'/'.$value:"";

                      }else{

                        $data[$i][$key] = !empty($value)?$value:"";
                      }
                    }
                  }
                }else{
                  return response()->json([ 'status' => 'error', 'code' => 403, "message" => " No Data Found. "]);
                }
               

                return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }

    public function remove_wishlist(Request $request)
    {
        $user_id = $request->system_user_id;
        $product_id = $request->product_id;
      // prd($user_id);
        if(!empty($product_id) && !empty($user_id))
        {
          Wishlist::where('user_id',$user_id)->where('product_id',$product_id)->delete();

          return response()->json([ 'status' => 'Success', 'code' => 200, "message" => "Remove Successfully"]); 
        }else{

          return response()->json([ 'status' => 'error', 'code' => 403, "message" => " product id is required. "]); 
        }
       
    }

    public function add_review(Request $request)
    {
      $user_id = $request->system_user_id;
      if(empty($request->product_id))
      {
        $msg1 = 'Product id';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }

      if(empty($request->system_user_id))
      {
        $msg1 = 'User id';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      

      if(empty($request->rate))
      {
        $msg1 = 'rate';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      if(empty($request->review))
      {
        $msg1 = 'review';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
  
        ProductReview::create([
  
        'product_id' => $request->product_id,

        'user_id' => $request->system_user_id,


        'rate' => $request->rate,
        'review' => $request->review,
        'created_date' => date('Y-m-d H:i:s'),
        'modified_date' => date('Y-m-d H:i:s'),
  
     ]);
  
     return response()->json([ 'status' => 'error', 'code' => 403, "message" => "Data Add Successfully"]); 

    }

    public function list_of_review(Request $request)
    {

        
        $product_id = $request->product_id;
        // pr($user_id);
        // prd($product_id);
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }
       if(!empty($product_id))
       {
        $data1 = ProductReview::selectRaw("product_review.*,p.product_name,p.mrp_price,p.product_image,p.product_desc,u.first_name")
            ->leftjoin('product_management as p','product_review.product_id', '=','p.id')
            ->leftjoin('users as u','product_review.user_id', '=','u.id')
                ->orderby('id','desc')
                ->where('product_review.product_id',$product_id)
                ->skip($page_no)->take($offset)
                ->get()->toArray();
        // prd($data1);
                if(!empty($data1))
                {

                  $i = 0;
                   
                  foreach($data1 as $raw)
                  {

                    foreach ($raw as $key => $value) 
                    {

                      if($key == 'product_image')
                      {   
                        $data[$i][$key] = !empty($value)?URL('product_image').'/'.$value:"";

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

                // $data = URL('product_image/p.product_image');
                // prd($data);

       
        
    }

    public function review_detail(Request $request)
    {

        
        $review_id = $request->review_id;
        // pr($user_id);
        // prd($review_id);
        $page_no = $request->page;
        $offset = 10;

        if(!empty($page_no))
        {
        $page_no = $page_no*$offset;
        }
        else{
        $page_no = 0;
        }
       
        $data1 = ProductReview::selectRaw("product_review.*,p.product_name,p.mrp_price,p.product_image,p.product_desc,u.first_name")
            ->leftjoin('product_management as p','product_review.product_id', '=','p.id')
            ->leftjoin('users as u','product_review.user_id', '=','u.id')
            ->where('product_review.id',$review_id)
            ->orderby('id','desc')  
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
                    $data[$i][$key] = !empty($value)?URL('product_image').'/'.$value:"";

                  }else{
                    $data[$i][$key] = !empty($value)?$value:"";
                  }
                }
              }
            }
                // prd($data);

        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        
    }

     public function add_to_cart_list(Request $request){
      $user_id = $request->system_user_id;
      $addtocard = AddToCart::selectRaw("add_to_cart.id,add_to_cart.qty,pm.id as product_id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc")->where('user_id',$user_id)->leftjoin('product_management as pm','add_to_cart.product_id', '=','pm.id')->orderby('id','desc')->get()->toArray();

      if(!empty($addtocard))
            {
              $i = 0;
              foreach($addtocard as $raw)
              {
                foreach ($raw as $key => $value) 
                {
                  if($key == 'product_image')
                  {   
                    $data[$i][$key] = !empty($value)?URL('product_image').'/'.$value:"";

                  }else{
                    $data[$i][$key] = !empty($value)?$value:"";
                  }
                }
                $i++;
              }
              return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
            }
            else
            {
              return response()->json([ 'status' => 'error', 'code' => 401, "message" =>'No Data Found.']);
            }

    }
    public function update_add_to_cart(Request $request)
    {
      $user_id = $request->system_user_id;
      if(empty($request->product_id))
      {
        $msg1 = 'Product id';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      
      $products = $request->product_id;
      //prd($products);
      if(!empty($products))
      {
        foreach($products as $product_id => $qty)
        {
           AddToCart::where('product_id',$product_id)->where('user_id',$request->system_user_id)->update([
  
              'product_id' => $product_id,
              'user_id' => $request->system_user_id,
              'qty' => $qty,
              'created_date' => date('Y-m-d H:i:s'),
              'modified_date' => date('Y-m-d H:i:s'),
        
           ]);
        }
      }
        
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Data update Successfully"]); 

    }
    public function add_to_cart(Request $request)
    {
      $user_id = $request->system_user_id;
      if(empty($request->product_id))
      {
        $msg1 = 'Product id';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      if(empty($request->qty))
      {
        $msg1 = 'qty id';
        return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
      }
      $add_to_cart = AddToCart::where('product_id',$request->product_id)->where('user_id',$request->system_user_id)->first();
      $cart_qty = !empty($add_to_cart->qty)?$add_to_cart->qty:'0';
      if(!empty($add_to_cart))
      {
         AddToCart::where('product_id',$request->product_id)->where('user_id',$request->system_user_id)->update([
  
          'product_id' => $request->product_id,
          'user_id' => $request->system_user_id,
          'qty' => $request->qty+$cart_qty,
          'created_date' => date('Y-m-d H:i:s'),
          'created_by'=> $request->system_user_id,
          'modified_date' => date('Y-m-d H:i:s'),
          'modified_by'=> $request->system_user_id,
    
       ]);
      }
      else
      {
         AddToCart::create([
  
          'product_id' => $request->product_id,
          'user_id' => $request->system_user_id,
          'qty' => $request->qty,
          'created_date' => date('Y-m-d H:i:s'),
          'created_by'=> $request->system_user_id,
          'modified_date' => date('Y-m-d H:i:s'),
          'modified_by'=> $request->system_user_id,
    
       ]);
      }
       
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Data Add Successfully"]); 

    }
    public function remove_add_to_cart(Request $request)
    {
        $user_id = $request->system_user_id;
        $product_id = $request->product_id;

        // prd($user_id);
        if(!empty($product_id) && !empty($user_id))
        {
          AddToCart::where('user_id',$user_id)->where('product_id',$product_id)->delete();

          return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Remove Successfully"]); 
        }else{

          return response()->json([ 'status' => 'error', 'code' => 403, "message" => "Not Successfully Remove"]); 
        }

       
    }

    public function add_address(Request $request)
    {
      $user_id = $request->system_user_id;
      

        if(empty($request->first_name))
        {
          $msg1 = 'first name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        if(empty($request->last_name))
        {
          $msg1 = 'last name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
       
       
        
      AddAddress::where('user_id',$user_id)->update(['primary_address' => '0']);

      AddAddress::create([

        'user_id' => $user_id,
        'primary_address' => '1',
        // 'address_type' => '1',
        'address_save_type' => '1',
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address1' => $request->address1,
        'address2' => $request->address2,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'pincode' => $request->pincode,
        'phone' => $request->phone,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'billing_first_name' => $request->billing_first_name,
        'billing_last_name' => $request->billing_last_name,
        'billing_address1' => $request->billing_address1,
        'billing_address2' => $request->billing_address2,
        'billing_city' => $request->billing_city,
        'billing_state' => $request->billing_state,
        'billing_country' => $request->billing_country,
        'billing_pincode' => $request->billing_pincode,
        'billing_phone' => $request->billing_phone,
        'billing_latitude' => $request->billing_latitude,
        'billing_longitude' => $request->billing_longitude,
        'created_date' => date('Y-m-d H:i:s'),
        'modified_date' => date('Y-m-d H:i:s'),
  
     ]);
  //    AddAddress::create([

  //     'user_id' => $user_id,
  //     // 'address_type' => '2',
  //     'address_save_type' => '1',
  //     'billing_first_name' => $request->billing_first_name,
  //     'billing_last_name' => $request->billing_last_name,
  //     'billing_address1' => $request->billing_address1,
  //     'billing_address2' => $request->billing_address2,
  //     'billing_city' => $request->billing_city,
  //     'billing_state' => $request->billing_state,
  //     'billing_country' => $request->billing_country,
  //     'billing_pincode' => $request->billing_pincode,
  //     'billing_phone' => $request->billing_phone,
  //     'billing_latitude' => $request->billing_latitude,
  //     'billing_longitude' => $request->billing_longitude,
  //     'created_date' => date('Y-m-d H:i:s'),
  //     'modified_date' => date('Y-m-d H:i:s'),

  //  ]);
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Address Added Successfully"]); 

    }
    public function update_both_address(Request $request)
    {
      $user_id = $request->system_user_id;
      $address_id = $request->address_id;
      // $billing_address_id = $request->billing_address_id;
      // prd($user_id);
        if(empty($request->first_name))
        {
          $msg1 = 'first name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        if(empty($request->last_name))
        {
          $msg1 = 'last name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
       
       
        
      //AddAddress::where('user_id',$user_id)->update(['primary_address' => '0']);

      AddAddress::where('id',$address_id)->update([

        'user_id' => $user_id,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address1' => $request->address1,
        'address2' => $request->address2,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'pincode' => $request->pincode,
        'phone' => $request->phone,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'billing_first_name' => $request->billing_first_name,
        'billing_last_name' => $request->billing_last_name,
        'billing_address1' => $request->billing_address1,
        'billing_address2' => $request->billing_address2,
        'billing_city' => $request->billing_city,
        'billing_state' => $request->billing_state,
        'billing_country' => $request->billing_country,
        'billing_pincode' => $request->billing_pincode,
        'billing_phone' => $request->billing_phone,
        'billing_latitude' => $request->billing_latitude,
        'billing_longitude' => $request->billing_longitude,
        'created_date' => date('Y-m-d H:i:s'),
        'modified_date' => date('Y-m-d H:i:s'),
  
     ]);
  //    AddAddress::where('id',$billing_address_id)->update([

  //     'user_id' => $user_id,
  //     'billing_first_name' => $request->billing_first_name,
  //     'billing_last_name' => $request->billing_last_name,
  //     'billing_address1' => $request->billing_address1,
  //     'billing_address2' => $request->billing_address2,
  //     'billing_city' => $request->billing_city,
  //     'billing_state' => $request->billing_state,
  //     'billing_country' => $request->billing_country,
  //     'billing_pincode' => $request->billing_pincode,
  //     'billing_phone' => $request->billing_phone,
  //     'billing_latitude' => $request->billing_latitude,
  //     'billing_longitude' => $request->billing_longitude,
  //     'created_date' => date('Y-m-d H:i:s'),
  //     'modified_date' => date('Y-m-d H:i:s'),

  //  ]);
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Address Updated Successfully"]); 

    }
    public function update_address(Request $request)
    {
      $user_id = $request->system_user_id;
      
      $address_id = $request->address_id;
      

        if(empty($request->first_name))
        {
          $msg1 = 'first name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        if(empty($request->last_name))
        {
          $msg1 = 'last name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
       
        
  
      AddAddress::where('id',$address_id)->update([

        'user_id' => $user_id,
        'address_save_type' => '1',
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address1' => $request->address1,
        'address2' => $request->address2,
        'city' => $request->city,
        'state' => $request->state,
        'country' => $request->country,
        'pincode' => $request->pincode,
        'phone' => $request->phone,
        'created_date' => date('Y-m-d H:i:s'),
        'modified_date' => date('Y-m-d H:i:s'),
  
     ]);

     
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Address Update Successfully"]); 

    }
    public function change_delivery_address(Request $request)
    {
      $user_id = $request->system_user_id;
      
      $address_id = $request->address_id;
      
       
      AddAddress::where('user_id',$user_id)->update(['primary_address' => '0']);  
  
      AddAddress::where('id',$address_id)->update([

        'primary_address' => '1',
        
     ]);

     
  
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Address Update Successfully"]); 

    }
    public function delete_address(Request $request)
    {
        $user_id = $request->system_user_id;
        $address_id = $request->address_id;
      if(!empty($user_id) && !empty($user_id))
      {
        AddAddress::where('user_id',$user_id)->where('id',$address_id)->delete();

        return response()->json([ 'status' => 'Success', 'code' => 200, "message" => "Remove Successfully"]); 
      }else{

        return response()->json([ 'status' => 'error', 'code' => 403, "message" => " Remove Not Successfully. "]); 
      }
     
    }

    public function list_of_address(Request $request)
    {
      $user_id = $request->system_user_id;
      // prd($user_id);
      if(!empty($user_id))
      {
        $data1 = AddAddress::selectRaw("user_addresses.*,u.first_name as name")
        ->leftjoin('users as u','user_addresses.user_id', '=','u.id')
        ->orderby('id','desc')
        ->where('user_id',$user_id)
        ->get()->toArray();
        // prd($data1);
        $data = array();
         if(!empty($data1))
            {
              $i = 0;
              foreach($data1 as $raw)
              {
                foreach ($raw as $key => $value) 
                {
                  $data[$i][$key] = !empty($value)?$value:"";
                
                }
                $i++;
              }
              
            }
        
        
      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
      }else{

        return response()->json([ 'status' => 'error', 'code' => 403, "message" => "User id is required"]); 
      }
      
    }

    public function contact_us(Request $request)
    {
     
        if(empty($request->name))
        {
          $msg1 = 'name';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        if(empty($request->email))
        {
          $msg1 = 'email';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        if(empty($request->mobile))
        {
          $msg1 = 'mobile';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }
        
      
      
      AddContect::create([
  
        
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'subject' => $request->subject,
        'description' => $request->description,
        'created_date' => date('Y-m-d H:i:s'),
        'modified_date' => date('Y-m-d H:i:s'),
  
     ]);
  
     return response()->json([ 'status' => 'Success', 'code' => 200, "message" => "Contact Us Added Successfully"]); 

    }

    public function order_manager(Request $request)
    {
       $user_id = $request->system_user_id;
      /*if(empty($request->order_id))
        {
          $msg1 = 'Order id';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }*/
        /*if(empty($request->rider_user_id))
        {
          $msg1 = 'Rider User Id';
          return response()->json(['status'=>'error','message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 200);
        }*/
        if(empty($user_id))
        {
          $msg1 = 'Delivered user id';
          return response()->json(['status'=>'error', 'code' => 403,'message' => 'Please enter '.rtrim($msg1,',').' required fields.'], 403);
        }

        $user_address = AddAddress::where('user_id',$user_id)->where('primary_address',1)->first();
       
        // OrderManager::where('id',$order_id)->update(array('address_id' => $user_address[0]['id']));
        
            $order_id = OrderManager::create([
                
              'delivered_user_id' => $user_id,
              'delivery_cost' => $request->delivery_cost,
              'total_cost' => $request->total_cost,
              'order_status' => $request->order_status,
              'tax' => $request->tax,
              'sub_total' => $request->sub_total,
              'coupon_discount' => $request->coupon_discount,
              'transection_id' => $request->transection_id,    
              'address_id' => !empty($user_address)?$user_address->id:'',
              'created_by' => $user_id,
              'modified_by' => $user_id,
              'created_date' => date('Y-m-d H:i:s'),
              'modified_date' => date('Y-m-d H:i:s'),

            ])->id;
            OrderManager::where('id',$order_id)->update(array('order_id'=>'ORD00'.$order_id));
      // order place
      if($request->order_status == 1)
      {
        OrderStatusTransaction::create([

          'status_id' => 1,
          'order_id' => $order_id,
          'status_date' => date('Y-m-d H:i:s'),
          'created_by' => $user_id,
          'updated_by' => $user_id,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),

          
        ]);
        

        OrderStatusTransaction::create([

          'status_id' => 2,
          'order_id' => $order_id,
          'status_date' => date('Y-m-d H:i:s'),
          'created_by' => $user_id,
          'updated_by' => $user_id,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),

        ]);
      }
      

      
       $addtocard = AddToCart::selectRaw("add_to_cart.id,pm.id as product_id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc,add_to_cart.qty")->where('user_id',$user_id)->leftjoin('product_management as pm','add_to_cart.product_id', '=','pm.id')->orderby('id','desc')->get();
      if(!empty($addtocard))
      {
        $i = 0;
        foreach($addtocard as $raw)
        {
          OrderManagementTransection::create(
          [
         
            'order_id' => $order_id,
            'product_id' => $raw->product_id,
            'product_qty' => $raw->qty,
            'product_price' => $raw->discount_price,
            'discount' => ($raw->mrp_price>$raw->discount_price)?$raw->mrp_price-$raw->discount_price:'',
            'created_by' => $user_id,
            'modified_by' => $user_id,
            'created_date' => date('Y-m-d H:i:s'),
            'modified_date' => date('Y-m-d H:i:s'),
      
         ])->id;
        }
        //remove add to cart
        AddToCart::where('user_id',$user_id)->delete();
      }
     return response()->json([ 'status' => 'success', 'code' => 200, "message" => "Order Added Successfully"]); 

    }

    public function order_listing(Request $request)
    {
      $user_id = $request->system_user_id;

      if(!empty($user_id))
      {
        $data1 = OrderManager::selectRaw("order_management.*,CONCAT(u.first_name,' ', u.last_name) as name")
                ->leftjoin('users as u','order_management.rider_user_id', '=','u.id')
                ->orderby('id','desc')
                ->where('delivered_user_id',$user_id)
                ->get()->toArray();

        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
             
                $data[$i][$key] = !empty($value)?$value:"";
              }
            $product_name = OrderManagementTransection::selectRaw("p.product_name")->where('order_id',$raw['id'])->leftjoin('product_management as p','order_management_transection.product_id', '=','p.id')->first();
            $data[$i]['product_name'] = !empty($product_name->product_name)?$product_name->product_name:"";
            $i++;
          }
        }else{
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Data Not Found."]); 
        }

      return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
      }else{

        return response()->json([ 'status' => 'error', 'code' => 401, "message" => "User id is required"]); 
      }
      
    }
    public function order_detail(Request $request)
    {
      $order_id = $request->order_id;

      if(!empty($order_id))
      {
        $data1 = OrderManager::selectRaw("order_management.*,CONCAT(u.first_name,' ', u.last_name) as name")
                ->leftjoin('users as u','order_management.rider_user_id', '=','u.id')
                ->orderby('order_management.id','desc')
                ->where('order_management.id',$order_id)
                ->get()->toArray();

        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
             
                $data[$i][$key] = !empty($value)?$value:"";
              }
            
          }
          return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        }else{
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Data Not Found."]); 
        }

      
      }else{

        return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Order id is required"]); 
      }
      
    }

    public function basket(Request $request)
    {
      $user_id = $request->system_user_id;
      

      $data1 = AddAddress::selectRaw("user_addresses.*,u.first_name as name")
                      ->leftjoin('users as u','user_addresses.user_id', '=','u.id')
                      ->leftjoin('add_to_cart as atc','user_addresses.id', '=','atc.user_id')
                      ->where('user_addresses.user_id',$user_id)
                      ->where('user_addresses.primary_address','1')
                      ->orderby('id','desc')  
                      ->get()->toArray();
                      
        //$addtocard = AddToCart::selectRaw("add_to_cart.*,pm.discount_price")->where('user_id',$user_id)->leftjoin('product_management as pm','add_to_cart.product_id', '=','pm.id')->orderby('id','desc')->get();
         $addtocard1 = AddToCart::selectRaw("add_to_cart.id,pm.id as product_id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc,add_to_cart.qty,(pm.discount_price*add_to_cart.qty) as total")->where('user_id',$user_id)->leftjoin('product_management as pm','add_to_cart.product_id', '=','pm.id')->orderby('id','desc')->get()->toArray();
        $tex_pr = Settings::orderby('id','desc')->get();
        
        //prd($addtocard1);
        $total_amount = 0;
        $addtocard = array();
        if(!empty($addtocard1))
        {
          $i = 0;
          foreach($addtocard1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {
                if($key == 'product_image')
                {   
                  $addtocard[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

                }else{
                  $addtocard[$i][$key] = !empty($value)?$value:"";
                }  
               
            }
            $total = !empty($raw->total)?$raw->total:'0';
            $total_amount += $total;
            $i++;
          }
        }
        //$total_amount = $addtocard[0]->discount_price;  
        //$quentity = $addtocard[0]->qty;
        $percentage = $tex_pr[0]->tax_percentage;
        //$total_final_amount = $quentity * $total_amount;
        $total_text = ($total_amount * $percentage) / 100;

        //$final_amount = $total_text + $total_final_amount;

        // prd($data1);
        // $adddata=[];
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
           
            foreach ($raw as $key => $value) 
            {
             
                $adddata[$i][$key] = !empty($value)?$value:"";
                
            }
            $i++;
          }
        }/*else{
          return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Data Not Found"]);
        }*/
        $data['product_list'] = $addtocard;
        if(!empty($adddata))
        {
          $data['delivery_address'] = $adddata;
        }else{
          $data['delivery_address']= [];
        }
        
        $data['total_amount'] = $total_amount;
        $data['tax'] = $total_text;
        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
    }

    public function apply_promocode(Request $request)
    {
      
      $promocode = $request->promocode;
      $amount = $request->amount;

      $data1 = PromoCode::selectRaw("promocode.*")->where('promocode',$promocode)->orderby('id','desc')->get()->toArray(); 
      // $promocode = PromoCode::selectRaw("promocode.*")->where('promocode',$promocode)->orderby('id','desc')->get();
      // $promocode_value = $promocode[0]->promocode_value;
      // $discount = ($promocode_value * 10) / 100;
      // $final_amount = $promocode_value - $discount;
      //  prd($promocode_value);

      if(!empty($data1))
      {
        $i = 0;
       
        foreach($data1 as $raw)
        {
          // prd($value);
          $p_value = $raw['promocode_type'];
          $promocode_value = $raw['promocode_value'];
          // prd($p_value);
          foreach($raw as $key => $value) 
          {
           
            if($p_value == '1')
            {
              // echo '1'; exit;
              $discount = ($amount * $promocode_value) / 100;
              
              $data[$i][$key] = !empty($value)?$value:"";
              $data[$i]['discount'] = $amount - $discount;

            }else{

              $data[$i][$key] = !empty($value)?$value:"";
              $data[$i]['amount'] = $amount;
            }
             
              
          }
          return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
        }
      }else{
        return response()->json([ 'status' => 'error', 'code' => 401, "message" => "Invalid promocode"]);
      }

        
    }

    public function order_again(Request $request)
    {
      $user_id = $request->system_user_id;
      $page_no = $request->page;
      $offset = 10;
  // prd($user_id);
      if(!empty($page_no))
      {
        $page_no = $page_no*$offset;
      }
      else{
        $page_no = 0;
      }

      
        $data1 = OrderManagementTransection::selectRaw("pm.id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc")
                        ->leftjoin('product_management as pm','order_management_transection.product_id', '=','pm.id')
                        //->leftjoin('order_management as om','order_management_transection.order_id', '=','om.order_id')
                        ->where('order_management_transection.created_by',$user_id)
                        ->orderby('order_management_transection.product_id','desc')
                        ->groupBy('order_management_transection.product_id')
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
                $data[$i][$key] = !empty($value)?URL('product_image').'/'.$value:"";
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

    public function order_status(Request $request)
    {
      $user_id = $request->system_user_id;
      $orderId = $request->order_id;

      $order_detail = OrderManagementTransection::selectRaw("om.order_id,order_management_transection.product_qty")->leftjoin('order_management as om','order_management_transection.order_id', '=','om.id')->where('order_management_transection.order_id',$orderId)->groupBy('order_management_transection.order_id')->orderby('order_management_transection.id','desc')->get()->toArray(); 
      // prd($orderId);
      $address_id = OrderManager::selectRaw("order_management.*")->where('id',$orderId)->orderby('id','desc')->first(); 
       
      // $id = $address_id[0]['address_id'];
      // prd($id);
      $address = AddAddress::selectRaw("user_addresses.*,u.first_name as name")
                      ->leftjoin('users as u','user_addresses.user_id', '=','u.id')
                      ->where('user_addresses.id',$address_id->address_id)
                      ->where('user_addresses.primary_address','1')
                      ->orderby('id','desc')  
                      ->get()->toArray();
                      // prd($address);
        if(!empty($address))
        {
          $i = 0;
          foreach($address as $raw)
          {
            foreach ($raw as $key => $value) 
            {  
              $shipping_detail[$i][$key] = !empty($value)?$value:"";    
            }
            $i++;
          }  
          
        }
      $product_detail = OrderManagementTransection::selectRaw("pm.id,pm.discount_price,pm.product_weight,pm.product_name,pm.product_image,pm.mrp_price,pm.product_desc")
        ->leftjoin('product_management as pm','order_management_transection.product_id', '=','pm.id')
        ->leftjoin('order_management as om','order_management_transection.order_id', '=','om.id')
        ->where('om.delivered_user_id',$user_id)
        ->orderby('order_management_transection.product_id','desc')
        ->groupBy('order_management_transection.product_id')
        ->get()->toArray();
// prd($product_detail);
        if(!empty($product_detail))
        {
          $i = 0;
          foreach($product_detail as $raw)
          {
            foreach ($raw as $key => $value) 
            {  
              if($key == 'product_image')
              {   
                $product_details[$i][$key] = !empty($value)?URL('products_image').'/'.$value:"";

              }else{
                $product_details[$i][$key] = !empty($value)?$value:"";
              }  
            }
            $i++;
          }  
          
        }
      
      
      $data1 = OrderStatusTransaction::selectRaw("os.status_title,order_status_transection.status_date")
                    ->leftjoin('order_status as os','order_status_transection.status_id', '=','os.id')
                    ->where('order_status_transection.order_id',$orderId)
                    ->orderby('os.id','asc')
                    ->get()->toArray();
                    
        $total_status = count($data1);
        $total_status = !empty($total_status)?$total_status-1:'0';
        $current_status = '';
        if(!empty($data1))
        {
          $i = 0;
          foreach($data1 as $raw)
          {
            foreach ($raw as $key => $value) 
            {  
              $order_status[$i][$key] = !empty($value)?$value:"";    
            }
            if($total_status == $i)
            {
              $current_status = $raw['status_title'];
            }
            $i++;
          }  
          
        }

        $data2 = OrderManager::selectRaw("order_management.sub_total,order_management.tax,order_management.coupon_discount,order_management.total_cost")->where('order_management.id',$orderId)->orderby('id','desc')->get()->toArray(); 
        if(!empty($data2))
        {
          $i = 0;
          foreach($data2 as $raw)
          {
            foreach ($raw as $key => $value) 
            {  
              $price_detail[$i][$key] = !empty($value)?$value:"";    
            }
            $i++;
          }  
          
        }
       
        if(!empty($order_detail))
        {
        $data['order_detail'] = $order_detail;
        }else{
          $data['order_detail'] = [];
        }
         $data['current_status']= $current_status;
        if(!empty($order_status))
        {
        $data['order_status'] = $order_status; 
        }else{
          $data['order_status'] = [];
        }
        if(!empty($shipping_detail))
        {
        $data['shipping_detail'] = $shipping_detail; 
        }else{
          $data['shipping_detail'] = [];
        }
        if(!empty($product_details))
        {
        $data['product_details'] = $product_details; 
        }else{
          $data['product_details'] = [];
        }
        if(!empty($price_detail))
        {
        $data['price_detail'] = $price_detail; 
        }else{
          $data['price_detail'] = [];
        }
        


        return response()->json([ 'status' => 'success', 'code' => 200, "data" =>$data]);
    }

    
}

