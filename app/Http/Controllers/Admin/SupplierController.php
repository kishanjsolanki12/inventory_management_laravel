<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\ProductPurchase;
use App\Models\ProductManager;
use App\Models\ProductSell;
use App\Models\Supplier;
use App\Models\User;

use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class SupplierController extends Controller
{
    //
    function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {
        $suppliers = Supplier::selectRaw("suppliers.*,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                ->leftjoin('users as u','suppliers.vendor_id','=','u.id')
                                ->orderby('id','desc')
                                ->paginate(20);
        }else{
            $suppliers = Supplier::selectRaw("suppliers.*,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                ->leftjoin('users as u','suppliers.vendor_id','=','u.id')
                                ->where('suppliers.vendor_id',auth()->id())
                                ->orderby('id','desc')
                                ->paginate(20);
        }


        return view('admin.supplier.index',['suppliers' => $suppliers]);
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

            $query_str = '';
            $query = str_replace(" ", "%", $query);
            if(!empty($query))
            {
                $query_str = ' and (suppliers.first_name like "%'.$query.'%" )';
            }

            if(!Auth::user()->hasRole('Vendor')) {
            $suppliers = Supplier::selectRaw("suppliers.*,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
            ->leftjoin('users as u','suppliers.vendor_id','=','u.id')
                            ->whereRaw('suppliers.id != "" '.$query_str )->orderBy($sort_by, $sort_type)->paginate($per_page);
            }else{
                $suppliers = Supplier::selectRaw("suppliers.*,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                ->leftjoin('users as u','suppliers.vendor_id','=','u.id')
                ->where('suppliers.vendor_id',auth()->id()) ->whereRaw('suppliers.id != "" '.$query_str )->orderBy($sort_by, $sort_type)->paginate($per_page);
            }


            return view('admin.supplier.user_pagination_data', compact('suppliers'))->render();
        }

    }


    public function create()
    {
        $title = 'Add Supplier';
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.supplier.create',compact('title','vendor_name'));
    }






    public function store(Request $request)
    {
        $postData = request()->all();

        //  prd($postData);
         $id = $postData['id'];
        // prd( $id);
        if($id)
        {
            if(!Auth::user()->hasRole('Vendor')) {
                $supplier_updated['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $supplier_updated['vendor_id'] = auth()->id();
                }
            $supplier_updated['first_name']  = $request->first_name;
            $supplier_updated['last_name']  = $request->last_name;
            $supplier_updated['email']  = $request->email;
            $supplier_updated['mobile']  = $request->mobile;
            $supplier_updated['address']  = $request->address;
            $supplier_updated['modified_by'] = auth()->id();
            $supplier_updated['modified_date'] = date('Y-m-d H:i:s');

            $upload = '';
            $image = $request->file('image_name');
            // pr($image);
            if(!empty($image))
            {

            $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
            $file_type = $image->getClientMimeType();
            $image->move(public_path('images'),$upload);

            $supplier_updated['image'] =  $upload;

            }
            // prd($supplier_updated);
            Supplier::where('id',$id)->update($supplier_updated);

            $msg = 'Supplier updated successfully';

        }else{
            if(!Auth::user()->hasRole('Vendor')) {
                $supplier_created['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $supplier_created['vendor_id'] = auth()->id();
                }
            $supplier_created['first_name']  = $request->first_name;
            $supplier_created['last_name']  = $request->last_name;
            $supplier_created['email']  = $request->email;
            $supplier_created['mobile']  = $request->mobile;
            $supplier_created['address']  = $request->address;
            $supplier_created['created_by'] = auth()->id();
            $supplier_created['created_date'] = date('Y-m-d H:i:s');

            $upload = '';
            $image = $request->file('image_name');
            // pr($image);
            if(!empty($image))
            {

            $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
            $file_type = $image->getClientMimeType();
            $image->move(public_path('images'),$upload);

            $supplier_created['image'] =  $upload;

            }
            // prd($supplier_created);
            Supplier::create($supplier_created);

            $msg = 'Supplier Create successfully';

        }
        return redirect()->route('supplier.index')->with('message', $msg);

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function edit(Request $request,$id)
     {
         $title = 'Edit Supplier';
        // prd($id);
         $suppliers = Supplier::selectRaw("suppliers.*")->where('id',$id)->orderBy('id','DESC')->get();

        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();


         return view('admin.supplier.create',compact('title','suppliers','vendor_name'));

     }

     public function destroy($id)

     {

        Supplier::find($id)->delete();

        // ProductSell::where('id',$id)->update( array('deleted_at' => date('Y-m-d H:i:s')));

         return redirect()->route('supplier.index')

                         ->with('message','Supplier deleted successfully');


     }


}




