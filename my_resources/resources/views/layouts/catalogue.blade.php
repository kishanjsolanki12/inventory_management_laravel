<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <link rel="stylesheet" href="{{URL::asset('/css/runtime.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css') }}"> 
         <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/media.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/jquery.confirm.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">  
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{URL::asset('/js/jquery.min.js')}}"></script>
        
        <script type="text/javascript" src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/runtime.js')}}"></script>
        <style type="text/css">
            select#select_currency {
                    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e);
                    background-position: right 0.5rem center;
                    background-repeat: no-repeat;
                    background-size: 1.5em 1.5em;
                    padding: 8px 29px;
                    -webkit-print-color-adjust: exact;
                    color-adjust: exact;
                }
            .inner-header {
                    padding: 72px 80px;
                }
                .container {
                    max-width: 1800px;
                }
                .container {
                    width: 100%;
                    padding-right: 15px;
                    padding-left: 15px;
                    margin-right: auto;
                    margin-left: auto;
                }
                .inner-header ul {
                    margin-bottom: 0 !important;
                    margin-top: 56px !important;
                }
                .inner-header ul {
                    text-align: right!important;
                }
                .inner-header{ padding:72px 80px !important;}
                .inner-header ul{        text-align: right !important;}
                .inner-header ul li{display: inline !important;}
                .inner-header ul li img{    height: 40px !important;}
                .inner-header .logo-left{margin:0 !important;}
                    .inner-header input[type="search"]{    border: 0 !important;
                    height: 40px !important;
                    text-align: center !important;
                    width: 280px !important;
                    outline: 0 !important;
                    position: relative !important;
                    top: 3px !important;}

                .inner-header ul li{margin-left:20px !important;
                    position: relative !important;
                }
                .inner-header ul {margin-bottom:0 !important;    margin-top: 56px !important;}
                .menu ul{    background: #E7E7E8 !important;
                    margin-top: 0 !important;
                    padding: 20px !important;
                    text-align: left !important;
                    max-width: 355px !important;
                    float: right !important;
                    width: 100% !important;}
                .menu ul li{ display:block !important; margin-bottom:10px !important;}
                .menu ul li a{color:#000 !important; text-decoration:none !important;}
                    .menu{position: absolute !important;
                    right: 15px !important;
                    max-width: 355px !important;
                    float: right !important;
                    width: 100% !important;
                    z-index: 99 !important;
                    }
                    .counter{    position: absolute !important;
                    bottom: -20px !important;
                    left: -10px !important;
                   
                    background: #fff !important;
                    border-radius: 50% !important;
                    color: #A6A4A1 !important;
                    font-family: 'cera_problack' !important; 
                        height: 30px !important;
                    width: 30px !important;
                    text-align: center !important;
                    padding: 0 !important;
                    line-height: 30px !important;
                    top: 19px !important;
                    }
                @media (min-width: 576px)
                .col-sm-6 {
                    -ms-flex: 0 0 50%;
                    flex: 0 0 50%;
                    max-width: 50%;
                }
                .row {
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-wrap: wrap;
                    flex-wrap: wrap;
                    margin-right: -15px;
                    margin-left: -15px;
                }
                img, svg, video, canvas, audio, iframe, embed, object{
                 display: unset !important;   
                }
                input#serach {
                    border: 1px solid;
                }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.front-navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <div class="footer footer-inner wp-float">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="{{URL::asset('images/oh2-logo.png')}}" class="img-fluid">

                    </div>
                    <div class="col-sm-7">

                        <p><a href="#">Terms and conditions</a><a href="#">privacy policy</a><a href="#">disclaimer</a></p>
                        <p>LEGO and the LEGO logo are trademarks of the LEGO Group. ©2021 The LEGO Group. ©2021 Displayplan LTd. All rights reserved.</p>

                    </div>
                    <div class="col-sm-3">
                        <img src="{{ asset('images/dep-logo.png') }}" class="img-fluid pull-right right-logo">

                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
    <footer>
        <script type="text/javascript" src="{{URL::asset('/js/parsley.js')}}"></script>
                <script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
                <script type="text/javascript" src="{{URL::asset('/js/jquery.confirm.js')}}"></script>
                <script type="text/javascript" src="{{URL::asset('/js/select2.min.js')}}"></script>
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
