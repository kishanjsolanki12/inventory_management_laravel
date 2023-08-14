<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    Public function index()
    {
    	return view('admin.dashboard');
    }
    
    public function displayImage($filename)

	{

	  

	    $path = storage_public('product_images/' . $filename);

	   

	    if (!File::exists($path)) {

	        abort(404);

	    }

	  

	    $file = File::get($path);

	    $type = File::mimeType($path);

	  

	    $response = Response::make($file, 200);

	    $response->header("Content-Type", $type);

	 

	    return $response;

	}
}
