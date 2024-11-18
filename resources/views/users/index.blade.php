@section('title', 'Usuarios|Mantenimiento')
@extends('layouts.appnew', ['activePage' => 'Usuarios', 'titlePage' => 'Mantenimiento de Usuarios'])

@section('css')
    <link href="{{ asset('enlacevisual') }}/css/main.css" rel="stylesheet" />
    <link href="{{ asset('enlacevisual') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">

    <style>
        #datausuarios {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 11px;
        }

        #tablarangohorarios {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 11px;
        }

        #tablarangohorarios_info
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
            margin-top: -0.7em !important;
        }

        #datausuarios_info
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
            margin-top: -.7em !important;
        }

        #contenedor_horarios {
            width: 100em !important;
            height: 80em !important;
            margin-top: -2.5em;
        }

        .page-item {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            margin-top: -1em !important;
        }

        .ventana_rangos_modal {
            height: 50em;
        }

        .dt-buttons {
            float: left !important;
        }

        .buttons-html5 {
            background: rgb(7, 238, 7) !important;
            color: black;
            font-size: 12px !important;

        }

        .enc_datatable {
            text-align: center !important;
            background-color: rgb(240, 15, 146) !important;
            color: white !important;
            height: 20px !important;
            font-size: 13px !important;
        }

        .enc_datatable_h {
            text-align: center !important;
            background-color: rgb(240, 15, 146) !important;
            color: white !important;
            height: 20px !important;
            font-size: 13px !important;
        }

        .dataTables_filter {
            background-color: rgb(226, 223, 223) !important;
            height: 47px !important;
        }

        .row_datatable {
            height: 250px;
        }
       
    </style>
