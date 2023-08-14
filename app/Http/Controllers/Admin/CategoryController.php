<?php

namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Role;
use App\Models\Category;
use App\Models\User;

use DB;
use Auth;
use Hash;

use Illuminate\Support\Arr;

class CategoryController extends Controller
{
    //
    function index(Request $request)
    {
        if(!Auth::user()->hasRole('Vendor')) {
            $category = Category::selectRaw("category.* ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")->leftjoin('users as u','category.vendor_id','=','u.id')->where('parent_id',0)->where('deleted_at',NULL)->with('_nLevelCat')->orderby('id','desc')->paginate(5);

        }else{
            // return Auth()->id();
            $category = Category::selectRaw("category.* ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")->leftjoin('users as u','category.vendor_id','=','u.id')->where('category.parent_id',0)->where('category.deleted_at',NULL)->where('category.vendor_id',auth()->id())->with('_nLevelCat')->orderby('id','desc')->paginate(5);
         //remove from top    //
        }



        // prd($category);
        return view('admin.category.index',['category' => $category]);
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
                $query_str = ' and (category_name like "%'.$query.'%")';
            }

            if(!Auth::user()->hasRole('Vendor')) {
            $category = Category::selectRaw("category.* ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                        ->leftjoin('users as u','category.vendor_id','=','u.id')
                                        ->where('category.parent_id',0)->with('_nLevelCat')
                                        ->whereRaw('category.id != "" '.$query_str )
                                        ->orderBy($sort_by, $sort_type)
                                        ->where('deleted_at',NULL)
                                        ->paginate($per_page);
            }else{
                $category = Category::selectRaw("category.* ,concat(COALESCE(u.first_name,''),' ',COALESCE(u.last_name,'')) as vendor_name")
                                        ->leftjoin('users as u','category.vendor_id','=','u.id')
                                        ->where('category.parent_id',0)->with('_nLevelCat')
                                        ->where('category.vendor_id',auth()->id())
                                        ->whereRaw('category.id != "" '.$query_str )
                                        ->orderBy($sort_by, $sort_type)
                                        ->where('deleted_at',NULL)
                                        ->paginate($per_page);
            }

                                            // ->toSql();
                                            // prd($party_images);
            return view('admin.category.user_pagination_data', compact('category'))->render();
        }

    }


    public function create()
    {

        $title = 'Add Category';
        if(!Auth::user()->hasRole('Vendor')) {
            $sub_category_name = Category::selectRaw('category.*')->where('parent_id',0)->where('deleted_at',NULL)->with('_nLevelCat')->get();
        }else{
            // return Auth()->id();
            $sub_category_name = Category::selectRaw('category.*')->where('vendor_id',auth()->id())->where('deleted_at',NULL)->with('_nLevelCat')->get();
        }

        $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        // prd($sub_category_name);
        return view('admin.category.create',compact('title','sub_category_name','vendor_name'));
    }






    public function store(Request $request)
    {
        $postData = request()->all();

        //  pr($postData);
         $id = $postData['id'];
        // prd( $id);
        if($id)
        {

            // Category::where('id',$request->sub_category_id)->update(['parent_id' => $id]);

            $update_category['category_name']  = $request->category_name;
            $update_category['parent_id']  = $request->sub_category_id;
            if(!Auth::user()->hasRole('Vendor')) {
                $update_category['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $update_category['vendor_id'] = auth()->id();
                }
            $update_category['modified_by'] = auth()->id();
            $update_category['modified_date'] = date('Y-m-d H:i:s');

            $upload = '';

            $image = $request->file('category_image');
            if(!empty($image))
            {

              $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
              $file_type = $image->getClientMimeType();
              $image->move(public_path('category_images'),$upload);

              $update_category['category_image'] =  $upload;

            }


            Category::where('id',$id)->update($update_category);

            $msg = 'Category updated successfully';

        }else{

            $create_category['category_name'] = $request->category_name;
            $create_category['parent_id']  = !empty($request->sub_category_id)?$request->sub_category_id:'0';
            if(!Auth::user()->hasRole('Vendor')) {
                $create_category['vendor_id'] = !empty($request->vendor_id)?$request->vendor_id:'';
                }else{
                $create_category['vendor_id'] = auth()->id();
                }
            $create_category['created_by'] = auth()->id();
            $create_category['created_date'] = date('Y-m-d H:i:s');

            $upload = '';
            $image = $request->file('category_image');

            if(!empty($image))
            {

              $upload = time().'_'.rand().'.'.$image->getClientOriginalExtension();
              $file_type = $image->getClientMimeType();
              $image->move(public_path('category_images'),$upload);

              $create_category['category_image'] =  $upload;

            }
            // prd($create_category);
            Category::create($create_category);

            $msg = 'Category Create successfully';

        }
        return redirect()->route('category.index')->with('message', $msg);

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

     public function edit(Request $request,$id)
     {
         $title = 'Edit Category';
        // prd($id);
        if(!Auth::user()->hasRole('Vendor')) {
            $category = Category::selectRaw('category.* ')->with('_nLevelCat')->where('deleted_at',NULL)->where('id',$id)->orderBy('id','DESC')
            ->get();
        }else{
         $category = Category::selectRaw('category.* ')->with('_nLevelCat')->where('deleted_at',NULL)->where('id',$id)->where('vendor_id',auth()->id())->orderBy('id','DESC')
         ->get();}
         $vendor_name = User::orderBy('id','DESC')->whereHas(
            'roles', function($q){
                $q->where('name', 'Vendor');
            }
        )->get();
        //  prd($category);
         $parent_id = 0;

         $sub_category_name = array();
         $sub_category = Category::selectRaw('category.*')->where('deleted_at',NULL)->where('parent_id',0)->with('_nLevelCat')->get();
         foreach ($sub_category as $item){
             $sub_category_name[] = $item;

         }
        //  prd($sub_category_name);

         return view('admin.category.create',compact('title','category','sub_category_name','vendor_name'));

     }

     public function destroy($id)

     {

        // Category::find($id)->delete();

         Category::where('id',$id)->update( array('deleted_at' => date('Y-m-d H:i:s')));

         return redirect()->route('category.index')

                         ->with('message','Category deleted successfully');


     }
}




