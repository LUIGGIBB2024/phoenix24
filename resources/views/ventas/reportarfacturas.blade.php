@extends('layouts.appnew')
@section('title','|Actualizar Facturas')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #dataventas
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 9px;
            width:auto !important;
            padding: 2px 2px 2px 2px;
            margin-top:-0.5em;
        }
        .dt-buttons
        {
           float: left;
        }
        .buttons-html5
        {
           background: rgb(19, 184, 19) !important;
        }
        #encab_pagina
        {
          margin-top:-2%;
          font-size:17px !important;
          font-weight: bold;
        }
        .boton_regresar
         {
            font-size:16px;
            margin-top:-1.0em;
            padding-top: 10px;
         }
        .color_infoencab
         {
           font-size: 16px;
           color:rgb(112, 112, 131);
           font-weight: bolder;
           float: right;
           margin-top:-1.0em;
         }
        #totalventas
         {
            color:rgb(48, 48, 189);
            font-size: 20px;
            font-weight: bolder;
         }
         .contenedor_fechas
         {
             border:solid;
             border-color: grey;
             padding: 5px;
             margin-top: 10px;
             border-radius: 5px;
         }
         #filtrarventas
         {
            height:30px;
            position:static;
            right:10%;padding:5px;
            background:rgb(5, 182, 14) !important;
            float: right;
         }
         .campo_fecha
         {
            text-align:
            right;
            font-size:12px;
         }

    </style>
@endsection

@section('contenedor')

<div>
    <h4 id = "encab_pagina" class="color_infoencab">{{session('vs_fecha1')}} {{$indestado}} Reportar Entrega de Facturas :: Total $:<span id="totalventas"></h4>
    <div >
        @if($indestado==0)
             @php
                $fecha1 = date('Y-m-d');
                $fecha2 = date('Y-m-d');
             @endphp
        @else
            @php
                $fecha1    = session('vs_fecha1');
                $fecha2    = session('vs_fecha2');
            @endphp
        @endif
        <div class="ibox-tools">
            <a href="{{ '/dashboard' }}">
                <button class="btn btn-warning btn-xs boton_regresar" type="button" >
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    <div class="form-group contenedor_fechas">
        <div class="container">
            <label for="start" style="font-size:12px">Desde Fecha (d/m/a):</label>
            <input type="date" class="campo_fecha" id="desdefecha" name="fechadesde" value="{{ $fecha1 }}">
            <label for="start" style="font-size:12px;">Hasta Fecha (d/m/a):</label>
            <input type="date" class="campo_fecha" id="hastafecha" name="fechahasta" value="{{ $fecha2 }}">
            <button type="button" id = "filtrarventas" class="btn btn-danger" >Generar Consulta</button>
        </div>
    </div>
</div>
@php
    session(['vs_fecha1' => $fecha1]);
    session(['vs_fecha2' => $fecha2]);
@endphp
<div class="card" style="margin-top:-0.5em;" >
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="dataventas">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Fecha Factura</th>
                                <th class = "enc_datatable">Fecha Vcmto</th>
                                <th class = "enc_datatable" >Nro Factura / Remisión</th>
                                <th class = "enc_datatable">PRE</th>
                                <th class = "enc_datatable">Nombre del Cliente</th>
                                <th class = "enc_datatable">Vendedor</th>
                                <th class = "enc_datatable">Ciudad</th>
                                <th class = "enc_datatable">Total Factura</th>
                                <th class = "enc_datatable">Estado</th>
                                <th class = "enc_datatable"  id = "boton_accion" style="width:5%;">Acción</th>
                                <th class = "enc_datatable" style="display:none">FactEli</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th style="text-align: left;">Total $:</th><th></th><th></th><th></th><th style="display:none"></th></tr>
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
    //$('#dataventas').DataTable().fnDestroy();
    $(document).ready(function()
    {
       $(document).on('click', '#filtrarventas', function()
        {

           var mfecha1 = $("#desdefecha").val()     // Asignar Valor fecha desde
           var mfecha2 = $("#hastafecha").val()     // Asignar Valor fecha Hasta
           var query = $('#filtrarventas').val()

           procesar_informacion(query,mfecha1,mfecha2)
        });

        function procesar_informacion(query = '',xfecha1,xfecha2)
        {
          let mfecha1 = xfecha1
          let mfecha2 = xfecha2

          let cadenaruta  = "{{ route('reportarfacturas.ajax',['fecha1' => 'var1', 'fecha2' => 'var2'])}}"
          cadenaruta = cadenaruta.replace('var1',mfecha1)
          cadenaruta = cadenaruta.replace('var2',mfecha2)

         var datavtas =  $('#dataventas').DataTable(
           {
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
                    {data:'fechafactura'},
                    {data:'fechavencimiento'},
                    {data:'consecutivofactura'},
                    {data:'prefijo'},
                    {data:'nombreventa'},
                    {data:'nombrevendedor'},
                    {data:'nombredelaciudad'},
                    {data:'totalfactura',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                    {data:'estadodocumento',width:30},
                    {data:'btn'},
                    {data: 'toteliminado',visible:false}
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //console.log("Soy dato:"+aData[8]);
                    var dato = aData.estadodocumento;
                    dato = dato.trim();
                    if(dato == "Eliminada"){
                        $("td:eq(9)", nRow).css({"background-color":"orange"});
                    }
                    return nRow;
                },
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

                 // Columna de cálculo total
                 var montotal = api
                 .column(8,{search: 'applied'})
                 .data()
                 .reduce( function (a, b) {
                     return intVal(a) + intVal(b);
                 }, 0 );

                 var toteli = api
                 .column(11,{search: 'applied'})
                 .data()
                 .reduce( function (a, b) {
                     return intVal(a) + intVal(b);
                 }, 0 );


                //  Update footer by showing the total with the reference of the column index
                // Actualizar Pie del datatable , mostrando el total con la referencia del indice de la columna
	             var grantotal =  montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                 var vtotal = montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                 var gtotal = new Intl.NumberFormat("en-US").format(montotal - toteli);

                 $(api.column(8).footer()).html(gtotal);

                 $('#totalventas').text(gtotal);

                },
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

          datavtas.column(11).visible( false );
        }

    });
    </script>

@endsection



