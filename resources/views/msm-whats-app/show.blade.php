@extends('layouts.app')

@section('template_title')
    {{ $msmWhatsApp->name ?? 'Show Msm Whats App' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Msm Whats App</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('msm-whats-apps.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>From:</strong>
                            {{ $msmWhatsApp->from }}
                        </div>
                        <div class="form-group">
                            <strong>Idmsg:</strong>
                            {{ $msmWhatsApp->idMsg }}
                        </div>
                        <div class="form-group">
                            <strong>Text:</strong>
                            {{ $msmWhatsApp->text }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $msmWhatsApp->tipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
