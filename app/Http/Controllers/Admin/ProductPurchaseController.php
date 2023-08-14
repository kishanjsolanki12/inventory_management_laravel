<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\ProductPurchase;
use App\Models\ProductManager;
use App\Models\Supplier;
use App\Models\User;

use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class ProductPurchaseController extends Controller
{
    //
    function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {
        $product_purchase = ProductPurchase::selectRaw("product_purchase.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
        ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
        ->leftjoin('users as u','product_purchase.vendor_id','=','u.id')
        ->orderby('id','desc')->paginate(20);
        }else{
            $product_purchase = ProductPurchase::selectRaw("product_purchase.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
        ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
        ->leftjoin('users as u','product_purchase.vendor_id','=','u.id')
        ->where('product_purchase.vendor_id',auth()->id())
                        ->orderby('id','desc')->paginate(20);
        }

        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.product_purchase.index',['product_purchase' => $product_purchase,'vendor_name'=>$vendor_name]);
    }

    function fetch_data(Request $request)
    {

        if($request->ajax())
        {

            $approved_disapproved = $request->get('approved_disapproved');
            $mop = $request->get('mop');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $per_page = $request->get('per_page');
            $query = $request->get('query');
            $vendor_id = $request->get('vendor_id');

            $vendor_name_str = '';
            if(!empty($vendor_id))
            {
                $vendor_name_str = ' and product_purchase.vendor_id ='.$vendor_id ;
            }

            $query_str = '';
            $query = str_replace(" ", "%", $query);
            if(!empty($query))
            {
                $query_str = ' and (pm.product_name like "%'.$query.'%" )';
            }

            if(!Auth::user()->hasRole('Vendor')) {
            $product_purchase =ProductPurchase::selectRaw("product_purchase.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
            ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
            ->leftjoin('users as u','product_purchase.vendor_id','=','u.id')
            ->whereRaw('product_purchase.id != "" '.$query_str.$vendor_name_str )->orderBy($sort_by, $sort_type)->paginate($per_page);

            }else{
                $product_purchase =ProductPurchase::selectRaw("product_purchase.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
                ->leftjoin('users as u','product_purchase.vendor_id','=','u.id')
                ->where('product_purchase.vendor_id',auth()->id())
                ->whereRaw('product_purchase.id != "" '.$query_str)->orderBy($sort_by, $sort_type)->paginate($per_page);

            }
            return view('admin.product_purchase.user_pagination_data', compact('product_purchase'))->render();
        }

    }


    public function create()
    {
        if(!Auth::user()->hasRole('Vendor')) {
        $title = 'Add Product Purchase';
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->get();
        $supllier_name = Supplier::orderby('id','DESC')->get();
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        }else{
             $title = 'Add Product Purchase';
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->where('vendor_id',auth()->id())->get();
        $supllier_name = Supplier::orderby('id','DESC')->where('vendor_id',auth()->id())->get();
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        }
        return view('admin.product_purchase.create',compact('title','product_name','supllier_name','vendor_name'));
    }






    public function store(Request $request)
    {
        $postData = request()->all();

        //  prd($postData);
         $id = $postData['id'];
        // prd( $id);
        if($id)
        {
            $product_purchase_updated['product_id']  = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
                $product_purchase_updated['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $product_purchase_updated['vendor_id'] = auth()->id();
                }
            $product_purchase_updated['supplier_id']  = $request->supplier_id;
            $product_purchase_updated['purchase_date']  = date('Y-m-d',strtotime($request->purchase_date));
            $product_purchase_updated['qty']  = $request->qty;
            $product_purchase_updated['purchase_price']  = $request->purchase_price;
            $product_purchase_updated['purchase_total_price']  = $request->purchase_total_price;
            $product_purchase_updated['variation_type']  = $request->variation_type;
            $product_purchase_updated['size']  = $request->size;
            $product_purchase_updated['color']  = $request->color;
            $product_purchase_updated['product_desc']  = $request->product_desc;
            $product_purchase_updated['product_weight']  = $request->product_weight;
            $product_purchase_updated['modified_by'] = auth()->id();
            $product_purchase_updated['modified_date'] = date('Y-m-d H:i:s');


            ProductPurchase::where('id',$id)->update($product_purchase_updated);

            $msg = 'Product Purchase updated successfully';

        }else{
            $product_purchase_created['product_id']  = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
                $product_purchase_created['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $product_purchase_created['vendor_id'] = auth()->id();
                }
            $product_purchase_created['supplier_id']  = $request->supplier_id;
            $product_purchase_created['purchase_date']  = date('Y-m-d',strtotime($request->purchase_date));
            $product_purchase_created['qty']  = $request->qty;
            $product_purchase_created['purchase_price']  = $request->purchase_price;
            $product_purchase_created['purchase_total_price']  = $request->purchase_total_price;
            $product_purchase_created['variation_type']  = $request->variation_type;
            $product_purchase_created['size']  = $request->size;
            $product_purchase_created['color']  = $request->color;
            $product_purchase_created['product_desc']  = $request->product_desc;
            $product_purchase_created['product_weight']  = $request->product_weight;
            $product_purchase_created['modified_by'] = auth()->id();
            $product_purchase_created['modified_date'] = date('Y-m-d H:i:s');


            ProductPurchase::create($product_purchase_created);

            $msg = 'Product Purchase Create successfully';

        }
        return redirect()->route('product_purchase.index')->with('message', $msg);

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function edit(Request $request,$id)
     {
         $title = 'Edit Product Purchase';
         if(!Auth::user()->hasRole('Vendor')) {
            $product_purchase = ProductPurchase::selectRaw('product_purchase.* ')->where('id',$id)->orderBy('id','DESC')
            ->get();
            $vendor_name = User::orderBy('id','DESC')->whereHas(
               'roles', function($q){
                   $q->where('name', 'Vendor');
               }
           )->get();
           $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->get();
           $supllier_name = Supplier::orderby('id','DESC')->get();
         }else{
         $product_purchase = ProductPurchase::selectRaw('product_purchase.* ')->where('id',$id)->orderBy('id','DESC')
         ->get();
         $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->where('vendor_id',auth()->id())->get();
        $supllier_name = Supplier::orderby('id','DESC')->where('vendor_id',auth()->id())->get();
         }

         return view('admin.product_purchase.create',compact('title','product_purchase','product_name','supllier_name','vendor_name'));

     }

     public function destroy($id)

     {

        ProductPurchase::find($id)->delete();

        // ProductPurchase::where('id',$id)->update( array('deleted_at' => date('Y-m-d H:i:s')));

         return redirect()->route('product_purchase.index')

                         ->with('message','Product Purchase deleted successfully');


     }

     public function final_amount(Request $request)
    {


        $product_id =  $request->get('product_id');
        $quantity =  $request->get('quantity');
        $unit_price =  $request->get('purchase_price');


        $product_amount = ProductManager::where('id',$product_id)->orderBy('id','DESC')->get();

        // prd($product_amount);
        if(!empty($product_amount) && !empty($product_id))
        {

            $amount = $product_amount[0]['purchase_price'];

            $total_amount = $quantity * $amount;



           return $total_amount;
        }

    }
    public function product_purchase_amount(Request $request)
    {


        $product_id =  $request->get('product_name');
        // echo $product_id; exit;
        $product_amount = ProductManager::where('id',$product_id)->orderBy('id','DESC')->get();

        // prd($final_amount);
        if(!empty($product_amount) && !empty($product_id))
        {
            $amount = $product_amount[0]['purchase_price'];
            $product_weight = $product_amount[0]['product_weight'];
            $product_desc = $product_amount[0]['product_desc'];
            $variation_type = $product_amount[0]['variation_type'];
            $v_id = $product_amount[0]['vendor_id'];
            $color = $product_amount[0]['color'];
            $size = $product_amount[0]['size'];

            $product_details = array('amount'=>$amount,'product_weight'=>$product_weight,'product_desc'=>$product_desc,'v_id'=>$v_id,'variation_type'=>$variation_type,'size'=>$size,'color'=>$color);
        //    echo $amount.$product_desc.$product_desc;
           return json_encode($product_details);
        }
    }
}





