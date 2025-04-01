<!DOCTYPE doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
                <!-- CSRF Token -->
                <meta content="{{ csrf_token() }}" name="csrf-token">
                    <!--<title>
                        {{ config('app.name', 'Enlace Visual') }}
                    </title> -->
                    <title>Enlace Visual</title>
                    @yield('css')
                    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/normalize.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/bootstrap.min.css')}}" />
                    <link rel="stylesheet" href="{{asset('css/menuside/font-awesome.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/themify-icons.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/flag-icon.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/cs-skin-elastic.css')}}">
                    <link rel="stylesheet" href="{{asset('strokecss/css/pe-icon-7-stroke.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/cs-skin-elastic.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/style.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/chart/chartist.min.css')}}" rel="stylesheet">
                    <link rel="stylesheet" href="{{asset('css/base.css')}}">
                    @yield('styles')
                </meta>
            </meta>
        </meta>
        <style>
           
           #weatherWidget .currentDesc
           {
             color: #ffffff!important;
           }
           .traffic-chart
           {
             min-height: 335px;
           }
           #flotPie1  {
              height: 150px;
            }
            #flotPie1 td {
              padding:3px;
            }
            #flotPie1 table {
               top: 20px!important;
               right: -10px!important;
            }
            .chart-container {
                display: table;
                min-width: 270px ;
                text-align: left;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            #flotLine5  {
                height: 105px;
           }

           #flotBarChart {
               height: 150px;
           }
           #cellPaiChart{
               height: 160px;
           }
           .menu-icon
           {
             font-size:18px !important;
             color:#6C3483 !important;
           }

           .sub-menu
           {
            padding-top:0.01ch !important;
            padding-bottom: 0.01ch !important;
            margin-top:-0.1ch !important;
           }
           .menu-title
           {
             text-align: center;
             color:rgb(17, 161, 228);
           }
           .color-header
           {
               background-color: #d8d8da !important;
           }
        </style>
    </head>
    <body>
        <div class="alerta-app @if (session('status')) active @endif">
            <p>
                {{ session('status') }}
            </p>
        </div>
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
             @guest
                @yield('content')
             @else
                <div class="app-main">
                    @include('template.partials.menu')
                    <div class="app-main__outer">
                         <div class="app-main__inner">
                              @yield('contenedor')
                         </div>
                    </div>
                </div>
             @endguest
        </div>
        @yield('js')
    </body>
</html>

