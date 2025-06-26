@extends('layouts.appnew')
@section('title','Consultar Inventarios|Enlace Visual')
@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">

    <style>
        #datadetalles
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            width:auto !important;
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
        .encab_pagina
        {
          margin-top:-2%;
          font-size:17px !important;
          font-weight: bold;
          color:darkblue;
        }
        .boton_regresar
         {
            font-size:16px;
            margin-top:-3ch;

         }
         .color_infoencab
         {
           font-size: 16px;
           color:rgb(112, 112, 131);
           font-weight: bolder;
           float: right;
           margin-top:-3ch;
         }
         #totalinventarios
         {
            color:rgb(48, 48, 189);
            font-size: 20px;
         }

         .parrafo
         {
            color:rgb(16, 79, 10);
            font-size: 0.65em;
            margin:0%;
            display: flex;
            flex-direction:row;
            font-weight:bold;
         }

         .parrafo1
         {
            color:rgb(56, 12, 202);
            font-size: 11px;
            margin:0%;
            display: flex;
            flex-direction:row;
         }
         
         .card-personalizada
         {
           width: 25.5em;
           height: 9em;
         }

         .precio
         {
           color:white;
           background-color: rgb(210, 38, 144);
           width: 8em;
           text-align: center;
           margin-right: 0.5em;
         }

         .precio2
         {
           color:white;
           background-color: rgb(17, 193, 88);
           width: 8em;
           text-align: center;
           margin-right: 0.5em;
         }
         .card-title
         {
            font-size: .8em !important;
            margin: 0em 0em 0em !important;
         }

         .costo_especial
         {
            margin-top:2px;
         }

         .page-title-wrapper
         {
            margin-top: 0.5em;
            padding: 0.5em;
         }
    </style>
@endsection

@section('contenedor')
{{--  <div class="app-page-title">
    {{-- <h4 class = "encab_pagina"> Información de Inventarios :: Total $:<span id="totalinventarios"></h4>--}}
    {{--  <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{'/dashboard'}}">
                {{--  <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                </button>  
            </a>
        </div>
    </div>  
    <h4 class ="color_infoencab"> Total Inventarios $:<span id="totalinventarios"></h4>
</div>  --}}

<div class="page-title-wrapper p-2">
    <div class="ibox-tools">
        <a href="{{'/dashboard'}}">
            <button class="btn btn-warning btn-xs boton_regresar" type="button">
                <i class="fas fa-arrow-circle-left"></i>
                Regresar
            </button>
        </a>
    </div>
</div>

<div class="form-group">
    <div class="row">
         <div class="col-lg-12" >
            <form method="GET" action="{{ route('inventarios.saldos') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control text-uppercase" name="nombre" placeholder="Buscar producto por nombre" value="{{ request('nombre') }}">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>
         </div>
    </div>

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-12">
                <div class="card mb-4 card-personalizada">
                    <div class="card-body">
                        <h6 class="card-title">{{ $producto->codigo}} {{" BD:" . $producto->bodega }}</h6>
                        <p class="card-text parrafo">{{ $producto->descripciondelproducto}}</p>
                        <div class="input-group justify-content-between">
                            <p class="card-text parrafo1"><strong>Precio:</strong> $<span class="precio rounded-pill font-weight-bold">{{ number_format($producto->valor, 0) }}</span></p>
                            <span style="font-size:0.8em;">{{ number_format($producto->porcentajeiva, 0) }}</span>
                            <p class="card-text parrafo1"><strong>Existencia:</strong> <span class="precio rounded-pill font-weight-bold"> {{ number_format($producto->cantidad, 2) }}</span></p>                   
                        </div>
                        @if (Auth::user()->tipodeusuario == 1 || Auth::user()->tipodeusuario == 3)
                            <div class="input-group justify-content-between costo_especial">
                                <p class="card-text parrafo1"><strong>Costo  :</strong> $<span class="precio2 rounded-pill font-weight-bold">{{ number_format($producto->ultimocosto, 0) }}</span></p>
                                {{--  <div></div>  --}}
                                <p class="card-text parrafo1"><strong>Costo Especial:</strong> <span class="precio2 rounded-pill font-weight-bold"> {{ number_format($producto->costoespecial, 2) }}</span></p>                   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{--  <div class="card" style="margin-top:-2.0em;" >
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="datadetalles">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable" style="width:10%;">Código</th>
                                <th class = "enc_datatable">Descripción</th>
                                <th class = "enc_datatable" >Bod</th>
                                <th class = "enc_datatable" >Grupo</th>
                                <th class = "enc_datatable">Fecha UltCompra</th>
                                <th class = "enc_datatable" style="width:5%;">Existencia</th>
                                <th class = "enc_datatable">Costo Promedio</th>
                                <th class = "enc_datatable">Valor de Venta</th>
                                <th class = "enc_datatable">Invent Valorizado</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th style="text-align: left;">Total $:</th><th></th></tr>
                        </tfoot>
                   </table>
              </div>
         </div>
    </div>
</div>  --}}
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
        let cadenaruta  = "{{route('verinventarios.ajax')}}";
        var datainvt =  $('#datadetalles').DataTable(
           {
            "footerCallback": function ( row, data, start, end, display )
            {
               var api = this.api(), data;

               // converting to interger to find total
                var intVal = function (i)
                {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

             // Columna de saldo de Cartera
             var invvalorizado = api
                .column(9,{search: 'applied'})
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            //
            //  Update footer by showing the total with the reference of the column index
            // Actualizar Pie del datatable , mostrando el total con la referencia del indice de la columna
            var grantotal =  invvalorizado.toLocaleString('en-US', {maximumFractionDigits:2})
            $(api.column(9).footer()).html(grantotal);

             $('#totalinventarios').text(grantotal);

            },
                destroy: true,
                "processing":true,
                "serverSide":false,
                "bLengthChange": false,
                stateSave: true,
                "ajax":cadenaruta,
                "responsive":true,
                "dom":"Bfrtilp",
                "buttons": [
                    'copy',
                    'excel',
                    'csv',
                    'pdf'
                ],
                "columns":[
                    {data:'id'},
                    {data:'producto'},
                    {data:'descripciondelproducto'},
                    {data:'bodegacustom'},
                    {data:'descripciondelgrupo'},
                    {data:'fechaultimacompra'},
                    {data:'cantidad',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'costopromedio',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'valor',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'productovalorizado',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
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