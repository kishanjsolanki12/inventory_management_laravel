<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\ProductManager;
use App\Models\Category;

use App\Models\ProductImages;
use App\Models\User;
use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class ProductController extends Controller
{
    //
    function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {

        $product_management = ProductManager::selectRaw("product_management.*,cat.category_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                            ->leftjoin('category as cat','product_management.category_id','=','cat.id')
                                            ->leftjoin('users as u','product_management.vendor_id','=','u.id')
                                            ->where('product_management.deleted_at',NULL)
                                            ->orderby('id','desc')
                                            ->paginate(20);
        }else{
            $product_management = ProductManager::selectRaw("product_management.*,cat.category_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                            ->leftjoin('category as cat','product_management.category_id','=','cat.id')
                                            ->leftjoin('users as u','product_management.vendor_id','=','u.id')
                                            ->where('product_management.vendor_id',auth()->id())
                                            ->where('product_management.deleted_at',NULL)
                                            ->orderby('id','desc')
                                            ->paginate(20);
        }
        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.product_management.index',['product_management' => $product_management,'vendor_name'=>$vendor_name]);
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
                $vendor_name_str = ' and product_management.vendor_id ='.$vendor_id ;
            }
            $query_str = '';
            $query = str_replace(" ", "%", $query);
            if(!empty($query))
            {
                $query_str = ' and (product_management.product_name like "%'.$query.'%" or cat.category_name like "%'.$query.'%" )';
            }
            if(!Auth::user()->hasRole('Vendor')) {

            $product_management = ProductManager::selectRaw("product_management.*,cat.category_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                        ->leftjoin('category as cat','product_management.category_id','=','cat.id')
                                        ->leftjoin('users as u','product_management.vendor_id','=','u.id')
                                        ->where('product_management.deleted_at',NULL)
                                        ->whereRaw('product_management.id != "" '.$query_str.$vendor_name_str)
                                        ->orderBy($sort_by, $sort_type)
                                        ->paginate($per_page);
            }else{
                $product_management = ProductManager::selectRaw("product_management.*,cat.category_name ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                        ->leftjoin('category as cat','product_management.category_id','=','cat.id')
                                        ->leftjoin('users as u','product_management.vendor_id','=','u.id')
                                        ->where('product_management.deleted_at',NULL)
                                        ->where('product_management.vendor_id',auth()->id())
                                        ->whereRaw('product_management.id != "" '.$query_str)
                                        ->orderBy($sort_by, $sort_type)
                                        ->paginate($per_page);
            }

                                            // ->toSql();
                                            // prd($party_images);
            return view('admin.product_management.user_pagination_data', compact('product_management'))->render();
        }

    }


    public function create()
    {
        $title = 'Add Product';
        if(!Auth::user()->hasRole('Vendor')) {

                $category_name = Category::orderby('id','DESC')->where('deleted_at',NULL)->where('parent_id',0)->get();
            }else{
                $category_name = Category::orderby('id','DESC')->where('deleted_at',NULL)->where('vendor_id',auth()->id())->get();
            }


        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

        return view('admin.product_management.create',compact('title','category_name','vendor_name'));
    }






    public function store(Request $request)
    {
        $postData = request()->all();

        //  prd($postData);
         $id = $postData['id'];
        // prd( $id);
        if($id)
        {
            $image_id = $request['remove_image_id'];
            // prd($image_id);
            if(!empty($image_id))
            {


            foreach($image_id as $image_remove)
            {
                if(!empty($image_remove))
                {
                    $images = ProductImages::findOrFail($image_remove);
                    $image_path = public_path('products_image/'.$images->image_name);
                    if(file_exists($image_path))
                    {
                      unlink($image_path);
                    }
                    ProductImages::find($image_remove)->delete();
                }
            }
        }

            $product_update['product_name'] = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
            $product_update['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
            }else{
            $product_update['vendor_id'] = auth()->id();
            }
            $product_update['category_id'] = !empty($request->category_id)?$request->category_id:'';
            $product_update['rack'] = $request->rack;
            $product_update['variation_type'] = !empty($request->variation_type)?$request->variation_type:'';
            $product_update['purchase_price'] = $request->purchase_price;
            $product_update['sell_price'] = $request->sell_price;
            $product_update['product_desc'] = $request->product_desc;
            $product_update['product_weight'] = $request->product_weight;
            $product_update['size'] = $request->size;
            $product_update['color'] = $request->color;
            $product_update['created_by'] = auth()->id();
            $product_update['created_date'] = date('Y-m-d H:i:s');

            $upload = '';
            $image = $request->file('product_image');

            if(!empty($image))
            {

              $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
              $file_type = $image->getClientMimeType();
              $image->move(public_path('products_image'),$upload);

              $product_update['product_image'] =  $upload;

            }
            // prd($product_update);
            ProductManager::where('id',$id)->update($product_update);

            // ProductImages::where('product_id',$id)-where('id',$images_id)->first();

            $product_id = ProductImages::where('product_id',$id)->first();
            // prd($product_id);

            $image = array();
            if($files = $request->file('multiple_image'))
            {

                foreach($files as $file)
                {

                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'public/products_image/';
                    $image_url = $upload_path.$image_full_name;
                    // $file->move($upload_path, $image_full_name);
                    $file->move(public_path('products_image'),$image_full_name);
                    $image[] = $image_full_name;

                }
            }

            foreach($image as $row => $p_images)
            {
                ProductImages::insert([
                    'product_id' => $id,
                    'image_name' => $p_images,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }


            $msg = 'Product Management updated successfully';

        }else{

            $product_create['product_name'] = $request->product_name;
            if(!Auth::user()->hasRole('Vendor')) {
                $product_create['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $product_create['vendor_id'] = auth()->id();
                }
            $product_create['category_id'] = !empty($request->category_id)?$request->category_id:'';
            $product_create['rack'] = $request->rack;
            $product_create['variation_type'] = !empty($request->variation_type)?$request->variation_type:'';
            $product_create['purchase_price'] = $request->purchase_price;
            $product_create['sell_price'] = $request->sell_price;
            $product_create['product_desc'] = $request->product_desc;
            $product_create['product_weight'] = $request->product_weight;
            $product_create['size'] = $request->size;
            $product_create['color'] = $request->color;
            $product_create['created_by'] = auth()->id();
            $product_create['created_date'] = date('Y-m-d H:i:s');

            $upload = '';
            $image = $request->file('product_image');

            if(!empty($image))
            {


                    $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                    $file_type = $image->getClientMimeType();
                    $image->move(public_path('products_image'),$upload);

                    $product_create['product_image'] =  $upload;

            }


            // prd($product_create);

        $product_id = ProductManager::create($product_create);
                // prd($p_id);
            // Add Multiple Product Images

            $image = array();
            if($files = $request->file('multiple_image'))
            {

                foreach($files as $file)
                {

                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'public/products_image/';
                    $image_url = $upload_path.$image_full_name;
                    // $file->move($upload_path, $image_full_name);
                    $file->move(public_path('products_image'),$image_full_name);
                    $image[] = $image_full_name;

                }
            }

            foreach($image as $row => $p_images)
            {
                // prd($p_images);
                ProductImages::insert([
                    'product_id' => $product_id['id'],
                    'image_name' => $p_images,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }



            $msg = 'Product Management Create successfully';

        }
        return redirect()->route('product_management.index')->with('message', $msg);

    }

    public function show($id)
    {

        // $user = Party::find($id);
        // // $roles = Role::orderBy('id', 'asc')->pluck('name', 'id')->toArray();
        // $userRoles = $user->getRoleNames();
        // $user->roleName = $userRoles[0];
        // return view('admin.vc.show',compact('user','roles'));

    }
    /**

     * Show the form for editing the specified resource.
     *

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function edit(Request $request,$id)
     {
         $title = 'Edit Product';

         $product_management = ProductManager::selectRaw('product_management.* ')

         ->where('id',$id)->orderBy('id','DESC')->get();
         $category_name = Category::orderby('id','DESC')->where('deleted_at',NULL)->where('parent_id',0)->get();
         $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();

         $product_image = ProductImages::where('product_id',$id)->orderBy('id','DESC')->get();
        //   prd($product_image);
        if(!empty($product_image[0]->image_name))
        {
            // echo 1; exit;
            foreach($product_image as $raw)
            {
                $images[$raw->id] = $raw;
                // $p_id[] = $raw->id;
            }

        }else{
            // echo 2; exit;
            $images = '';
            // $p_id ='';
        }



            // prd($images);


         return view('admin.product_management.create',compact('title','product_management','category_name','images','vendor_name'));

     }

     public function destroy($id)

     {

        // ProductManager::find($id)->delete();

        ProductManager::where('id',$id)->update( array('deleted_at' => date('Y-m-d H:i:s')));

         return redirect()->route('product_management.index')

                         ->with('message','Product deleted successfully');


     }

    //  public function deleteimage($id)
    //  {
    //   prd($id);
    //     $images = ProductImages::findOrFail($id);
    //     if(File::exists('product_image/'.$images->image_name))
    //     {
    //         File::delete('product_image/'.$images->image_name);
    //     }
    //     ProductImages::find($id)->delete();
    //     return back();
    //  }
}




