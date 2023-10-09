@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADVERTENCIA!') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('POR FAVOR LEA CON ATENCIÓN ESTE AVISO LEGAL ANTES DE FORMALIZAR SU REGISTRO.
                    Con el registro de sus datos personales o de terceros en esta página web, usted está manifestando su consentimiento libre, expreso e informado, en los terminos de la Ley de protección de datos personales (Ley 1581 de 2012) y su decretos reglamentarios, para que AVAPP, almacene, administre y utilice los datos suministrados por usted en una base de datos que tiene como finalidad enviarle información relacionada y/o en conexión con encuestas de opinión, estadísticas, eventos, páginas web, informacion de entidades o cualquier otra informacion relacionada con temas educativos y de formación, promociones o suscripciones. Así mismo, usted autoriza de modo expreso que sus datos sean compartidos con terceros y/o organizaciones aliadas, debidamente autorizados por  AVAPP y entregados conforme a las disposiciones de la ley. Si usted no está de acuerdo con el contenido de este aviso legal, le solicitamos abstenerse de registrar sus datos personales.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
