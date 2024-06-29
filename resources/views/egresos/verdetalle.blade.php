@extends('layouts.appnew')
@section('title','Detalle de Egresos|Enlace Visual')


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
          margin-top:2px;
          font-size:17px !important;
          font-weight: bold;
          color:darkblue;
        }
        .observ
        {
          background-color: rgb(223, 224, 223);
          color:black;
          font-size:12px;
        }
    </style>
@endsection

@section('contenedor')
<div class="app-page-title" >
    <h4 id = "encab_pagina" style="margin-top:-5px;"> Detalle del Egreso ::{{ $egresos->consecutivo."-".$egresos->tipodedocumento}}::Valor de Recibo $: {{ number_format($egresos->valorcxp+$egresos->otrospagos)}} / {{ $egresos->nombredeltercero}}  </h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="javascript:window.history.go(-1)">
                <button class="btn btn-warning btn-xs" type="button" style="font-size:15px;position:absolute;right:0ch;margin-top:-3.2em;">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    <p class="observ">{{ $egresos->observaciones }}</p>
</div>

<div class="card" style="margin-top:-4.5em;" >
    <div class="row">
         <div class="col-md-12">
              <div class="table-responsive">
                   <table class ="table table-striped" id="datadetalle">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Fecha Egreso</th>
                                <th class = "enc_datatable">Nro Factura</th>
                                <th class = "enc_datatable">Tdo</th>
                                <th class = "enc_datatable">Concepto</th>
                                <th class = "enc_datatable">Descripción del Pago</th>
                                <th class = "enc_datatable">Valor Abono</th>
                                <th class = "enc_datatable">Abono a CxPartera</th>
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
           let dataid = <?php echo 	$egresos->egresosID; ?>;
           let cadenaruta  = "{{route('verpagosegresos.ajax',['id' => 'var1'])}}";
           cadenaruta = cadenaruta.replace('var1',dataid);
           var datacxpadet =  $('#datadetalle').DataTable(
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
                       {data:'fechadocumento'},
                       {data:'facturapago'},
                       {data:'documentofactura'},
                       {data:'conceptodepago',"width":"10px"},
                       {data:'descripcionconceptodepago'},
                       {data:'valordelpago',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                       {data:'acumulado',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                      ],
                  "pageLength": 8,
                  "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                  "iDisplayLength" : 8,
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

