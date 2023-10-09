@extends('layouts.app')

@section('template_title')
    Bingo Virtual
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{$datosParticipante->nombre .' | Tabla #'.$idTabla}}</span>
                        <div class="float-right">
                            {{-- <img src="https://cdn11.bigcommerce.com/s-ykblmppim4/images/stencil/2048x2048/products/446/804/apifiec4w__54253.1641219363.png" alt="" swidth="45" height="25"> width="305" height="200"--}}
                            <img src="https://i0.wp.com/golflakeridge.com/wp-content/uploads/2018/10/Bingo-1.png" alt="" swidth="45" height="25">
                          </div>
                    </div>
                    <div class="card-body">
                        {{-- <iframe width="305" height="200" src="https://www.youtube.com/embed/U3JaWr7ZoxE"title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
                        {{-- <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FDeusAmirr%2Fvideos%2F1206851126699251%2F&show_text=false&width=560&t=0"  style="border:none;overflow:hidden;max-width: 100%" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe> --}}
                        <img src="https://s3.amazonaws.com/prod-wp-tunota/wp-content/uploads/2021/11/elecciones-6.gif" alt="" swidth="100%" height="37">
                        {{-- <iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fweb.facebook.com%2F497403180620961%2Fvideos%2F3434853770136553%2F&show_text=false&width=560&t=0" width="305" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe> --}}
                        <table class="table" style="background-image: url('');background-size: 35% 15%; background-position: center;background-repeat: no-repeat;" >
                                <div class="float-right" style="padding: 5px">
                                    {{-- <img src="https://cdn11.bigcommerce.com/s-ykblmppim4/images/stencil/2048x2048/products/446/804/apifiec4w__54253.1641219363.png" alt="" swidth="65" height="65"> --}}
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
                            
                                @if ($loop->iteration % 5 == 0)
                                
                                <tr style="size: 22px bold">                                            
                                    <td onclick="marcarNumero('b_', {{  $dat->id }})" id="{{ 'b_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->b }}</td>
                                    <td onclick="marcarNumero('i_', {{  $dat->id }})" id="{{ 'i_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->i }}</td>
                                    <td onclick="marcarNumero('n_', {{  $dat->id }})" id="{{ 'n_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->n }}</td>
                                    <td onclick="marcarNumero('g_', {{  $dat->id }})" id="{{ 'g_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->g }}</td>
                                    <td onclick="marcarNumero('o_', {{  $dat->id }})" id="{{ 'o_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->o }}</td>
                                </tr>
                                    </table>
                                    
                                @if ( $loop->iteration != $recuento)
                                <table class="table" style="background-image: url('');background-size: 35% 15%; background-position: center;background-repeat: no-repeat;" >
                                    <thead style="background-color: #65E6A3;text-align: center">
                                        <tr>
                                        <th scope="col">B</th>
                                        <th scope="col">I</th>
                                        <th scope="col">N</th>
                                        <th scope="col">G</th>
                                        <th scope="col">O</th>
                                        </tr>
                                    </thead>
                                @endif
                                @else
                                <tr style="size: 22px bold">                                            
                                    <td onclick="marcarNumero('b_', {{  $dat->id }})" id="{{ 'b_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->b }}</td>
                                    <td onclick="marcarNumero('i_', {{  $dat->id }})" id="{{ 'i_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->i }}</td>
                                    <td onclick="marcarNumero('n_', {{  $dat->id }})" id="{{ 'n_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->n }}</td>
                                    <td onclick="marcarNumero('g_', {{  $dat->id }})" id="{{ 'g_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->g }}</td>
                                    <td onclick="marcarNumero('o_', {{  $dat->id }})" id="{{ 'o_' .$dat->id }}" style="pading: 1px; text-align: center; border-radius: 35%; width: 3px; height: 3px;">{{ $dat->o }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                        <footer>
                                <div class="float-right" style="padding: 5px">
                                    <button type="button" class="btn btn-success" onclick="bingoo({{ $id }})">¡ BINGO !</button>
                                    <button type="button" class="btn btn-warning" onclick="limpiarTabla()">Limpiar tabla</button>
                                    <img src="https://cdn11.bigcommerce.com/s-ykblmppim4/images/stencil/2048x2048/products/446/804/apifiec4w__54253.1641219363.png" alt="" swidth="65" height="65" style="padding: 5px">
                                </div>
                                <input type="text" value="{{ $idBingo }}" id="id_bingo" style="display: none">
                                <input type="text" value="{{ $tipo_juego }}" id="tipo_juego" style="display: none">
                        </footer>
                          
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    {{Html::script(asset('js/bingo/bingo.js'))}}
@endsection

