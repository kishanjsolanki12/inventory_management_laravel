<?php

    

namespace App\Http\Controllers\Admin;

    

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\EmailTemplates;

use DB;

use Hash;

use Illuminate\Support\Arr;

    

class EmailTemplate extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
    {

        $email_templates = EmailTemplates::orderBy('id','DESC')->paginate(20);


       

        return view('admin.email_template.index', ['email_templates' => $email_templates]);
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
      $per_page = $request->get('per_page');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
        $email_templates =     EmailTemplates::where('name', 'like', '%'.$query.'%')
                    ->orWhere('template_title', 'like', '%'.$query.'%')
                    ->orWhere('template_subject', 'like', '%'.$query.'%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate($per_page);

    
      return view('admin.email_template.email_template_ajax_data', compact('email_templates'))->render();
     }
    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {


        return view('admin.email_template.create');

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
            'template_title'  => 'required',
            'template_unique_id'     => 'required|unique:email_templates,template_unique_id',
            'template_subject'  => 'required',
            'template_content' => 'sometimes',
            'template_status' => 'sometimes',
            
        ]);

        $postData = request()->all();
      
        // Create user
        $user = EmailTemplates::create($validatedAttributes);

        return redirect()->route('email_templates.index')->with('message', 'Email template created successfully');

    }

    

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $email_template = EmailTemplates::find($id);
        
        return view('admin.email_template.show',compact('email_template'));

    }

    

    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit(EmailTemplates $email_template)

    {

        //$user = User::find($id);

      
        return view('admin.email_template.edit', ['email_template' => $email_template]);

    }

    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, EmailTemplates $email_template)

    {

      $validatedAttributes = request()->validate([
            'template_title'  => 'required',
         
            'template_subject'  => 'required',
            'template_content' => 'sometimes',
            'template_status' => 'sometimes',
        ]);

      
          $postData = request()->all();

    
        $email_template->update($validatedAttributes);
        
        return redirect()->route('email_templates.index')->with('message', 'Email tempate updated successfully');

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        EmailTemplates::find($id)->delete();

        return redirect()->route('email_template.index')

                        ->with('message','Email templates deleted successfully.');


    }

}