<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
         <!-- css -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
         <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/media.css') }}" rel="stylesheet">
        <link href="{{ asset('css/runtime.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">  
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link rel="stylesheet" href="{{ asset('css/jquery.confirm.css') }}"> 
         <!-- <link rel="stylesheet" href="{{ mix('css/main.css') }}"> -->
        <!-- scripts -->
        <script type="text/javascript" src="{{URL::asset('/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/runtime.js')}}"></script>
    </head>
    <body>
    <div class="main wp-float">
        
        @include('layouts.front-navigation')
        <div class="inner-section wp-float">
            <div class="breadcrum wp-float">
                <div class="container">
                    <div class="row">
                         {{ $header }}
                        <!-- <div class="col-sm-12">
                            <ul>
                                <li>Categories</li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                        
              @if (session('message'))

                  <div class="alert-banner bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 shadow-md" role="alert">
                      <div class="flex">
                          <div class="py-1">
                            <!--   <svg class="fill-current h-6 w-5 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg> -->
                          </div>
                          <div>
                              <p class="py-1">{{ session('message') }}</p>
                          </div>
                      </div>
                  </div>

              @endif
            
      </div>
            <!-- main page content -->
           {{ $slot }}
                        
                    
                   
              
        </div>

        <div class="footer footer-inner wp-float">
            <div class="container">
                <div class="row">
                   <!--  <div class="col-sm-2">
                        <img src="{{URL::asset('images/oh2-logo.png')}}" class="img-fluid">

                    </div>
                    <div class="col-sm-7">

                        <p><a href="#">Terms and conditions</a><a href="#">privacy policy</a><a href="#">disclaimer</a></p>
                        <p>LEGO and the LEGO logo are trademarks of the LEGO Group. ©2021 The LEGO Group. ©2021 Physiocare LTd. All rights reserved.</p>

                    </div> -->
                    <!-- <div class="col-sm-3">
                        <img src="{{ asset('images/dep-logo.png') }}" class="img-fluid pull-right right-logo">

                    </div> -->
                </div>
            </div>
        </div>
            </div>
        </body>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
        <footer>
        <script type="text/javascript" src="{{URL::asset('/js/parsley.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/select2.min.js')}}"></script>
         <script type="text/javascript" src="{{URL::asset('/js/jquery.confirm.js')}}"></script>
         <script>
            $(".open-menu").click(function(){
                $(".menu").toggle();
            });
        </script>

        <script type="text/javascript">
    $('#select_currency').change(function(){
        var uid = <?=Auth::id()?>;
        var currency_id = $(this).val();

        $.ajax({
       url:"/home/select_currency?user_id="+uid+"&currency_id="+currency_id,
       success:function(data)
       {
            window.location.reload();
       }
      });
    });
     
</script>
    </footer>
        
        </html>
