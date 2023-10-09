<div class="box box-info padding-1">
    <div class="box-body" >
        
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <p></p>
                </div>
                <div class="col-md-4">
                    {{ Form::label('nombre_campaña') }}
                    {{ Form::text('nombre_campaña', $campaña->nombre_campaña, ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña','reqired']) }}
                    {!! $errors->first('nombre_campaña', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-2">
                    {{ Form::label('Tipo de mensajes') }}
                    {{ Form::select('idTipo', array(1 => 'Marketin',2 => 'Encuesta',3 => 'Notificacion'), 1, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opcion']) }}
                    {{-- {{ Form::select('nombre_campaña', array(1 => 'Marketin',2 => 'Encuesta',3 => 'Notificacion'), ['class' => 'form-control' . ($errors->has('nombre_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Campaña']) }} --}}
                    {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col" style="margin-block-start: 30px">
                    <button type="button" class="btn btn-primary" onclick="crearCampana()"> Crear</button>
                </div>
            </div>
        </div>
        <div class="form-group" style="display: none">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="display: none">
            {{ Form::label('id_usuario') }}
            {{ Form::text('id_usuario', $idUsuario, ['class' => 'form-control' . ($errors->has('id_usuario') ? ' is-invalid' : ''), 'placeholder' => 'Id Usuario']) }}
            {!! $errors->first('id_usuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div id="templates-container">
            <!-- Aquí se mostrarán las plantillas agregadas -->
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <span id="card_title" class="navbar-brand" style="color: white">
                                    {{ __('Opciones de plantilla') }}
                                </span>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form id="template-form">
                                @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="type">Tipo:</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="1">Lista</option>
                                                    <option value="2">Mensaje con Botón</option>
                                                </select>
                                            </div>
                                        </div><p></p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="message">Mensaje:</label>
                                                <textarea type="textarea" name="message" id="message" class="form-control"></textarea>
                                            </div>
                                        </div><p></p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="description">Descripción:</label>
                                                <input type="text" name="description" id="description" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="link">Enlace:</label>
                                                <input type="text" name="link" id="link" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                
                                                            <span id="card_title" class="navbar-brand" style="color: white">
                                                                {{ __('Opciones de plantilla') }}
                                                            </span>
                                
                                                             <div class="float-right">
                                                                <a href="{{ route('campana.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                                                  {{ __('Agregar opcion') }}
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
                                                                    {{-- @foreach ($campañas as $campaña)
                                                                        <tr>
                                                                            <td>{{ ++$i }}</td>
                                                                            
                                                                            <td>{{ $campaña->nombre_campaña }}</td>
                                                                            <td>{{ $campaña->estado }}</td>
                                                                            <td>{{ $campaña->id_usuario }}</td>
                                
                                                                            <td>
                                                                                <form action="{{ route('campana.destroy',$campaña->id) }}" method="POST">
                                                                                    <a class="btn btn-sm btn-primary " href="{{ route('campaña.show',$campaña->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                                                    <a class="btn btn-sm btn-warning" href="{{ route('campana.edit',$campaña->id) }}"><i class="fa fa-fw fa-edit"></i> Configurar</a>
                                                                                    <a class="btn btn-sm btn-info" onclick="AbrirModal({{$campaña->id}})"><i class="fa fa-fw fa-edit"></i> Cargar archivo</a>
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-fw fa-trash"></i> Enviar</button>
                                                                                    <a class="btn btn-outline-success" href="{{ route('campana.show',$campaña->id) }}"><i class="fa fa-fw fa-edit"></i> Reporte</a>
                                                                                </form>
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="modal fade bd-example-modal-xl" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                                                                        {{ Form::text('num_id', $afiliado->id, ['class' => 'form-control' . ($errors->has('num_id') ? ' is-invalid' : ''), 'placeholder' => 'num_id', 'id' => 'num_id', /*'disabled' => 'disabled',*/ 'style' => 'display: none']) }} 
                                                                        <p></p>
                                                                        <div class="table-responsive" id="dvCSV">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="modal-footer"  >
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p></p>
                                <button type="button" id="add-template-btn" class="btn btn-primary">Agregar Plantilla</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    
    {{-- <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div> --}}
</div>