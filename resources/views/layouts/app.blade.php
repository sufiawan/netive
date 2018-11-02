<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Network Inventory</title>

        <link rel="shortcut icon" href="/images/favicon.ico" />    

        <style type="text/css">
            @font-face {
                font-family: Nunito;
                src: url('fonts/Nunito-Regular.tff');
            }
        </style>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">                
    </head>
    <body>
        <script src="{{ asset('js/vendor.bundle.base.js') }}" defer></script>
        <script src="{{ asset('js/vendor.bundle.addons.js') }}" defer></script>
        
        <div class="container-scroller">            
            
            @include('inc.navbar')
            
            <div class="container-fluid page-body-wrapper">
                
                @include('inc.sidebar')
                                
                <div class="main-panel">
                    <div class="content-wrapper">
                        <main class="py-4">
                            @include('inc.message')
                            @yield('content')
                        </main>
                    </div>
                    <footer class="footer">
                        <div class="container-fluid clearfix">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                                <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Pusat Data dan Teknologi Informasi</span>
                        </div>
                    </footer>                    
                </div>                
            </div>
        </div>
                       
        <script src="{{ asset('js/off-canvas.js') }}" defer></script>
        <script src="{{ asset('js/misc.js') }}" defer></script>
        <script src="{{ asset('js/bootbox.min.js') }}" defer></script>
        <script src="{{ asset('js/datatables.min.js') }}" defer></script>   
    </body>
</html>
