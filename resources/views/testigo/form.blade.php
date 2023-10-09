<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Datos del Testigo</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{ Form::label('cedula') }}
                            {{ Form::text('cedula', $testigo->Cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Cedula']) }}
                            {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('Primer Nombre') }}
                            {{ Form::text('PrimerNombre', $testigo->PrimerNombre, ['class' => 'form-control' . ($errors->has('PrimerNombre') ? ' is-invalid' : ''), 'placeholder' => 'Primer Nombre']) }}
                            {!! $errors->first('PrimerNombre', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('Segundo Nombre') }}
                            {{ Form::text('SegundoNombre', $testigo->SegundoNombre, ['class' => 'form-control' . ($errors->has('SegundoNombre') ? ' is-invalid' : ''), 'placeholder' => 'Segundo Nombre Nombre']) }}
                            {!! $errors->first('SegundoNombre', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('Primer Apellido') }}
                            {{ Form::text('PrimerApellido', $testigo->PrimerApellido, ['class' => 'form-control' . ($errors->has('PrimerApellido') ? ' is-invalid' : ''), 'placeholder' => 'Primer Apellido']) }}
                            {!! $errors->first('PrimerApellido', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('Segundo Apellido') }}
                            {{ Form::text('SegundoApellido', $testigo->SegundoApellido, ['class' => 'form-control' . ($errors->has('SegundoApellido') ? ' is-invalid' : ''), 'placeholder' => 'Segundo Apellido']) }}
                            {!! $errors->first('SegundoApellido', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{ Form::label('Celular') }}
                            {{ Form::text('Celular', $testigo->Celular, ['class' => 'form-control' . ($errors->has('Celular') ? ' is-invalid' : ''), 'placeholder' => 'Celular']) }}
                            {!! $errors->first('Celular', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <p></p>

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Asignacionde Puesto</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('Departamento') }}
                            {{ Form::text('id_departamento', $testigo->id_departamento, ['class' => 'form-control' . ($errors->has('id_departamento') ? ' is-invalid' : ''), 'placeholder' => 'Id Departamento']) }}
                            {!! $errors->first('id_departamento', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('Municipio') }}
                            {{ Form::text('id_municipio', $testigo->id_municipio, ['class' => 'form-control' . ($errors->has('id_municipio') ? ' is-invalid' : ''), 'placeholder' => 'Id Municipio']) }}
                            {!! $errors->first('id_municipio', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ Form::label('Puesto') }}
                            {{ Form::text('id_puesto', $testigo->id_puesto, ['class' => 'form-control' . ($errors->has('id_puesto') ? ' is-invalid' : ''), 'placeholder' => 'Id Puesto']) }}
                            {!! $errors->first('id_puesto', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            {{ Form::label('mesa') }}
                            {{ Form::text('mesa', $testigo->mesa, ['class' => 'form-control' . ($errors->has('mesa') ? ' is-invalid' : ''), 'placeholder' => 'Mesa']) }}
                            {!! $errors->first('mesa', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            {{ Form::label('Campaña') }}
                            {{ Form::text('id_campaña', $testigo->id_campaña, ['class' => 'form-control' . ($errors->has('id_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Id Campaña']) }}
                            {!! $errors->first('id_campaña', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <p></p>

    <div class="box-footer mt20 pull-right" style="justify-content: right">
        <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</div>