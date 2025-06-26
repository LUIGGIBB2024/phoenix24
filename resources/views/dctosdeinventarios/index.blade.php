@extends('layouts.appnew')
@section('title','Consultar Documentos|Enlace Visual')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #datadctos
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
        #totalventas
         {
            color:rgb(48, 48, 189);
            font-size: 20px;
            font-weight: bolder;
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
        .contenedor_fechas
         {
             border:solid;
             border-color: grey;
             padding: 5px;
             margin-top: 10px;
             border-radius: 5px;
         }
         #filtrardctos
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
    <h4 id = "encab_ventas" class="color_infoencab">Consultar Documentos de Inventarios :: Total $:<span id="totaldctos"></span></h4>
    <div >
        @php
           $fecha = date('Y-m-d');
        @endphp

    </div>
</div>
<div class="app-page-title" style="height: 100px;">
    <div class="page-title-wrapper">
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
            <input type="date" class="campo_fecha" id="desdefecha" name="fechadesde" value="{{ $fecha }}">
            <label for="start" style="font-size:12px;">Hasta Fecha (d/m/a):</label>
            <input type="date" class="campo_fecha" id="hastafecha" name="fechahasta" value="{{ $fecha }}">
            <button type="button" id = "filtrardctos" class="btn btn-danger" >Generar Consulta</button>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-1.2em;" >
    <div class="row">
         <div class="col-lg-12" >
              <div class="table-responsive">
                   <table class ="table table-striped responsive" id="datadctos">
                        <thead class="thead-light">
                            <tr>
                                <th class = "enc_datatable">ID</th>
                                <th class = "enc_datatable" style="width:3%">Fecha Documento</th>
                                <th class = "enc_datatable">Consecutivo</th>
                                <th class = "enc_datatable">Concepto</th>
                                <th class = "enc_datatable">Descripción</th>
                                <th class = "enc_datatable">Nit/Cédula</th>
                                <th class = "enc_datatable">Sucursal</th>
                                <th class = "enc_datatable">Nombre del Tercero</th>
                                <th class = "enc_datatable">Total Documento</th>
                                <th class = "enc_datatable">Estado</th>
                                <th class = "enc_datatable">Acción</th>
                            </tr>
                        </thead>
                        <tfoot align="right">
                            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th style="text-align: left;">Total $:</th><th></th><th></th><th></th></tr>
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

        $(document).on('click', '#filtrardctos', function()
        {
           var mfecha1 = $("#desdefecha").val()     // Asignar Valor fecha desde
           var mfecha2 = $("#hastafecha").val()     // Asignar Valor fecha Hasta

           var query = $('#filtrardctos').val()

           procesar_informacion(query,mfecha1,mfecha2)
        });

        function procesar_informacion(query = '',xfecha1,xfecha2)
        {
          let mfecha1 = xfecha1
          let mfecha2 = xfecha2

          let cadenaruta  = "{{ route('verdctosdeinventarios.ajax',['fecha1' => 'var1', 'fecha2' => 'var2'])}}"
          cadenaruta = cadenaruta.replace('var1',mfecha1)
          cadenaruta = cadenaruta.replace('var2',mfecha2)

         var datavtas =  $('#datadctos').DataTable(
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
                    .column(8,{search: 'applied'})
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                //
                //  Update footer by showing the total with the reference of the column index
                // Actualizar Pie del datatable , mostrando el total con la referencia del indice de la columna
	            var grantotal =  montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                var vtotal = montotal.toLocaleString('en-US', {maximumFractionDigits:2})
                $(api.column(8).footer()).html(grantotal);

                 $('#totaldctos').text(vtotal);

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
                    {data:'documentosdeinventariosID'},
                    {data:'fechademovimiento'},
                    {data:'consecutivocustom',render:function(data, type, row, meta)
                          {
                            if(type === 'display'){
                                data = '<a href="' + row.myid + '">' + data + '</a>';
                            }

                            return data;
                          },className:"text-center"
                    },
                    {data:'concepto'},
                    {data:'descripcioncpto'},
                    {data:'nit'},
                    {data:'sucursal'},
                    {data:'nombrecompleto'},
                    {data:'totaldocumento',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
                    {data: 'estadodcto'},
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
          //alert("Soy tot:<?php echo session('total_vtas'); ?>")
          //{data:'totalfactura',render:$.fn.dataTable.render.number(',', '.', 0, '$'),className:"text-right"},
          //var vlr_html = '<h4 id = "enc_ventas" style="margin-top:-2%">Consultar Información de Ventas :: Total Ventas $:<?php echo session('total_vtas'); ?></h4>';
          //$('#enc_ventas').html(vlr_html);


          var total = datavtas.column(9).data().sum();

          //alert("Soy Total Ventas:"+total);
        }

    });
    </script>

@endsection
