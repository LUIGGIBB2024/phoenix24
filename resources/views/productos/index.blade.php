@extends('layouts.appnew')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">
    <style>
        #dataproductos
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 9px;
            width:100%;
            padding: 2px 2px 2px 2px;
            margin-top:5px;
        }
         .dt-buttons
         {
           float: left;
         }
         .buttons-html5
         {
            background: rgb(19, 184, 19) !important;
         }
         .boton_regresar
         {
          font-size:16px;
           margin-top:-2ch;
         }
         #encab_pagina
        {
          margin-top:-2%;
          font-size:17px !important;
          font-weight: bold;
          color:darkblue;
          float:right;
        }
    </style>
@endsection
@section('contenedor')
@php
    session(['idregistro' => 17]);
@endphp
<div class="app-page-title">
    <h4 id = "encab_pagina">Actualizar Información de Productos</h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href={{"/dashboard"}}>
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class="card" >
    <div class="row">
         <div class="col-md-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="dataproductos">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Nombre del Producto</th>
                                <th class = "enc_datatable">Grupo</th>
                                <th class = "enc_datatable">Subgrupo</th>
                                <th class = "enc_datatable">Imagen</th>
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
          $('#dataproductos').DataTable(
            {
                "processing":true,
                "serverSide":false,
                "lengthChange":false,
                stateSave: true,
                "lengthMenu":[[5,10,25,-1],[5,10,25,"All"]],
                "ajax":"{{route('productos.ajax') }}",
                "responsive":true,
                "dom":"Bfrtilp",
                "buttons": [
                    'copy',
                    'excel',
                    'csv',
                    'pdf'
                ],
                "columns":[
                    {data:'productoID'},
                    {data:'descripcion'},
                    {data:'nombregrupo'},
                    {data:'nombresubgrupo'},
                    {
                      data:'imagen',
                      render:function(data,type,row,meta)
                      {
                        //var data_n=data.split("/");
                        var servidor = location.protocol + '//' + location.host
                        return '<img  src="'+servidor+"/img/productos/"+data+'" width="38" height:"38" class="img-fluid" style:"border-radius:20px;"> '
                      }
                    },
                    {data:'btn'}

                ],
               "pageLength": 8,
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


