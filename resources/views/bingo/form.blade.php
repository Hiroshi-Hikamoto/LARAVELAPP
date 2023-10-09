<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {{ Form::label('Nombre del bingo') }}
                    {{ Form::text('Nombre', $bingo->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Fecha Del Bingo') }}
                    {{ Form::date('Fecha', $bingo->Fecha, ['class' => 'form-control' . ($errors->has('Fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                    {!! $errors->first('Fecha', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Cantidad_de_tablas') }}
                    {{ Form::number('Cant_tablas', $bingo->Cant_tablas, ['class' => 'form-control' . ($errors->has('Cant_tablas') ? ' is-invalid' : ''), 'placeholder' => 'Minimo 1.000 Tablas','require','min' => '1000']) }}
                    {!! $errors->first('Cant_tablas', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>


        <div class="form-group" style="display: none">
            {{ Form::label('estado') }}
            {{ Form::number('estado', 1, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado','value' => '1']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="display: none">
            {{ Form::label('id_usuario') }}
            {{ Form::text('id_usuario', $idUsuario, ['class' => 'form-control' . ($errors->has('id_usuario') ? ' is-invalid' : ''), 'placeholder' => 'Id Usuario']) }}
            {!! $errors->first('id_usuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer md20">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>