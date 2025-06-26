
<div  style="display:none;" class="modal fade" id="VentanaUsuariosEditar" data-bs-keyboard="true" role="dialog" data-backdrop="static" tabindex="-1" aria-labelledby="UsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content contenedor-usuarios" >
        <div class="modal-header enc_ventanamodal">
            <i class="material-icons img_encabezado_modal md-24">personadd</i>
            <h5 class="modal-title" id="UsuarioModalLabel"><strong>Edición de Usuarios</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" >
           <form action="javascript:void(0)">
                @csrf
                {{--  <div class="container input_modal" >
                    @php $campo = 'nombre_cre' @endphp
                    <label  for  = "{{$campo}}" class="title-ventana">Correo Electrónico:</label>
                    <input  type ="text" placeholder="Ingrese correo Electrónico" id="{{$campo}}"  class="form-control @error($campo) is-invalid @enderror"
                            name = "{{$campo}}" value="{{ old($campo) }}"  required
                    >
                    @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
               </div>  --}}
                {{--  <div class="container input_modal" >
                    @php $campo = 'email' @endphp
                    <label for="{{$campo}}" class="title-ventana">Correo Electronico:</label>
                    <input  type="email" placeholder="Ingrese Correo" id="{{$campo}}"  class="form-control @error($campo) is-invalid @enderror"
                            name = "{{$campo}}" value="{{ old($campo) }}"  required
                    >
                    @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>  --}}
                <div class="container input_modal">
                     @php $campo = 'email_cre' @endphp
                     <label for="{{$campo}}" class="title-ventana email_cre">Correo Electrónico:</label>
                     <input autofocus type="email" placeholder="Ingrese correo electrónico" id="{{$campo}}"  class="form-control @error($campo) is-invalid @enderror"
                             name = "{{$campo}}" value="{{ old($campo) }}"
                     >
                     @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                     @enderror
                </div>
                <div class="container input_modal">
                    @php $campo = 'nombre_cre' @endphp
                    <label for="{{$campo}}" class="title-ventana email_cre">Nombre del Usuario:</label>
                    <input autofocus type="text" placeholder="Ingrese Nombe del Usuario" id="{{$campo}}"  class="form-control @error($campo) is-invalid @enderror"
                            name = "{{$campo}}" value="{{ old($campo) }}"
                    >
                    @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
               </div>
               <div class="container input_modal">
                    @php $campo = 'password_cre' @endphp
                    <label for="{{$campo}}" class="title-ventana">{{'Password:'}}</label>
                    <input  type="password" placeholder="Ingrese Password" id="{{$campo}}" class="form-control   @error($campo) is-invalid @enderror"
                    name = "{{$campo}}" value="{{ old($campo) }}" required
                    >
                    @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="container input_modal">
                    @php $campo = 'codigo_cre' @endphp
                    <label for="{{$campo}}" class="title-ventana">{{'Código del Usuario:'}}</label>
                    <input  type="text" placeholder="Ingrese Código del Usuario" id="{{$campo}}"  class="form-control @error($campo) is-invalid @enderror"
                    name = "{{$campo}}" value="{{ old($campo) }}" required
                    >
                    @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class = "container input_modal" style="display: flex;justify-content: space-between;">
                    <div class="form-group opciones-hab">
                        @php $campo = 'tipodeusuario_cre' @endphp
                        <label for="{{$campo}}" class="title-ventana">{{'Tipo de Usuario:'}}</label>
                        <select name="{{$campo}}" value="{{ old($campo) }}" data-style="btn btn-link" id="{{$campo}}"  class="form-control  @error($campo) is-invalid @enderror selOpciones">
                            <option value="">Seleccionar..</option>
                            <option @if(old($campo) == '1') selected @endif value="1">Administrador</option>
                            <option @if(old($campo) == '2') selected @endif value="2">Supervisor</option>
                            <option @if(old($campo) == '3') selected @endif value="3">Operador</option>
                        </select>
                        @error($campo)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer pie_ventana">
                     <button type="button"  class="btn boton_salir_modal boton_salir" data-dismiss="modal">Salir</button>
                     <button  type="submit" class="btn boton_actualizar_modal boton_actualizar"  title="Guarda la Reserva con los datos suministrados.">
                                <i class="fa fa-check-circle img_boton" aria-hidden="true"></i>  <strong>Actualizar</strong>
                     </button>
                </div>
            </form>

        </div>
    </div>
  </div>
</div>

@section('js')
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
       window.addEventListener('alert', event =>
       {
         //alert(event.detail.message);
        toastr.success(event.detail.message);
       })
    </script>
@endsection

