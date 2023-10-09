@extends('layouts.app')

@section('template_title')
    {{ $cargueContacto->name ?? 'Show Cargue Contacto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cargue Contacto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cargue-contactos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Contacto:</strong>
                            {{ $cargueContacto->contacto }}
                        </div>
                        <div class="form-group">
                            <strong>Var1:</strong>
                            {{ $cargueContacto->var1 }}
                        </div>
                        <div class="form-group">
                            <strong>Var2:</strong>
                            {{ $cargueContacto->var2 }}
                        </div>
                        <div class="form-group">
                            <strong>Var3:</strong>
                            {{ $cargueContacto->var3 }}
                        </div>
                        <div class="form-group">
                            <strong>Var4:</strong>
                            {{ $cargueContacto->var4 }}
                        </div>
                        <div class="form-group">
                            <strong>Var5:</strong>
                            {{ $cargueContacto->var5 }}
                        </div>
                        <div class="form-group">
                            <strong>Var6:</strong>
                            {{ $cargueContacto->var6 }}
                        </div>
                        <div class="form-group">
                            <strong>Var7:</strong>
                            {{ $cargueContacto->var7 }}
                        </div>
                        <div class="form-group">
                            <strong>Var8:</strong>
                            {{ $cargueContacto->var8 }}
                        </div>
                        <div class="form-group">
                            <strong>Var9:</strong>
                            {{ $cargueContacto->var9 }}
                        </div>
                        <div class="form-group">
                            <strong>Var10:</strong>
                            {{ $cargueContacto->var10 }}
                        </div>
                        <div class="form-group">
                            <strong>Id Usuario:</strong>
                            {{ $cargueContacto->id_usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Id Campaña:</strong>
                            {{ $cargueContacto->id_campaña }}
                        </div>
                        <div class="form-group">
                            <strong>Fec Creacion:</strong>
                            {{ $cargueContacto->fec_creacion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $cargueContacto->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
