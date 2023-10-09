@extends('layouts.app')

@section('template_title')
    Campaña
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" class="navbar-brand" style="color: white">
                                {{ __('Campaña') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('campana.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nueva Campaña') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        
										<th>Nombre Campaña</th>
										<th>Estado</th>
										{{-- <th>Id Usuario</th> --}}

                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campañas as $campaña)
                                        <tr>
                                            {{-- <td>{{ ++$i }}</td> --}}
                                            
											<td>{{ $campaña->nombre_campaña }}</td>
											<td>{{ $campaña->estado }}</td>
											{{-- <td>{{ $campaña->id_usuario }}</td> --}}

                                            <td>
                                                <form action="{{ route('campana.destroy',$campaña->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('campaña.show',$campaña->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a> --}}
                                                    <a class="btn btn-sm btn-warning" href="{{ route('campana.edit',$campaña->id) }}"><i class="fa fa-fw fa-edit"></i> Configurar</a>
                                                    <a class="btn btn-sm btn-info" onclick="AbrirModal({{$campaña->id}})"><i class="fa fa-fw fa-edit"></i> Cargar archivo</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-fw fa-trash"></i> Enviar</button>
                                                    <a class="btn btn-outline-success" href="{{ route('campana.show',$campaña->id) }}"><i class="fa fa-fw fa-edit"></i> Reporte</a>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-xl" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="mediumBody">
                                    <div class="form-group" >
                                        <div class="row">
                                            <div class="col">
                                                {{ Form::label('Archivo a cargar') }}
                                                {!! Form::file('file', ['class' => 'form-control' . ($errors->has('Invitacion') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar motivo', 'required','onchange' => 'cargarArchivo(this)','accept'=> '.csv','id' => 'fileUpload']) !!} 
                                            </div>
                                            <div class="col" style="margin-block-start: 35px">
                                                <button type="button" class="btn btn-sm btn-info" onclick="upload()"><i class="fa fa-fw fa-trash"></i> Cargar archivo</button>
                                            </div>
                                        </div>
                                        {{-- {{ Form::text('num_id', $afiliado->id, ['class' => 'form-control' . ($errors->has('num_id') ? ' is-invalid' : ''), 'placeholder' => 'num_id', 'id' => 'num_id', /*'disabled' => 'disabled',*/ 'style' => 'display: none']) }}  --}}
                                        <p></p>
                                        <div class="table-responsive" id="dvCSV">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer"  >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $campañas->links() !!}
            </div>
        </div>
    </div>
@endsection


@section('js')
    {{Html::script(asset('js/campana/campana.js'))}}
@endsection