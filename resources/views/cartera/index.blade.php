@extends('layouts.appnew')
@section('title','Consultar Cartera|Enlace Visual')

@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #datacartera
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            margin-top:-10%;
            width: 100%;
        }
        .dt-buttons
        {
            float: left;
        }
        .buttons-html5
        {
           background: rgb(19, 184, 19) !important;
           padding:5px;
        }
        #botonregresar
          {
            font-size:16px;
            margin-top:1.5em !important;
          }

        #encab_pagina
          {
            margin-top:-2.0em;
            font-size:16px !important;
            font-weight: bold;
            float:right;
            right:10px;
          }
        .color_infoencab
         {
           font-size: 16px;
           color:rgb(112, 112, 131);
           font-weight: bolder;
           float: right;
           margin-top:-3ch;
         }
         #totalcartera
         {
            color:rgb(48, 48, 189);
            font-size: 20px;
         }
    </style>
@endsection
@section('contenedor')
{{  Form::hidden('totalcartera',session('tot_cartera'))  }}
<div class="app-page-title" style="height:60px;">
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{ '/dashboard' }}">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    <h4 id = "encab_pagina" class="color_infoencab">Consultar Información de Cartera :: Saldo:$: <span id="totalcartera"></h4>
</div>

<div class="card" >
    <div class="row">
         <div class="col-lg-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="datacartera">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Nombre del Cliente</th>
                                <th class = "enc_datatable">Vendedor</th>
                                <th class = "enc_datatable">Ciudad</th>
                                <th class = "enc_datatable">Total Facturas</th>
                                <th class = "enc_datatable">Total Abonos</th>
                                <th class = "enc_datatable">Saldo Final</th>
                                <th class = "enc_datatable">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th style="text-align: left;">Total $:</th><th></th><th></th></tr>
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
        var datacartera =  $('#datacartera').DataTable(
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
                 var soldototal = api
                    .column(6,{search: 'applied'})
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                //
                //  Update footer by showing the total with the reference of the column index
                // Actualizar Pie del datatable , mostrando el total con la referencia del indice de la columna
	            var grantotal =  soldototal.toLocaleString('en-US', {maximumFractionDigits:2})
                $(api.column(6).footer()).html(grantotal);

                 $('#totalcartera').text(grantotal);

                },
                "processing":true,
                "serverSide":false,
                "bLengthChange": false,
                stateSave: true,
                "ajax":"{{route('cartera.ajax') }}",
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
                    {data:'nombrecompleto'},
                    {data:'vendedor'},
                    {data:'nombredelaciudad'},
                    {data:'totalfacturas',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                    {data:'totalabonos',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                    {data:'saldo',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
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
