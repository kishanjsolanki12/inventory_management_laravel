<?php



namespace App\Http\Middleware;



use Closure;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Crypt;

class ApiBase

{

    /**

     * Handle an incoming request for an Admin route - throw '403 Forbidden' if user does not have role of Admin

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle(Request $request, Closure $next)

    {

        //public $system_user_id = 0;

        $header = apache_request_headers();

          //pr($request->all());exit;

          $header = array_change_key_case($header,CASE_LOWER);

          $segment = $request->segment(2);

          if(!empty($header) && !empty($header['x-api-key'])){

              $token = $header['x-api-key'];

          }

          else{

            $token = '';

          }

          

          if($segment != "login" && $segment != "forgotPassword"){

          if(!empty($token))

          {

            $token = Crypt::decryptString($token);

            $user = User::find($token);

            

            if(!empty($user->id))

            {

               //$request->attributes->add(['system_user_id' => $user->id]);

               $request->request->add(['system_user_id' => $user->id]);

              return $next($request);

              //prd($this->system_user_id);

              //return response()                  ->json(['status'=>'sucess','id' => $user->id]);

             //$this->system_user_role = ($user->hasRole('User'))?'User':'Admin';

            }

             else

            {



              return response()

                      ->json(['status'=>'error','message' => 'Invalid token'], 401);

            }

          }

          else

          {



            return response()

                    ->json(['status'=>'error','message' => 'Please enter access token'], 401);

          }

          }

    }

}

