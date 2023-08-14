<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\ProductPurchase;
use App\Models\ProductManager;
use App\Models\ProductSell;
use App\Models\User;
use App\Models\Supplier;
use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class ProductSellController extends Controller
{
    //
    function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {
        $product_sell = ProductSell::selectRaw("product_sell.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                        ->leftjoin('product_management as pm','product_sell.product_id','=','pm.id')
                        ->leftjoin('users as u','product_sell.vendor_id','=','u.id')
                        ->orderby('id','desc')->paginate(20);
        }else{
            $product_sell = ProductSell::selectRaw("product_sell.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
            ->leftjoin('product_management as pm','product_sell.product_id','=','pm.id')
            ->leftjoin('users as u','product_sell.vendor_id','=','u.id')
            ->where('product_sell.vendor_id',auth()->id())
            ->orderby('id','desc')->paginate(20);
        }

        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.product_sell.index',['product_sell' => $product_sell,'vendor_name'=>$vendor_name]);
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
                $vendor_name_str = ' and product_sell.vendor_id ='.$vendor_id ;
            }

            $query_str = '';
            $query = str_replace(" ", "%", $query);
            if(!empty($query))
            {
                $query_str = ' and (pm.product_name like "%'.$query.'%" )';
            }

            if(!Auth::user()->hasRole('Vendor')) {
            $product_sell = ProductSell::selectRaw("product_sell.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                            ->leftjoin('product_management as pm','product_sell.product_id','=','pm.id')
                            ->leftjoin('users as u','product_sell.vendor_id','=','u.id')
                            ->whereRaw('product_sell.id != "" '.$query_str.$vendor_name_str )->orderBy($sort_by, $sort_type)->paginate($per_page);
             } else{
                $product_sell = ProductSell::selectRaw("product_sell.*,pm.product_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                ->leftjoin('product_management as pm','product_sell.product_id','=','pm.id')
                ->leftjoin('users as u','product_sell.vendor_id','=','u.id')
                ->where('product_sell.vendor_id',auth()->id())
                ->whereRaw('product_sell.id != "" '.$query_str )->orderBy($sort_by, $sort_type)->paginate($per_page);
            }

            return view('admin.product_sell.user_pagination_data', compact('product_sell'))->render();
        }

    }


    public function create()
    {
        $title = 'Add Product Sell';
        if(!Auth::user()->hasRole('Vendor')) {
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->get();
        $supllier_name = Supplier::orderby('id','DESC')->get();

    }
    else{
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->where('vendor_id',auth()->id())->get();
        $supllier_name = Supplier::orderby('id','DESC')->where('vendor_id',auth()->id())->get();

        }
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.product_sell.create',compact('title','product_name','vendor_name','supllier_name'));
    }






    public function store(Request $request)
    {
        $postData = request()->all();

        //  prd($postData);
         $id = $postData['id'];
        // prd( $id);
        if($id)
        {
            $product_sell_updated['product_id']  = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
                $product_sell_updated['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $product_sell_updated['vendor_id'] = auth()->id();
                }
            $product_sell_updated['supplier_id']  = $request->supplier_id;
            $product_sell_updated['qty']  = $request->qty;
            $product_sell_updated['sell_amount']  = $request->sell_amount;
            $product_sell_updated['sell_total_amount']  = $request->sell_total_amount;
            $product_sell_updated['variation_type']  = $request->variation_type;
            $product_sell_updated['size']  = $request->size;
            $product_sell_updated['color']  = $request->color;
            $product_sell_updated['product_desc']  = $request->product_desc;
            $product_sell_updated['product_weight']  = $request->product_weight;

            $product_sell_updated['modified_date'] = date('Y-m-d H:i:s');


            ProductSell::where('id',$id)->update($product_sell_updated);
            //  // product qty update
            //  $product_qty = ProductPurchase::orderBy('id','DESC')->where('product_id',$request->product_name)->get();
            //  // prd($product_qty);
            //  $total_qty =  $product_qty[0]->qty - $request->qty;
            //  ProductPurchase::where('product_id',$request->product_name)->update(array('qty' => $total_qty ));

            $msg = 'Product Sell updated successfully';

        }else{
            $product_sell_created['product_id']  = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
                $product_sell_created['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $product_sell_created['vendor_id'] = auth()->id();
                }
            $product_sell_updated['supplier_id']  = $request->supplier_id;
            $product_sell_created['qty']  = $request->qty;
            $product_sell_created['sell_amount']  = $request->sell_amount;
            $product_sell_created['sell_total_amount']  = $request->sell_total_amount;
            $product_sell_created['variation_type']  = $request->variation_type;
            $product_sell_created['size']  = $request->size;
            $product_sell_created['color']  = $request->color;
            $product_sell_created['product_desc']  = $request->product_desc;
            $product_sell_created['product_weight']  = $request->product_weight;

            $product_sell_created['modified_date'] = date('Y-m-d H:i:s');


            ProductSell::create($product_sell_created);

            // // product qty update
            // $product_qty = ProductPurchase::orderBy('id','DESC')->where('product_id',$request->product_name)->get();
            // // prd($product_qty);
            // $total_qty =  $product_qty[0]->qty - $request->qty;
            // ProductPurchase::where('product_id',$request->product_name)->update(array('qty' => $total_qty ));

            $msg = 'Product Sell Create successfully';

        }
        return redirect()->route('product_sell.index')->with('message', $msg);

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function edit(Request $request,$id)
     {
         $title = 'Edit Product Sell';
        // prd($id);
        if(!Auth::user()->hasRole('Vendor')) {
            $product_sell = ProductSell::selectRaw('product_sell.* ')->where('id',$id)->orderBy('id','DESC')
            ->get();
           //  prd($category);
           $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->get();
           $vendor_name = User::orderBy('id','DESC')->whereHas(
               'roles', function($q){
                   $q->where('name', 'Vendor');
               }
           )->get();
           $supllier_name = Supplier::orderby('id','DESC')->get();
        }
        else{


         $product_sell = ProductSell::selectRaw('product_sell.* ')->where('id',$id)->orderBy('id','DESC')
         ->get();
        //  prd($category);
        $product_name = ProductManager::orderby('id','DESC')->where('deleted_at',NULL)->where('vendor_id',auth()->id())->get();
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        $supllier_name = Supplier::orderby('id','DESC')->where('vendor_id',auth()->id())->get();
        }
         return view('admin.product_sell.create',compact('title','product_sell','product_name','vendor_name','supllier_name'));

     }

     public function destroy($id)

     {

        ProductSell::find($id)->delete();

        // ProductSell::where('id',$id)->update( array('deleted_at' => date('Y-m-d H:i:s')));

         return redirect()->route('product_sell.index')

                         ->with('message','Product Sell deleted successfully');


     }

     public function final_amount(Request $request)
    {


        $product_id =  $request->get('product_id');
        $quantity =  $request->get('quantity');
        $sell_amount =  $request->get('sell_amount');


        $product_amount = ProductManager::where('id',$product_id)->orderBy('id','DESC')->get();

        // prd($product_amount);
        if(!empty($product_amount) && !empty($product_id))
        {

            $amount = $product_amount[0]['sell_price'];

            $total_amount = $quantity * $amount;



           return $total_amount;
        }

    }
    public function product_sell_amount(Request $request)
    {


        $product_id =  $request->get('product_name');
        // echo $product_id; exit;
        $product_amount = ProductManager::where('id',$product_id)->orderBy('id','DESC')->get();

        // prd($final_amount);
        if(!empty($product_amount) && !empty($product_id))
        {
            $amount = $product_amount[0]['sell_price'];
            $product_weight = $product_amount[0]['product_weight'];
            $product_desc = $product_amount[0]['product_desc'];
            $v_id = $product_amount[0]['vendor_id'];
            $variation_type = $product_amount[0]['variation_type'];
            $color = $product_amount[0]['color'];
            $size = $product_amount[0]['size'];
            $product_details = array('amount'=>$amount,'product_weight'=>$product_weight,'product_desc'=>$product_desc,'v_id'=>$v_id,'size'=>$size,'color'=>$color,'variation_type'=>$variation_type);
        //    echo $amount.$product_desc.$product_desc;
           return json_encode($product_details);
        }
    }
}


