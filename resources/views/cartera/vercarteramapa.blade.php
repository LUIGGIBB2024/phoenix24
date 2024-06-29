@extends('layouts.appnew')
@section('title','Consultar Cartera Mapa|Enlace Visual')

@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/css/buttons.bootstrap5.min.css')}}">

    <style>
        #datacartera
        {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 10px;
        margin-top:-10%;
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
        .select_combo
        {
           width:30em !important;
           font-size:12px;
           padding:5px !important;
        }
        .box {
            display:flex;
            position: absolute;
            border-width: 1px;
            border-color: blueviolet;
            border-style:solid;
            width: auto;
            margin-top:-2.3em;
            padding:5px;
          }
          #generarconsulta
          {
            height:30px;
            background:rgb(21, 139, 27) !important;
            align-content: center;
            float:right;
            margin-top:-2.3em;
            position: relative;
          }
         #botonregresar
          {
            font-size:15px;
            margin-top:-2.3em;
            position:relative;
            right:0ch;
            margin-top:-3%;
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
    <h4 id = "encab_pagina" style="margin-top:-2%">Consultar Especial de Cartera :: Total:$: <span id="totalcartera" style="color:darkblue;font-weight: bolder;"></h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{url()->previous() }}">
                <button class="btn btn-warning btn-xs" type="button" id="botonregresar" style="position:absolute;right:0ch;margin-top:-3%;">
                    <i class="fas fa-arrow-circle-left">  </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>
<div class="card box">
    <div>
       <div style="float:left;" >
            <select class="form-select select_combo combo_vendedor" aria-label="Default select example" >
                    <option selected>Seleccionar Vendedor</option>
                    @foreach ( $vendedores as $vendedor )
                            <option value="{{$vendedor->codigo}}">{{$vendedor->nombre}}</option>
                    @endforeach
            </select>
       </div>
       <div style="float: center;" >
            <select class="form-select select_combo combo_ciudades" aria-label="Default select example" >
                    <option selected>Seleccionar Ciudad</option>
                    @foreach ( $ciudades as $ciudad)
                            <option value="{{$ciudad->codigo}}">{{$ciudad->descripcion}}</option>
                    @endforeach
            </select>
       </div>
       <div style="float:right; margin-top:0.0em;">
            <button type="button" id = "generarconsulta" class="btn btn-danger">Generar Consulta</button>
       </div>
    </div>
</div>

@php
    $latitud =  10.477822491222803;
    $longitud = -73.2445269745057910;
    $nombre   = "Valledupar";
    $saldo   = number_format(1000000);
    $factpend = "Fact Pendient(s)):"."1";
@endphp

<div  id ="mapa">
    <x-maps-google
        :centerPoint="['lat' => $latitud, 'long' => $longitud]"
        :zoomLevel="19"
        :markers="[['lat' => $latitud, 'long' => $longitud,'title' =>$nombre.'-'.$saldo]]"
    ></x-maps-google>
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
            $(document).on('click', '#generarconsulta', function()
            {
                //alert("Entre Aqui 100")
                let codvendedor = $('.combo_vendedor').val();
                let codciudad   = $('.combo_ciudades').val();
                if ( codvendedor == "Seleccionar Vendedor" || codciudad == "Seleccionar Ciudad" )
                {
                   alert("Falta Información, revise x favor");
                }
                else
                {
                   let cadenaruta  = "{{route('consultarcarteramapa.ajax',['vendedor' => 'var1','ciudad' => 'var2'])}}";
                   cadenaruta = cadenaruta.replace('var1',codvendedor);
                   cadenaruta = cadenaruta.replace('var2',codciudad);

                   $.ajax(
                    {
                        url:cadenaruta,
                        method:'GET',
                        async: true,
                        dataType:'json',
                        success:function(data)
                        {
                            //alert("Soy dato:"+data)
                            //datohtml = data.stringify();
                            datohtml =  JSON.parse(data);
                            alert("Dato:"+datohtml)
                            $('#mapa').html(datohtml);
                            //if (tipollamado == 1){
                            //$('#carrusel_bienes').html(data);
                            //}
                            //else{
                            //$('#carrusel_servicios').html(data);
                            //}
                            //alert("Entre Aquí:");

                        },
                        error:function (e)
                        {
                            var datosstr = JSON.stringify(e);
                            alert("Error :"+datosstr);
                        }
                    });



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
               }

            });
        });
    </script>

@endsection
