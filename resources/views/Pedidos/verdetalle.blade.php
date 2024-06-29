
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
        #encab_pagina
        {
          margin-top:-2%;
          font-size:17px !important;
          font-weight: bold;
          color:darkblue;
        }
    </style>
@endsection

@section('contenedor')
<div class="app-page-title">
    <h4 id = "encab_pagina">Detalle del Pedido N°::{{ str_pad($pedidos->consecutivo,10,"0",STR_PAD_LEFT)}} :: Valor $:{{number_format($pedidos->totalpedido)}}{{"/".$pedidos->nombreventa }} </h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="javascript:window.history.go(-1)">
                <button class="btn btn-warning btn-xs" type="button" style="font-size:15px;position:absolute;right:0ch;margin-top:-3%;">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-2.5em;" >
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
        let dataid = <?php echo 	$pedidos->PedidosID; ?>;
        let cadenaruta  = "{{route('pedidosverdetalle.ajax',['id' => 'var1'])}}";
        cadenaruta = cadenaruta.replace('var1',dataid);
        var datavtas =  $('#datadetalles').DataTable(
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
                    {data:'DetalleDelPedidoID'},
                    {data:'producto'},
                    {data:'descripcion'},
                    {data:'bodega'},
                    {data:'cantidad',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'costopromedio',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'descuento1',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'descuento2',render:$.fn.dataTable.render.number(',', '.', 2, ''),className:"text-right"},
                    {data:'iva',render:$.fn.dataTable.render.number(',', '.', 0, ''),className:"text-right"},
                    {data:'valor',render:$.fn.dataTable.render.number(',', '.', 2, '$'),className:"text-right"},
                    {data:'valorneto',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
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
