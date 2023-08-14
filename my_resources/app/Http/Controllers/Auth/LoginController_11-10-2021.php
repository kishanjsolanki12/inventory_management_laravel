<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /*public function redirectTo()
    {
    
        if(auth()->user()->hasRole('Admin'))
        {
            
            return '/admin';

        }
        if(auth()->user()->hasRole('Yusen Staff'))
        {
            
            return '/yusen/orders';

        }
        else
        { 
            return '/';
        }
    }*/
    public function authenticated(Request $request,$user)
    {
    
        if($user->hasRole('Admin'))
        {
            
            return redirect('/admin');

        }
        if($user->hasRole('Yusen Staff'))
        {
            
            return redirect('/yusen/orders');

        }
        else
        { 
            
            return redirect('/');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
