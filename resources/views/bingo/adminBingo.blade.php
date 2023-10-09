
@extends('layouts.app')

@section('template_title')
    Bingo Virtual
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row" >
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default" style="width: 350px">
                    <div class="card-header">
                        <span class="card-title">Tabla Principal</span>
                        <div class="float-right">
                            <img src="https://i0.wp.com/golflakeridge.com/wp-content/uploads/2018/10/Bingo-1.png" alt="" swidth="45" height="25">
                          </div>
                    </div>
                    <div class="card-body">
                        <table class="table" style="background-image: url('');background-size: 35% 15%; background-position: center;background-repeat: no-repeat;" >
                            <div class=".float-end">
                                {{ Form::number('idBingo', $idBingo, ['class' => 'form-control' . ($errors->has('idBingo') ? ' is-invalid' : ''), 'placeholder' => 'idBingo','style' => 'display: none']) }}
                                {{-- {{ Form::label($idBingo) }} --}}
                                <b>
                                    {{ Form::label($Nombre) }}
                                </b>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ Form::select('idTipoBingo', array(1 => 'Bingo tabla llena',2 => 'Bingo en L',3 => 'Bingo en O',4 => 'Bingo en X'), 1, ['class' => 'form-control' . ($errors->has('idTipoBingo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opcion','id' => 'tipo_juego']) }}
                                        <input type="text" value="{{ $idBingo }}" id="id_bingo" style="display: none">
                                    </div>
                                    {{-- <div class="col-sm-2">
                                        <img src="{{ asset('/images/compartidos/BINGO LLENA.jpg') }}" class="logo"  alt="" swidth="55" height="55" style="padding: 2px"/>
                                    </div> --}}
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-info" onclick="ponerJugar({{  $idBingo }})" value="{{ $idBingo }}" id="btnJugar">Jugar</button>
                                    </div>
                                </div>
                                <p></p>
                                {{-- <div class="form-check form-switch">
                                    <p></p>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="escuchar(this)">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Jugar</label>
                                </div> --}}
                            </div>
                            <thead style="background-color: #65E6A3;text-align: center">
                                {{-- <tr>Tabla #123456</tr> --}}
                                <tr>
                                <th scope="col">B</th>
                                <th scope="col">I</th>
                                <th scope="col">N</th>
                                <th scope="col">G</th>
                                <th scope="col">O</th>
                                </tr>
                            </thead>
                            @foreach ($data as $dat)
                                <tr style="size: 22px bold">                                            
                                    <td onclick="marcarNumero('b_', {{  $dat->b }})" id="{{ 'b_' .$dat->b }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->b }}</td>
                                    <td onclick="marcarNumero('i_', {{  $dat->b }})" id="{{ 'i_' .$dat->b }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->i }}</td>
                                    <td onclick="marcarNumero('n_', {{  $dat->b }})" id="{{ 'n_' .$dat->b }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->n }}</td>
                                    <td onclick="marcarNumero('g_', {{  $dat->b }})" id="{{ 'g_' .$dat->b }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->g }}</td>
                                    <td onclick="marcarNumero('o_', {{  $dat->b }})" id="{{ 'o_' .$dat->b }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->o }}</td>
                                </tr>
                            @endforeach
                        </table>
                        
                          {{-- <button type="button" class="btn btn-success">¡ BINGO !</button> --}}
                          <button type="button" class="btn btn-warning" onclick="limpiarTabla()">Limpiar tabla</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    {{Html::script(asset('js/bingo/bingo.js'))}}
@endsection

