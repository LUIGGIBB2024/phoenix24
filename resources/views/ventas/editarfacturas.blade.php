@extends('layouts.appnew')
@section('title', '| Reportar Factura')

@section('css')
   <link rel="stylesheet" href="{{asset('css/main.css')}}">
   <style>
        .form-group
        {
            font-size: 13px !important;
            line-height: 0.7em;
        }
        .configtext
        {
          font-size: 13px !important;
          height: 35px !important;
        }
        .boton_regresar
        {
           font-size:16px;
           margin-top:1ch;

        }
        .color_infoencab
        {
          font-size: 16px;
          color:rgb(112, 112, 131);
          font-weight: bolder;
          margin-top:-3ch;
         float: right;
        }
        #numerodefactura
        {
           color:rgb(48, 48, 189);
           font-size: 20px;
        }

   </style>
@endsection

@section('contenedor')

<div class="app-page-title">
    {{-- <h4 class = "encab_pagina"> Información de Inventarios :: Total $:<span id="totalinventarios"></h4>--}}
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="javascript:window.history.go(-1)">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    <h4 class ="color_infoencab"> Reportar Entrega de la Factura N° $:{{ $facturas->numerodefactura}}</h4>
</div>

<div class='col-md-8'>

    {{ Form::model($facturas,array('route' => array('facturas.update', $facturas->FacturasID), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    {{-- {{ Form::open(array('route' => array('intercambios','method'=>'POST'),'style'=>'text-align:center'))}} --}}
        {{ csrf_field()}}
        {{  Form::hidden('url',URL::previous())  }}

        <div class="form-group">
            {{ Form::label('nombrecliente', 'Nombre del Cliente:') }}
            {{ Form::text('nombrecliente',$facturas->nombreventa, array('class' => 'form-control configtext')) }}
        </div>
        <div class="form-group">
            {{ Form::label('direccion', 'Dirección del Cliente:') }}
            {{ Form::text('direccion', $clientes->direccion, array('class' => 'form-control configtext')) }}
        </div>
        <div class="form-group">
            {{ Form::label('totalfactura', 'Valor Total:') }}
            {{ Form::text('totalfactura', number_format($facturas->totalfactura), array('class' => 'form-control configtext')) }}
        </div>
        <div class="form-group">
            {{ Form::label('categoria', 'reporte de Entrega:') }}
            <select name="estado03" class="form-control configtext">
                <option value="">Seleccionar..</option>
                <option @if($facturas->estado03 == 0)  selected=""  @endif value="0">Sin Entregar</option>
                <option @if($facturas->estado03 == 1)   selected=""  @endif value="1">Entregada</option>
           </select>
        </div>


    {{ Form::submit('Grabar', array('class' => 'btn btn-primary')) }}

	<a href="javascript:window.history.go(-1)" class="btn btn-danger">Salir</a>

    {{ Form::close() }}

</div>




@endsection


