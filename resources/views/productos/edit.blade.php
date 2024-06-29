@extends('layouts.appnew')
@section('title', '| Actualizar Información de Productos')

@section('contenedor')
@section('css')
   <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

<div class="app-page-title">
    <h4 style="margin-top:-2%">Editar Información de Productos >>ID:{{$productosedt->productoID }}</h4>
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

<div class='col-md-12'>
   {{ Form::model($productosedt, array('route' => array('productos.update', $productosedt->productoID), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
        {{ csrf_field()}}

        <div class="form-group">

            {{ Form::label('descripcion', 'Descripción del Producto:') }}
            {{ Form::text('descripcion',null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('nombregrupo', 'Nombre del Grupo:') }}
            {{ Form::text('nombregrupo', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('nombresubgrupo', 'Nombre del SubGrupo:') }}
            {{ Form::text('nombresubgrupo', null, array('class' => 'form-control')) }}
        </div>
        @if($productosedt->imagen<>null)
            <div class="form-group">
                <img src="{{asset('img')}}/productos/{{ $productosedt->imagen}}" width="150" height="150" >
                {{$productosedt->imagen}}
            </div>
        @endif
        <div class="form-group" style="text-align: left;">
            @php $campo = 'imagen' @endphp
            <label for="{{$campo}}" class="title-user">Escoger Imagen:</label>
            <input
                id="{{$campo}}"
                type="file"
                placeholder="Imagen"
                class="form-control @error($campo) is-invalid @enderror"
                name="{{$campo}}"
                value="{{ old($campo) }}"
                required
            >
            @error($campo)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


    {{ Form::submit('Grabar', array('class' => 'btn btn-primary')) }}

	<a href="{{ route('productos.index') }}" class="btn btn-danger">Salir</a>

    {{ Form::close() }}

</div>


{{-- Leaflet --}}
{{-- Mapa básico  --}}
{{--<x-maps-leaflet></x-maps-leaflet>  --}}
{{-- MapaconLatitudyLongitud --}}


@endsection