@section('css')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection






  <div  style="display:none;" class="modal fade" id="VentanaHabitacionEditar" data-bs-keyboard="true" role="dialog" data-backdrop="static" tabindex="-1" aria-labelledby="HabitacionleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contenedor-habitaciones" >
            <div class="modal-header enc_ventanamodal">
                <i class="material-icons img_encabezado_modal md-24">bed</i>
                <h5 class="modal-title" id="HabitacionleModalLabel"><strong>Editar Información de habitaciones</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--  <form  id = "ventana_edit_modal" method="POST" action="{{ route('habitaciones.act') }}" >  --}}

           <form  id = "ventana_edit_modal" action="javascript:void(0)">
                <div class="modal-body" >

                    @csrf
                    <input id ="id_registro" name="id_registro" type="hidden" value ="">
                    <div style="display: flex;justify-content: space-between;">
                        <div class="container input_modal" >
                                @php $campo = 'habitacion' @endphp
                                <label for="{{$campo}}" class="title-ventana">{{'Número de Habitación:'}}</label>
                                <input  type="text" placeholder="Ingrese Número de la Habitación" id="{{$campo}}" class="form-control  @error($campo) is-invalid @enderror"
                                name = "{{$campo}}" value="{{ old($campo) }}" required
                                >
                                @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span> @enderror

                        </div>
                        <div class="container input_modal" >
                                @php $campo = 'consecutivo' @endphp
                                <label for="{{$campo}}" class="title-ventana">{{'ID de Ocupación:'}}</label>
                                <input  type="number" placeholder="Ingrese Consecutivo" id="{{$campo}}" class="form-control @error($campo) is-invalid @enderror"
                                name = "{{$campo}}" value="{{ old($campo) }}"  required autofocus
                                >
                                @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                @enderror
                        </div>
                    </div>
                    <div class="container input_modal">
                        @php $campo = 'descripcion' @endphp
                        <label for="{{$campo}}" class="title-ventana">{{'Descripción de la Habitación:'}}</label>
                        <input  type="text" placeholder="Ingrese Descripción de la Habitación" id="{{$campo}}"  class="form-control   @error($campo) is-invalid @enderror"
                        name = "{{$campo}}" value="{{ old($campo) }}" required autofocus
                        >
                        @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="container input_modal">
                        @php $campo = 'codigoproducto' @endphp
                        <label for="{{$campo}}" class="title-ventana">{{'Código del Producto relacionado:'}}</label>
                        <input  type="text" placeholder="Ingrese Código del Producto Relacionado" id="{{$campo}}" class="form-control @error($campo) is-invalid @enderror"
                        name = "{{$campo}}" value="{{ old($campo) }}" required
                        >
                        @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="container input_modal">
                        @php $campo = 'identificador' @endphp
                        <label for="{{$campo}}" class="title-ventana">{{'Orden de Visualización:'}}</label>
                        <input  type="text" placeholder="Ingrese Orden de Visualización"  id="{{$campo}}" class="form-control @error($campo) is-invalid @enderror"
                        name = "{{$campo}}" value="{{ old($campo) }}" required
                        >
                        @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="container input_modal">
                        @php $campo = 'observaciones' @endphp
                        <label for="{{$campo}}" class="title-ventana">{{'Observaciones:'}}</label>
                        <textarea type="text" placeholder="Ingrese características de la habitación" rows="2" id="{{$campo}}" class="container @error($campo) is-invalid @enderror"
                        name = "{{$campo}}" value="{{ old($campo) }}" required autofocus
                        >
                        </textarea>
                        @error($campo) <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class = "container input_modal" style="display: flex;justify-content: space-between;">

                        <div class="form-group opciones-hab">
                            @php $campo = 'tipodecalculo' @endphp
                            <label for="{{$campo}}" class="title-ventana">{{'Tipo de Cálculo:'}}</label>
                            <select name="{{$campo}}" value="{{ old($campo) }}" data-style="btn btn-link" id="{{$campo}}" class="form-control  @error($campo) is-invalid @enderror selOpciones">
                                <option value="">Seleccionar..</option>
                                <option @if(old($campo) == 1) selected @endif value="1">Por Horas</option>
                                <option @if(old($campo) == 2) selected @endif value="2">Por Días</option>
                            </select>
                            @error($campo)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group opciones-hab">
                            @php $campo = 'tipodehabitacion' @endphp
                            <label for="{{$campo}}" class="title-ventana">{{'Tipo de Habitación:'}}</label>
                            <select name="{{$campo}}" value="{{ old($campo) }}" id="{{$campo}}" class="form-control @error($campo) is-invalid @enderror selOpciones">
                                <option @if(($campo) == 1) selected @endif value="1">Sencilla</option>
                                <option @if(($campo) == 2) selected @endif value="2">Doble</option>
                                <option @if(($campo) == 3) selected @endif value="2">Otra</option>
                            </select>
                            @error($campo)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group opciones-hab">
                            @php $campo = 'estado' @endphp
                            <label for="{{$campo}}" class="title-ventana">{{'Estado de Ocupación:'}}</label>
                            <select name="{{$campo}}" value="{{ old($campo) }}" id="{{$campo}}" class="form-control selectpicker @error($campo) is-invalid @enderror selOpciones">
                                <option @if(($campo) == 1) selected @endif value="1">Ocupada</option>
                                <option @if(($campo) == 2) selected @endif value="2">Desocupada</option>
                            </select>
                            @error($campo)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer pie_ventana">
                        <button type="button"  class="btn boton_salir_modal boton_salir" data-dismiss="modal">Salir</button>
                        <button  type="submit" class="btn boton_actualizar_modal boton_actualizar"  title="Guarda la Reserva con los datos suministrados.">
                                <i class="fa fa-check-circle img_boton" aria-hidden="true"></i>  <strong>Actualizar</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>

  </div>
</div>

@section('js')
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
       window.addEventListener('alert', event =>
       {
         //alert(event.detail.message);
        toastr.success(event.detail.message);
        })


    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

