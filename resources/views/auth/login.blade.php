@extends('layouts.app')

@section('styles')
  <style>
     .titulo_login
     {
        font-size:1.8em;
        color:blue;
     }

     .header_home
     {
        background-color: #e2dde6;
        border-radius:0.2cm !important;
     }

     #footer_home
     {
        background-color: #e2dde6 !important;
        border-radius:0.2cm !important;
        font-size: 1.2em;
     }

     .texto_login
     {
        font-size:1.2em;
        color:rgb(15, 15, 15);
     }

     footer {
        text-align: center;
        padding: 30px;
        background-color: DarkSalmon;
        color:blue;
      }


</style>
@endsection

@section('content')
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <section class="vh-100">
            <div class="container p-2 h-100">
                @php
                    $activePage = "";
                    use Carbon\Carbon;
                    $ano =  Carbon::now();
                    $ano = $ano->format('Y');
                    $title  = "Software Enlace Visual (" . $ano . ")";
                @endphp

                <nav class="navbar navbar-expand-lg bg-body-tertiary p-1 header_home">
                    <div class="container-fluid">
                        <label class="form-label titulo_login">{{ $title }} </label>
                        <span>Licenciado a Almacénes AR SAS</span>
                    </div>
                </nav>

                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="{{asset('img/loginlateral.jpg')}}"
                        class="img-fluid w-100 h-75 rounded !important" alt="Phone image">
                    </div>

                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <label class="form-label titulo_login">Autenticación de Usuarios:</label>

                        <form method="POST" action="{{route('login')}}">
                            @csrf

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Email input -->
                            <label class="form-label texto_login" for="form1Example13">Ingrese su Email</label>
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email"  :value="old('email')" required autofocus  class="form-control form-control-lg @error('email') is-invalid @enderror" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <label class="form-label texto_login" for="form1Example23">Ingrese su Password</label>
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required autocomplete="current-password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

                        </form>
                    </div>


               </div>
               <footer  id="footer_home">
                <div class="container-fluid">
                    <nav class="float-left">
                        <div class="copyright float-right ">
                            Derechos Reservados &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Design By CIS DE LA COSTA <i class="material-icons"></i>
                            <a href="#" target="_blank"></a><a href="#" target="_blank"></a>
                        </div>
                    </nav>
                </div>
            </footer>
            </div>

        </section>
    </div>
@endsection