@endsection
@section('contenedor')
    @php
    session(['idregistro' => 17]);
    @endphp

    {{--  <div class="app-page-title">      --}}
    <div class="container p-2">         
         <div class="d-flex justify-content-between">
              <a href="{{'/dashboard'}}">
                 <button class="btn btn-warning btn-xs boton_regresar_datatable" type="button">
                      <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                      <strong>Regresar</strong>
                 </button>
              </a>
              <a href="javascript:void(0)">
                 <button class="btn btn-warning btn-xs boton_nuevo_datatable" data-toggle="modal"
                    data-target="#VentanaUsuariosCrear" type="button">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                        <strong> Nuevo Registro</strong>
                </button>
              </a>
        </div>    
    </div>

    <div class="content">
        <div class="row" style="margin-top:-1.7em;">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="datausuarios">
                        <thead class="thead-light header-datatable">
                            <tr>
                                <th class="enc_datatable">ID</th>
                                <th class="enc_datatable">Correo Electrónico</th>
                                <th class="enc_datatable">Nombre del Usuario</th>
                                <th class="enc_datatable">Codigo</th>
                                <th class="enc_datatable">Tipo de Usuario</th>
                                <th class="enc_datatable">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.boton_crear_modal').on('click', function(e) {
           e.preventDefault();
           crear_usuarios()
        });

        $('.boton_actualizar_modal').on('click', function(e) {
           e.preventDefault();
           actualizar_usuarios()
        });

        $('.boton_nuevo_datatable').on('click', function() {
            $('#email_cre').val("")
            $('#nombre_cre').val("")
            $('#codigo_cre').val("")
            $('#password_cre').val("")
            $('#tipodeusuario_cre').val("1")
            $('#email_cre').focus();
         });

        function crear_usuarios()
        {
            var email             = $('#email_cre').val()
            var nombre            = $('#nombre_cre').val()
            var codigo            = $('#codigo_cre').val()
            var tipodeusuario     = $('#tipodeusuario_cre').val()
            var password          = $('#password_cre').val()
            var _token            = $('input[name = _token]').val()
            $.ajax(
            {
                type: "post",
                url: "{{ route('usuarios.store') }}",
                data:
                {
                    _token: _token,
                    email:email,
                    nombre:nombre,
                    codigo:codigo,
                    tipodeusuario:tipodeusuario,
                    password:password
                },
                error: function(req, status, error)
                {
                    if (req.status == 500) {
                        alert(
                            "Error de Memoria Grafica (Carga) / Información Excesiva /Indeterminado, intente de Nuevo x Favor");
                    } else {
                        alert('Error Generado : ' + error + '--' + JSON.stringify(req));
                    }
                },
                ajaxStart: function()
                {
                    $('#cargando_pagina').css('display', 'flex')

                },

                success: (data_bd) =>
                {
                   $('#email_cre').val("")
                   $('#nombre_cre').val("")
                   $('#codigo_cre').val("")
                   $('#password_cre').val("")
                   $('#tipodeusuario_cre').val(1)
                   $('#VentanaUsuariosCrear').modal('hide')
                   $('#datausuarios').DataTable().ajax.reload()
                   toastr.success('Registro de Usuario Ingresado Exitosamente')
                },
            });
        }


        function editar(idreg)
        {
            var _token = $('input[name = _token]').val()
            $.ajax({
                type: "post",
                url: "{{ route('filtrar.usuarios.ajax') }}",
                data: {
                    id: idreg,
                    _token: _token,
                },
                error: function(req, status, error) {
                    if (req.status == 500) {
                        alert(
                            "Error de Memoria Grafica (Carga) / Información Excesiva /Indeterminado, intente de Nuevo x Favor");
                        //ocultar_ventanas();
                    } else {
                        alert('Error Generado : ' + error + '--' + JSON.stringify(req));
                    }
                },
                ajaxStart: function() {
                    $('#cargando_pagina').css('display', 'flex')

                },

                complete: function() {},
                success: (data_bd) => {
                    var registro = JSON.parse(data_bd)
                    var id              = registro.id
                    var email           = registro.email
                    var nombre          = registro.name
                    var codigo          = registro.codigo
                    var tipodeusuario   = registro.tipodeusuario
                    var password        = registro.password
                    //var password        = registro.passwordmobil  
                    $('#id_registro').val(id)
                    $('#email').val(email)
                    $('#nombre').val(nombre)
                    $('#codigo').val(codigo)
                    $('#password').val(password)
                    $('#tipodeusuario').val(tipodeusuario)
                    $('#VentanaUsuariosEditar').modal('toggle')
                }
            });
        }

        function actualizar_usuarios()
        {
            var id                = $('#id_registro').val()
            var email             = $('#email').val()
            var nombre            = $('#nombre').val()
            var codigo            = $('#codigo').val()
            var tipodeusuario     = $('#tipodeusuario').val()
            var password          = $('#password').val()
            var _token            = $('input[name = _token]').val()

            $.ajax(
            {
                type: "post",
                url: "{{ route('usuarios.actualizar') }}",
                data: {
                    id: id,
                    _token: _token,
                    email:email,
                    nombre:nombre,
                    codigo:codigo,
                    tipodeusuario:tipodeusuario,
                    password:password
                },
                success: (data_bd) => {
                    $('#VentanaUsuariosEditar').modal('hide')
                    //$('#datahabitaciones').dataTable().ajax.reload()
                    $('#datausuarios').DataTable().ajax.reload()
                    toastr.success('Usuario Actualizado Existosamente')
                },
                error: function(req, status, error) {
                    if (req.status == 500) {
                        alert(
                            "Error de (Carga) / Información Excesiva /Indeterminado, intente de Nuevo x Favor");
                    } else {
                        alert('Error Generado : '+req.status + error + '--' + JSON.stringify(req));
                    }
                },
            });
        }


        function eliminar_usuarios(idreg)
        {
            var _token = $('input[name = _token]').val()
            $.ajax({
                type: "post",
                url: "{{ route('filtrar.usuarios.ajax') }}",
                data: {
                    id: idreg,
                    _token: _token,
                },
                error: function(req, status, error) {
                    if (req.status == 500) {
                        alert(
                            "Error de Memoria Grafica (Carga) / Información Excesiva /Indeterminado, intente de Nuevo x Favor");
                        ocultar_ventanas();
                    } else {
                        alert('Error Generado : ' + error + '--' + JSON.stringify(req));
                    }
                },
                ajaxStart: function() {
                    $('#cargando_pagina').css('display', 'flex')

                },

                complete: function() {},
                success: (data_bd) => {
                    var registro = JSON.parse(data_bd)

                    var registro = JSON.parse(data_bd)
                    var id              = registro.id
                    var email           = registro.email
                    var nombre          = registro.name
                    var codigo          = registro.codigo
                    var tipodeusuario   = registro.tipodeusuario
                    var password        = registro.passwordmobil

                    $('#id_registro_usuario').val(id)
                    $('#email_del').val(email)
                    $('#nombre_del').val(nombre)
                    $('#codigo_del').val(codigo)
                    $('#password_del').val(password)
                    $('#tipodeusuario_del').val(tipodeusuario)
                    $('#VentanaUsuariosEliminar').modal('toggle')
                }
            });
        }

        function delete_usuarios() {

            var _token = $('input[name = _token]').val() // Asignar Valor del token
            var id = $('#id_registro_usuario').val() // Asignar Id del registro a eliminar
            $.ajax({
                type: "post",
                url: "{{ route('usuarios.eliminar') }}",
                data: {
                    id: id,
                    _token: _token
                },
                success: (data_bd) =>
                {
                    $('#VentanaUsuariosEliminar').modal('hide')
                    $('#datausuarios').DataTable().ajax.reload()
                    toastr.danger('Registro Eliminado Exitosamente')
                },
                error: function(req, status, error) {
                    if (req.status == 500) {
                        alert(
                            "Error de (Carga) / Información Excesiva /Indeterminado, intente de Nuevo x Favor");
                    } else {
                        alert('Error Generado : ' + error + '--' + JSON.stringify(req));
                    }
                },
            });
        }

        $(document).ready(function() {

            $('#datausuarios').DataTable({
                "processing": true,
                "serverSide": false,
                "bLengthChange": false,
                stateSave: true,
                "ajax": {
                    type: "GET",
                    url: "{{ route('usuarios.ajax') }}",
                },
                "responsive": {
                    breakpoints: [{
                            name: 'bigdesktop',
                            width: Infinity
                        },
                        {
                            name: 'meddesktop',
                            width: 1480
                        },
                        {
                            name: 'smalldesktop',
                            width: 1280
                        },
                        {
                            name: 'medium',
                            width: 1188
                        },
                        {
                            name: 'tabletl',
                            width: 1024
                        },
                        {
                            name: 'btwtabllandp',
                            width: 848
                        },
                        {
                            name: 'tabletp',
                            width: 768
                        },
                        {
                            name: 'mobilel',
                            width: 480
                        },
                        {
                            name: 'mobilep',
                            width: 320
                        }
                    ]
                },
                "dom": "Bfrtilp",
                stateSave: true,
                "buttons": [
                    'copy',
                    'excel',
                    'csv',
                    'pdf'
                ],
                "columns": [{
                        data: 'id'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'codigo'
                    },
                    {
                        data: 'tipousuario'
                    },
                    {
                        data: 'btn',
                        className: "text-center"
                    }
                ],
                "pageLength": 10,
                "aLengthMenu": [
                    [5, 10, 15, 25, 50, 100, -1],
                    [5, 10, 15, 25, 50, 100, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    "emptyTable": "No existen datos disponibles en la tabla",
                    "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "<span style='color:black;''>Buscar:</span>",
                    "zeroRecords": "No existen coincidencias",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            }).order([0, 'asc']).draw();

        });


        function okactualizar() {
            toastr.success('Usuario Actualizado Exitosamente')
        }





    </script>
@endsection
@include('users.crear')
@include('users.editar')
@include('users.eliminar')

