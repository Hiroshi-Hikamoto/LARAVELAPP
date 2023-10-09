@extends('layouts.app')

@section('template_title')
    Mis Herramientas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Mis herramientas') }}
                            </span>

                             {{-- <div class="float-right">
                                <a href="{{ route('bingos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Programar nuevo bingo') }}
                                </a>
                              </div> --}}
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="GET" action="{{ route('toAuidio') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                {{ Form::label('Texto - Audio') }}
                                {{ Form::textarea('Texto', "", ['class' => 'form-control' . ($errors->has('Texto') ? ' is-invalid' : ''), 'placeholder' => 'Texto','id' => 'textAudio']) }}
                                {!! $errors->first('Texto', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="float-right">  
                                <button class="btn btn-success" type="submit">Generar audio</button>
                            </div>

                        </form>
                        {{-- <audio src="audiotest_(1).ogg" >
                            Your browser does not support the <code>audio</code> element.
                          </audio> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    {{Html::script(asset('js/herramientas/kit.js'))}}
@endsection