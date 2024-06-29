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
                    @yield('css')
                    <link rel="stylesheet" href="{{asset('css/menuside/normalize.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/bootstrap.min.css')}}" />
                    <link rel="stylesheet" href="{{asset('css/menuside/font-awesome.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/themify-icons.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/flag-icon.min.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/cs-skin-elastic.css')}}">
                    <link rel="stylesheet" href="{{asset('strokecss/css/pe-icon-7-stroke.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/cs-skin-elastic.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/style.css')}}">
                    <link rel="stylesheet" href="{{asset('css/configurarheader.css')}}">
                    <link rel="stylesheet" href="{{asset('css/menuside/chart/chartist.min.css')}}" rel="stylesheet">
                </meta>
            </meta>
        </meta>

    </head>
    <body>
        <div class="alerta-app @if (session('status')) active @endif">
            <span>
            </span>
            <p>
                {{ session('status') }}
            </p>
        </div>
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            @guest

               @include('auth.login')

            {{--  @yield('content') --}}
            @else
            {{-- @include('template.partials.header') --}}
            <div class="app-main">
                @include('template.partials.menuhome')
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






