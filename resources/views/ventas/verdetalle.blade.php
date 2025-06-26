@extends('layouts.appnew')
@section('title','Consultar Detalle|Enlace Visual')
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
        width:100%;
        padding: 2px 2px 2px 2px;
        margin-top:10px;
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
          float: right;
        }
        #enc_ventas
        {
            margin-top:5px;
            font-size:17px;
            color:darkblue;
            font-weight:bold;
            margin:right;
        }
        .boton_regresar
         {
            font-size:16px;
            margin-top:-2ch;
         }
    </style>
@endsection

@section('contenedor')
<div>
    <div >
        @php
           $fecha = date('Y-m-d');
        @endphp

    </div>
</div>
<div class="app-page-title form-group">
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
    <h4 id = "encab_pagina">Detalle de Factura N°::{{ $facturas->numerodefactura }} :: Valor $:{{number_format($facturas->totalfactura)}}{{"/".$facturas->nombreventa }}</h4>
</div>
<div class="card" style="margin-top:-0.5em;" >
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="datadetalles">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable" style="width:10%;">Código</th>
                                <th class = "enc_datatable" style="width:25%;">Descrición</th>
                                <th class = "enc_datatable" >BD</th>
                                <th class = "enc_datatable">Cantidad</th>
                                <th class = "enc_datatable">Costo Promedio</th>
                                <th class = "enc_datatable">Dsc1</th>
                                <th class = "enc_datatable">Dsc2</th>
                                <th class = "enc_datatable">Iva</th>
                                <th class = "enc_datatable">Valor Unitario</th>
                                <th class = "enc_datatable">Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles as $item )
                                <tr role="row" class="">
                                    @php
                                       $dscto1 = 0;
                                       $dscto2 = 0;
                                       $iva = 0;
                                       $subtotal  =  $item->cantidad * $item->valorventa;
                                       $dscto1 =  ($item->descuento1 > 0) ? $item->cantidad * $item->valorventa * $item->descuento1/100:0;
                                       $dscto2 =  ($item->descuento2 > 0) ? ($subtotal - $dscto1) * $item->descuento2/100:0;
                                       $iva    =  ($subtotal - $dscto1 - $dscto2) * (0 +($item->porcentajeiva/100));
                                       $total  =  round(($subtotal - $dscto1 - $dscto2 + $iva),0);
                                    @endphp
                                    <td > {{ $item->detalledefacturasID}} </td>
                                    <td> {{ $item->producto}} </td>
                                    <td> {{ $item->descripcion}} </td>
                                    <td> {{ $item->bodega}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->cantidad)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->costopromedio,2)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->descuento1,2)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->descuento2,2)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->porcentajeiva)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($item->valorventa,2)}}</td>
                                    <td style= "text-align: right;"> {{ number_format($total)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                   {{$detalles->links()}}
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
           //alert("Entre a consultar");
           var mfecha1 = $("#desdefecha").val()     // Asignar Valor fecha desde
           var mfecha2 = $("#hastafecha").val()     // Asignar Valor fecha Hasta

           var query = $('#filtrarventas').val()

           procesar_informacion(query,mfecha1,mfecha2)
        });

        function procesar_informacion(query = '',xfecha1,xfecha2)
        {
          let mfecha1 = xfecha1
          let mfecha2 = xfecha2

          let cadenaruta  = "{{ route('ventas.ajax',['fecha1' => 'var1', 'fecha2' => 'var2'])}}"
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
                    {data:'estadodocumento'},
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



