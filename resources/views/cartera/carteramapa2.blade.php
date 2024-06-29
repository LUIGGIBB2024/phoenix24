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
          #mapa
          {
            border:1px solid rgb(148, 147, 147);
            width:  1000px;
            height: 800px;
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
    $apikeymap = "AIzaSyAmZEs0w3NNyDp81lRWgisyFT7lmY5XGmg";
@endphp

<div  id ="mapa">

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
    <script src="{{asset('js/gmaps.js')}}"></script>
    <script src="{{asset('js/mapsjs.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{$apikeymap}}&callback=initMap">
    </script>

    <script>
     $(document).ready(function()
     {
         function leer_archivo(lat,lng,nom,ciu,tel,dire,email,saldo,contador)
         {
             var center = [lat,lng];
             var valorsaldo = new Intl.NumberFormat("en-US", {maximumSignificantDigits: 3}).format(saldo);
             var contenido = "<p> <span style='font-weight:bold;'>"+nom+"</span><br>"+ciu+"<br>"+dire+"<br>"+
                             "<span style='font-weight:bold;color:green;'> "+ tel+"</span><br>"+email+"<br> Saldo:<span style='font-weight:bold;'>"+valorsaldo+"</span></p>";
             if (contador = 1)    // Se inicializa el mapa
                {
                  var mimapa = $('#mapa').gmap3
                  (
                    {
                        center: center,
                        zoom: 19,
                        mapTypeId : google.maps.MapTypeId.ROADMAP
                   });
                }
             mimapa.marker({
                   position: center,
                   icon: 'https://maps.google.com/mapfiles/marker_green.png',
                   infowindow:""
                });
             mimapa.infowindow({
                    position:center,
                    //content: "<p> <span style='font-weight:bold;'>"+nom+"</span><br>"+ciu+"<br>"+dire+"<br>"+
                    //         "<span style='font-weight:bold;color:green;'> "+ tel+"</span><br>"+email+"<br> Saldo:<span style='font-weight:bold;'>"+valorsaldo+"</span></p>"
                })
               .then(function (infowindow)
               {
                 var map = this.get(0);
                 var marker = this.get(1);
                 marker.addListener('click', function()
                   {
                     //infowindow.close();
                     infowindow.setContent(contenido);
                     infowindow.open(map,marker);
                   });
               });
        }



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
                          var contador = 0
                          $.each( data, function( index, value )
                          {
                            contador = contador + 1
                            var lat     = value.latitud
                            var lng     = value.longitud
                            var nom     = value.nombrecompleto
                            var ciu     = value.nombredelaciudad
                            var tel     = value.telefono
                            var dire    = value.direccion
                            var email   = value.email
                            var saldo   = value.saldo

                            if (lat > 0)
                            {
                              leer_archivo(lat,lng,nom,ciu,tel,dire,email,saldo, contador);
                            }


                          });
                        },
                        error:function (e)
                        {
                            var datosstr = JSON.stringify(e);
                            alert("Error :"+datosstr);
                        }
                    });
               }
        });
    });



    </script>

@endsection


