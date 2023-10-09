@extends('layouts.app')

@section('template_title')
    Update Campaña
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Configurar Campaña</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('campana.update', $campaña->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body" >
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2" style="display: none">
                                                {{ Form::label('id') }}
                                                {{ Form::text('id', $campaña->id, ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña','reqired']) }}
                                                {!! $errors->first('nombre_campaña', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::label('nombre_campaña') }}
                                                {{ Form::text('nombre_campaña', $campaña->nombre_campaña, ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña','reqired']) }}
                                                {!! $errors->first('nombre_campaña', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <div class="col-md-2">
                                                {{ Form::label('Tipo de mensajes') }}
                                                {{ Form::select('idTipo', array(1 => 'Marketin',2 => 'Encuesta',3 => 'Notificacion'), $campaña->idTipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opcion']) }}
                                                {{-- {{ Form::select('nombre_campaña', array(1 => 'Marketin',2 => 'Encuesta',3 => 'Notificacion'), ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña']) }} --}}
                                                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <div class="col-md-2">
                                                {{ Form::label('Enviar desde') }}
                                                {{ Form::select('idNumero', $numero, $campaña->idNumero, ['class' => 'form-control' . ($errors->has('idNumero') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opcion']) }}
                                                {{-- {{ Form::select('nombre_campaña', array(1 => 'Marketin',2 => 'Encuesta',3 => 'Notificacion'), ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña']) }} --}}
                                                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                            <div class="col" style="margin-block-start: 30px">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                            {{-- <div class="col" style="margin-block-start: 30px">
                                                <button type="button" class="btn btn-primary" onclick="crearCampana()"> Crear</button>
                                            </div> --}}
                                        </div>
                                    </div>
                            
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
