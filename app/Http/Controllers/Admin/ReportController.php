<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\ProductPurchase;
use App\Models\ProductManager;
use App\Models\ProductSell;

use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class ReportController extends Controller
{
    // product Report Listing

    public function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {
            $product_reports = ProductPurchase::SelectRaw('product_purchase.*,pm.product_name,ps.qty as sell_qty,pm.sell_price,ps.sell_total_amount')
            ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
            ->leftjoin('product_sell as ps','product_purchase.product_id','=','ps.product_id')
            ->orderby('id','desc')->paginate(20);
            }
            else{
                $product_reports = ProductPurchase::SelectRaw('product_purchase.*,pm.product_name,ps.qty as sell_qty,pm.sell_price,ps.sell_total_amount')
            ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
            ->leftjoin('product_sell as ps','product_purchase.product_id','=','ps.product_id')->where('product_purchase.vendor_id',auth()->id())
            ->orderby('id','desc')->paginate(20);
            }
        return view('admin.report.index',['product_reports' => $product_reports]);
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
            $product_reports = ProductPurchase::SelectRaw('product_purchase.*,pm.product_name,ps.qty as sell_qty,pm.sell_price,ps.sell_total_amount')
            ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
            ->leftjoin('product_sell as ps','product_purchase.product_id','=','ps.product_id')
            ->whereRaw('product_purchase.id != "" '.$query_str.$vendor_name_str )->orderby('id','desc')->paginate(20);
            }
            else{
                $product_reports = ProductPurchase::SelectRaw('product_purchase.*,pm.product_name,ps.qty as sell_qty,pm.sell_price,ps.sell_total_amount')
            ->leftjoin('product_management as pm','product_purchase.product_id','=','pm.id')
            ->leftjoin('product_sell as ps','product_purchase.product_id','=','ps.product_id')->where('product_purchase.vendor_id',auth()->id())
            ->whereRaw('product_purchase.id != "" '.$query_str)->orderby('id','desc')->paginate(20);
            }
        }
        return view('admin.report.user_pagination_data',['product_reports' => $product_reports]);

    }

}
