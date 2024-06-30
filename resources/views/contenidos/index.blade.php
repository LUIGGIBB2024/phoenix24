@extends('layouts.appnew')
@section('title','Enlace Visual|Contenidos CRUD')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #datacontenidos
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
        .boton_regresar
         {
            font-size:14px !important;
            margin-top:-1.1em;
            position:absolute;
            left:0;
            width:100px;
            text-align: center;
         }
         .boton_nuevo
         {
            font-size:14px !important;
            margin-top:-1.0em !important;
            position:absolute !important;
            right:0 !important;
            width:100px;
            text-align: center;
         }
         .color_infoencab
         {
           font-size: 22px;
           color:rgb(52, 52, 77);
           font-weight: bolder;
           float: left;
           margin-top:-2ch;
         }
         #enc_botones
         {
            height: 40px;
            margin-top:0.5em;
         }
    </style>
@endsection

@section('contenedor')

<div>
    <h4 id = "enc_ventas" class="color_infoencab">Mantenimiento de Contenidos</h4>
</div>
<div class="app-page-title" id="enc_botones">
    <div class="container" >

        <div class="page-title-wrapper">
            <div class="ibox-tools clearfix">
                <a href="javascript:window.history.go(-1)">
                    <button class="btn btn-warning btn-xs boton_regresar" type="button">
                        <i class="fas fa-arrow-circle-left">
                        </i>
                        Regresar
                    </button>
                </a>
                <a href="{{ route('contenidos.create') }}">
                   <button class="btn btn-primary btn-xs boton_nuevo" type="button" >
                      <i class="fa fa-plus-circle"> </i>
                      Nuevo
                   </button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-1.0em;" >
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="datacontenidos">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable">Ubicación</th>
                                <th class = "enc_datatable">Título</th>
                                <th class = "enc_datatable">ID Pagina</th>
                                <th class = "enc_datatable">Indice</th>
                                <th class = "enc_datatable">Imagen</th>
                                <th class = "enc_datatable">Acción</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
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
            let cadenaruta  = "{{route('conscontenidos.ajax')}}";
            var datainvt =  $('#datacontenidos').DataTable(
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
                 //var invvalorizado = api
                 //   .column(9,{search: 'applied'})
                 //   .data()
                 //   .reduce( function (a, b) {
                  //      return intVal(a) + intVal(b);
                  //  }, 0 );
                //
                //  Update footer by showing the total with the reference of the column index
                // Actualizar Pie del datatable , mostrando el total con la referencia del indice de la columna
                //var grantotal =  invvalorizado.toLocaleString('en-US', {maximumFractionDigits:2})
                //$(api.column(9).footer()).html(grantotal);

                // $('#totalinventarios').text(grantotal);

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
                        {data:'ubicacion'},
                        {data:'titulo'},
                        {data:'pagina'},
                        {data:'idcontenido'},
                        {
                            data:'imagen',
                            render:function(data,type,row,meta)
                            {
                              //var data_n=data.split("/");
                              var servidor = location.protocol + '//' + location.host
                              return '<img  src="'+servidor+"/img/contenidos_image/"+data+'" width="38" height:"38" class="img-fluid" style:"border-radius:20px;"> '
                            }
                        },
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
