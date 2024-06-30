@extends('layouts.appnew')
@section('title', '| Actualizar Información de Clientes')

@section('contenedor')
@section('css')
   <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

<div class="app-page-title">
    <h4 style="margin-top:-2%">Editar Información de Clientes (Ubicación GPS)  >>ID:{{$clientesedt->clientesID }}</h4>
    <div class="page-title-wrapper">
        <div class="ibox-tools">
            <a href="{{url()->previous() }}">
                <button class="btn btn-warning btn-xs" type="button" style="font-size:15px;position:absolute;right:0ch;margin-top:-3%;">
                    <i class="fas fa-arrow-circle-left">
                    </i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class='col-md-8'>

    {{ Form::model($clientesedt,array('route' => array('clientes.update', $clientesedt->clientesID), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    {{-- {{ Form::open(array('route' => array('intercambios','method'=>'POST'),'style'=>'text-align:center'))}} --}}
        {{ csrf_field()}}
        {{  Form::hidden('url',URL::previous())  }}


        <div class="form-group">
            {{ Form::label('nombrecliente', 'Nombre del Cliente:') }}
            {{ Form::text('nombrecompleto',null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('direccion', 'Dirección del Cliente:') }}
            {{ Form::text('direccion', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('ciudad', 'Ciudad del Cliente:') }}
            {{ Form::text('nombredelaciudad', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('latitud', 'Latitud:') }}
            {{ Form::text('latitud',null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('longitud', 'Longitud:') }}
            {{ Form::text('longitud',null, array('class' => 'form-control')) }}
        </div>

    {{ Form::submit('Grabar', array('class' => 'btn btn-primary')) }}

	<a href="javascript:window.history.go(-1)" class="btn btn-danger">Salir</a>

    {{ Form::close() }}

</div>


{{-- Leaflet --}}
{{-- Mapa básico  --}}
{{--<x-maps-leaflet></x-maps-leaflet>  --}}
{{-- MapaconLatitudyLongitud --}}
@php
    $latitud =  $clientesedt->latitud;
    $longitud = $clientesedt->longitud;
    $nombre   = "Luis Bernal";
    $saldo   = number_format(1200000);
    $factpend = "Fact Pendient(s)):"."3";
@endphp

@if($clientesedt->latitud<>null)
    <x-maps-google
        :centerPoint="['lat' => $latitud, 'long' => $longitud]"
        :zoomLevel="19"
        :markers="[['lat' => $latitud, 'long' => $longitud,'title' =>$nombre.'-'.$saldo.'-'.$factpend]]"
    ></x-maps-google>
@endif


@endsection


