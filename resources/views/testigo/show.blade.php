@extends('layouts.app')

@section('template_title')
    {{ $testigo->name ?? 'Show Testigo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Testigo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('testigos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $testigo->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Nombres:</strong>
                            {{ $testigo->PrimerNombre }}
                        </div>
                        <div class="form-group">
                            <strong>Nombres:</strong>
                            {{ $testigo->SegundoNombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellidos:</strong>
                            {{ $testigo->PrimerApellido }}
                        </div>
                        <div class="form-group">
                            <strong>Nombres:</strong>
                            {{ $testigo->SegundoApellido }}
                        </div>
                        <div class="form-group">
                            <strong>Celular:</strong>
                            {{ $testigo->Celular }}
                        </div>
                        <div class="form-group">
                            <strong>Id Departamento:</strong>
                            {{ $testigo->id_departamento }}
                        </div>
                        <div class="form-group">
                            <strong>Id Municipio:</strong>
                            {{ $testigo->id_municipio }}
                        </div>
                        <div class="form-group">
                            <strong>Id Puesto:</strong>
                            {{ $testigo->id_puesto }}
                        </div>
                        <div class="form-group">
                            <strong>Mesa:</strong>
                            {{ $testigo->mesa }}
                        </div>
                        <div class="form-group">
                            <strong>Id Campaña:</strong>
                            {{ $testigo->id_campaña }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
