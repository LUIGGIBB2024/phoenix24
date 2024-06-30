@extends('layouts.appnew')
@section('title','Detalle de Cartera|Enlace Visual')


@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #datadetalle
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            margin-top:5px;

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
        #encab_pagina
        {
          margin-top:-2%;
          font-size:15px !important;
          font-weight: bold;
          color:darkblue;
          float: right;
        }
        .boton_regresar
         {
            font-size:16px;
            margin-top:-2.0ch;
         }
    </style>
@endsection

@section('contenedor')
<div class="app-page-title">
    <h4 id = "encab_pagina"> Cartera Detallada :: {{$nombredelcliente }} >> Saldo $:{{ number_format($saldo) }} </h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="javascript:window.history.go(-1)">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class="card"  style="width:100%!important;">
    <div class="row">
         <div class="col-lg-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="datadetalle">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Fecha Factura</th>
                                <th class = "enc_datatable">Fecha Vcmto</th>
                                <th class = "enc_datatable">Factura Nro</th>
                                <th class = "enc_datatable">Prefijo</th>
                                <th class = "enc_datatable">Días</th>
                                <th class = "enc_datatable">Vendedor</th>
                                <th class = "enc_datatable">Total Factura</th>
                                <th class = "enc_datatable">Total Abonos</th>
                                <th class = "enc_datatable">Saldo Factura</th>
                                <th class = "enc_datatable">Acción</th>
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
           let dataid = <?php echo $id; ?>;
           let cadenaruta  = "{{route('carteraverdetalle.ajax',['id' => 'var1'])}}";
           cadenaruta = cadenaruta.replace('var1',dataid);
           var datacarteradet =  $('#datadetalle').DataTable(
               {
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
                       {data:'fechafactura'},
                       {data:'fechadevencimiento'},
                       {data:'nrofactura'},
                       {data:'prefijo',"width":"10px"},
                       {data:'dias',"width":"20px"},
                       {data:'vendedor'},
                       {data:'totalfacturas',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                       {data:'totalabonos',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                       {data:'saldo',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                       {data:'btn'},
                   ],
                  "pageLength": 8,
                  "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                  "iDisplayLength" : 5,
                  "language":
                   {
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
