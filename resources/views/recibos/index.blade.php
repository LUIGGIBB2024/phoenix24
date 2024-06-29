@extends('layouts.appnew')
@section('title','Consultar Recibos|Enlace Visual')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">
    <script src="{{asset('datatables/js/buttons.print.min.js')}}"></script>

    <style>
        #datarecibos
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
        .prueba{
            background-color: blue !important;
        }
         .boton_regresar
        {
            font-size:16px;
            margin-top:-2ch;
        }
        .color_infoencab
        {
           font-size: 16px;
           color:rgb(52, 52, 77);
           font-weight: bolder;
           float: right;
           margin-top:-2ch;
        }
        #totalegresos
        {
            color:rgb(24, 24, 167);
            font-size: 20px;
        }
        .contenedor_fechas
        {
            border:solid;
            border-color: grey;
            padding: 5px;
            margin-top: 10px;
            border-radius: 5px;
        }
        #filtrarrecibos
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
    <h4 id = "enc_ventas" class="color_infoencab">Consultar Información de Recibos de Caja :: Total $:<span id="totalrecibos" style="color:darkblue;font-weight: bolder;"></span></h4>
    <div >
        @php
           $fecha = date('Y-m-d');
        @endphp

    </div>
</div>
<div class="app-page-title" style="height: 100px;">
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{"/"}}">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
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
            <input type="date" class="campo_fecha" id="desdefecha" name="fechadesde" value="{{ $fecha }}">
            <label for="start" style="font-size:12px;">Hasta Fecha (d/m/a):</label>
            <input type="date" class="campo_fecha" id="hastafecha" name="fechahasta" value="{{ $fecha }}">
            <button type="button" id = "filtrarrecibos" class="btn btn-danger" >Generar Consulta</button>
        </div>
    </div>
</div>
<div class="card" style="margin-top:-1.6em;">
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="datarecibos">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable" style="width:5%;">Fecha Recibo</th>
                                <th class = "enc_datatable">Nro Recibo</th>
                                <th class = "enc_datatable">TDO</th>
                                <th class = "enc_datatable">Nombre del Cliente</th>
                                <th class = "enc_datatable">Vendedor</th>
                                <th class = "enc_datatable">Ciudad</th>
                                <th class = "enc_datatable">Total Recibo</th>
                                <th class = "enc_datatable">Estado</th>
                                <th class = "enc_datatable">Acción</th>
                                <th class = "enc_datatable" style="display:none">RCEli</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th style="text-align: left;">Total $:</th><th ></th><th></th><th></th><th style="display:none"></th></tr>
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

    <script>
        $(document).ready(function()
        {

            $(document).on('click', '#filtrarrecibos', function()
            {
               //alert("Entre a consultar");
               var mfecha1 = $("#desdefecha").val()     // Asignar Valor fecha desde
               var mfecha2 = $("#hastafecha").val()     // Asignar Valor fecha Hasta

               var query = $('#filtrarrecibos').val()

               procesar_informacion(query,mfecha1,mfecha2)
            });

            function procesar_informacion(query = '',xfecha1,xfecha2)
            {
              let mfecha1 = xfecha1
              let mfecha2 = xfecha2

              let cadenaruta  = "{{ route('recibos.ajax',['fecha1' => 'var1', 'fecha2' => 'var2'])}}"
              cadenaruta = cadenaruta.replace('var1',mfecha1)
              cadenaruta = cadenaruta.replace('var2',mfecha2)

             var datarcj =  $('#datarecibos').DataTable(
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

                 // Columna de cálculo total
                 var montotal = api
                 .column(7,{search: 'applied'})
                 .data()
                 .reduce( function (a, b) {
                     return intVal(a) + intVal(b);
                 }, 0 );

                 var toteli = api
                 .column(10,{search: 'applied'})
                 .data()
                 .reduce( function (a, b) {
                     return intVal(a) + intVal(b);
                 }, 0 );

                 var grantotal =  montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                 var vtotal = montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                 var gtotal = new Intl.NumberFormat("en-US").format(montotal - toteli);

                 $(api.column(7).footer()).html(gtotal);

                 $('#totalrecibos').text(gtotal);

                },
                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        //console.log("Soy dato:"+aData[8]);
                        var dato = aData.estadorecibo;
                        dato = dato.trim();
                        if(dato == "Eliminado"){
                            $("td:eq(8)", nRow).css({"background-color":"orange"});
                        }
                        return nRow;
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
                        {data:'fechadocumento'},
                        {data:'consecutivorccaja'},
                        {data:'tipodocumento'},
                        {data:'nombredelcliente'},
                        {data:'nombrevendedor'},
                        {data:'nombredelaciudad'},
                        {data:'totalrecibo',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                        {data: 'estadorecibo'},
                        {data: 'btn'},
                        {data: 'toteliminado'}
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

              datarcj.column(10).visible( false );

            }

        });
    </script>

@endsection


