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

           .divider:after,
           .divider:before
            {
                content: "";
                flex: 1;
                height: 1px;
                background: #eee;
            }

            .texto_login
            {
                color: black;
                font-size: 1.1em;
            }

            .titulo_login
            {
                color: rgb(38, 17, 231);
                font-size: 2.1em;
            }

            #footer {
                color: white;
                background: #333;
             }

        </style>

    </head>
    <body>
        <section class="vh-100 p-1">
            {{--  @include('navbars.nav.guest')  --}}

            <div class="container p-2 h-100">
                @php
                    $activePage = "";
                    use Carbon\Carbon;
                    $ano =  Carbon::now();
                    $ano = $ano->format('Y');

                    $title  = "Software Enlace Visual (" . $ano . ")";
                @endphp

                <nav class="navbar navbar-expand-lg bg-body-tertiary p-1">
                    <div class="container-fluid">
                        <label class="form-label titulo_login">{{ $title }} </label>
                    </div>
                </nav>


                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="{{asset('img/loginlateral.jpg')}}"
                        class="img-fluid w-100 h-75 rounded !important" alt="Phone image">
                    </div>

                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <label class="form-label titulo_login">Autenticación de Usuarios:</label>

                        <form method="GET" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <label class="form-label texto_login" for="form1Example13">Ingrese su Email</label>
                            <div class="form-outline mb-4">
                                <input type="email" id="form1Example13" class="form-control form-control-lg" />
                            </div>

                            <!-- Password input -->
                            <label class="form-label texto_login" for="form1Example23">Ingrese su Password</label>
                            <div class="form-outline mb-4">
                                <input type="password" id="form1Example23" class="form-control form-control-lg" />
                            </div>

                            <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Recordarme </label>
                            </div>
                            <a href="#!">Olvidó su Password ?</a>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>

                            {{--  <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                            </div>  --}}
                        </form>
                    </div>
                </div>
            </div>
            <footer style="background-color: #6C3483">
                <div class="container" >
                    <nav class="float-left">
                    <div class="copyright float-right ">
                        Derechos Reservados &copy;
                        <script>
                          document.write(new Date().getFullYear())
                        </script>, Design By CIS DE LA COSTA <i class="material-icons"></i>
                        <a href="#" target="_blank"></a><a href="#" target="_blank"></a>
                    </div>
                </div>
        </section>
    </body>
</html>
