@section('title', 'Clientes|')
@extends('layouts.appnew')


@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #dataclientes
        {
          font-family: Verdana, Geneva, Tahoma, sans-serif;
          font-size: 11px;
         }
         .dt-buttons
         {
           float: left;
         }
         .buttons-html5
         {
            background: rgb(19, 184, 19) !important;
         }
    </style>
@endsection
@section('contenedor')
@php
    session(['idregistro' => 17]);
@endphp
<div class="app-page-title">
    <h4 style="margin-top:-2%">Actualizar Información de Clientes</h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{'/dashboard'}}">
                <button class="btn btn-warning btn-xs" type="button" style="font-size:15px;position:absolute;right:0ch;margin-top:-3%;">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class="content" >
    <div class="row">
         <div class="col-md-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="dataclientes">
                        <thead class="thead-light header-datatable" >
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Nombre del Cliente</th>
                                <th class = "enc_datatable">Nit/Cédula</th>
                                <th class = "enc_datatable">Dirección</th>
                                <th class = "enc_datatable">Ciudad</th>
                                <th class = "enc_datatable">Vendedor</th>
                                <th class = "enc_datatable">Latitud</th>
                                <th class = "enc_datatable">Longitud</th>
                                <th class = "enc_datatable">Acciones</th>
                            </tr>
                        </thead>
                   </table>
              </div>
         </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('datatables/js/jszip.min.js')}}"></script>
    <script src="{{asset('datatables/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('datatables/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('datatables/js/datatables.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('datatables/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('datatables/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('datatables/js/buttons.print.min.js')}}"></script>
   <script>
    $(document).ready(function()
        {
          $('#dataclientes').DataTable(
            {
                "processing":true,
                "serverSide":false,
                "bLengthChange": false,
                stateSave: true,
                "ajax":"{{route('clientes.ajax') }}",
                "responsive":true,
                "dom":"Bfrtilp",
                stateSave: true,
                "buttons": [
                    'copy',
                    'excel',
                    'csv',
                    'pdf'
                ],
                "columns":[
                    {data:'clientesID'},
                    {data:'nombrecompleto'},
                    {data:'nit'},
                    {data:'direccion'},
                    {data:'nombredelaciudad'},
                    {data:'nombredelvendedor'},
                    {data:'latitud'},
                    {data:'longitud'},
                    {data: 'btn'}
                ],
               "pageLength": 8,
               "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
               "iDisplayLength" : 5,
               "language": {
                    "emptyTable":     "No existen datos disponibles en la tabla",
                    "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered":   "(filtrado de _MAX_ registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No existen coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            }
          ).order([1, 'asc']).draw();
        });
    </script>
@endsection


