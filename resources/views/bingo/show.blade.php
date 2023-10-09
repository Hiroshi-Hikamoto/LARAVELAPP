@extends('layouts.app')

@section('template_title')
    {{ $bingo->name ?? 'Show Bingo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Bingo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bingos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $bingo->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $bingo->Fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $bingo->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Id Usuario:</strong>
                            {{ $bingo->id_usuario }}
                        </div>
                        <div class="form-group">
                            <strong>Cant Tablas:</strong>
                            {{ $bingo->Cant_tablas }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
