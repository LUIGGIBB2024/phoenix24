@extends('layouts.appnew')
@section('title', '| Modificar Contenidos')


@section('contenedor')
@section('css')
{{--<linkrel="stylesheet"href="asset('css/main.css')}}"> --}}
   <style>
        .boton_regresar
         {
            font-size:14px !important;
            position:absolute;
            left:0;
            width:100px;
            text-align: center;
            margin-top:-0.85em;
         }
        .color_infoencab
         {
           font-size: 22px;
           color:rgb(35, 35, 37);
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

<div>
    <h4 class="color_infoencab">Edición de Registro</h4>
</div>
<div class="app-page-title" id="enc_botones">
   <div class="page-title-wrapper">
        <div class="ibox-tools clearfix">
            <a href="javascript:window.history.go(-1)">
                <button class="btn btn-warning btn-xs boton_regresar" type="button">
                    <i class="fas fa-arrow-circle-left"></i>
                    Regresar
                </button>
            </a>
        </div>
    </div>
</div>

<div class='col-md-8'>

    {{ Form::model($contenidos,['route' => 'contenidos.store','method' => 'PUT','files' => true,'enctype' => 'multipart/form-data','style'=>'text-align:left'])}}
        {{csrf_field()}}
        {{Form::hidden('url',URL::previous())  }}
        <div class="form-group">
            {{ Form::label('titulo', 'Título de la Foto:') }}
            {{ Form::text('titulo',null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('pagina', 'Página:') }}
            {{ Form::text('pagina',null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('idcontenido', 'Id de la Foto:') }}
            {{ Form::text('idcontenido',null, array('class' => 'form-control')) }}
        </div>
        @if($contenidos->imagen<>null)
            <div class="form-group">
                <img src="{{asset('img')}}/contenidos_image/{{ $contenidos->imagen}}" width="150" height="150" >
                {{$contenidos->imagen}}
            </div>
        @endif
        <div class="form-group" style="text-align: left;">
            @php $campo = 'imagen' @endphp
           {{-- <labelfor="$campo" class="title-user">Imagen</label> --}}
            {{ Form::label('imagen', 'Imagen:', ['class' => 'title-user form-control-label text-md-left']) }}
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

    <a href="javascript:window.history.go(-1)" class="btn btn-danger">Salir</a>
    {{ Form::close() }}
</div>
