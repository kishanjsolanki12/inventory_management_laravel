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
        <link rel="stylesheet" href="{{ asset('css/jquery.confirm.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">  
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{URL::asset('/js/jquery.min.js')}}"></script>
        
        <script type="text/javascript" src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
                
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.yusen-navigation')

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
        </div>
    </body>
    <footer>
        <script type="text/javascript" src="{{URL::asset('/js/parsley.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/jquery.confirm.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/select2.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/runtime.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
    </footer>
</html>
