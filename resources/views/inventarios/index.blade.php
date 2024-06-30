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
    </style>
@endsection

@section('contenedor')
<div class="app-page-title">
    {{-- <h4 class = "encab_pagina"> Información de Inventarios :: Total $:<span id="totalinventarios"></h4>--}}
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{'/dashboard'}}">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    <h4 class ="color_infoencab"> Total Inventarios $:<span id="totalinventarios"></h4>
</div>

<div class="card" style="margin-top:-2.0em;" >
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


