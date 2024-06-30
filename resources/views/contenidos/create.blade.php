@extends('layouts.appnew')
@section('title', '| Crear Contenidos')


@section('contenedor')
@section('css')
   <link rel="stylesheet" href="{{asset('css/main.css')}}">
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
    <h4 class="color_infoencab">Configurar Imágenes de Contenidos</h4>
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
    {{ Form::open(['route' => 'contenidos.store','method' => 'POST','files' => true,'enctype' => 'multipart/form-data','style'=>'text-align:left'])}}
        {{csrf_field()}}
        {{Form::hidden('url',URL::previous())  }}
        <div class="form-group">
            {{ Form::label('ubicacion', 'Ubicación: (SLD1-Slider1 / SLD2-Slider2)') }}
            {{ Form::text('ubicacion','', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('titulo', 'Titulo de la Imagen:') }}
            {{ Form::text('titulo','', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('pagina', 'Página:') }}
            {{ Form::text('pagina','', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('idcontenido', 'Id de la Foto:') }}
            {{ Form::text('idcontenido','', array('class' => 'form-control')) }}
        </div>

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

        {{--
        <div class="form-group row{{ $errors->has('url_img') ? 'has-error' : ''}}">
            {{ Form::label('imagen', 'Imagen:', ['class' => 'col-md-4 form-control-label text-md-right']) }}
            <div class="col-lg-7">
                {{-- @if(isset($category->url_img) && $category->url_img != '')
                <input type="hidden" name="url_img" value="{{ $category->url_img }}">
                    <div class="thumb">
                        <img src="{{ url('img/category_images/'.$category->url_img) }}" width="200px"/>
                    </div>
                @endif
                <span class="form-control upload">
                    <i aria-hidden="true" class="fa fa-upload" id="B">
                    </i>
                    <input accept="image/*" id="input-fileB" name="imagen" type="file"/>
                </span>
                {!! $errors->first('url_img', '<p class="help-block"> :message </p>') !!}
            </div>
        </div>  --}}

    {{ Form::submit('Grabar', array('class' => 'btn btn-primary')) }}

	<a href="javascript:window.history.go(-1)" class="btn btn-danger">Salir</a>

    {{ Form::close() }}

</div>


@endsection


