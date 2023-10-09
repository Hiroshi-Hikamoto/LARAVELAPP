<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('contacto') }}
            {{ Form::text('contacto', $cargueContacto->contacto, ['class' => 'form-control' . ($errors->has('contacto') ? ' is-invalid' : ''), 'placeholder' => 'Contacto']) }}
            {!! $errors->first('contacto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var1') }}
            {{ Form::text('var1', $cargueContacto->var1, ['class' => 'form-control' . ($errors->has('var1') ? ' is-invalid' : ''), 'placeholder' => 'Var1']) }}
            {!! $errors->first('var1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var2') }}
            {{ Form::text('var2', $cargueContacto->var2, ['class' => 'form-control' . ($errors->has('var2') ? ' is-invalid' : ''), 'placeholder' => 'Var2']) }}
            {!! $errors->first('var2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var3') }}
            {{ Form::text('var3', $cargueContacto->var3, ['class' => 'form-control' . ($errors->has('var3') ? ' is-invalid' : ''), 'placeholder' => 'Var3']) }}
            {!! $errors->first('var3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var4') }}
            {{ Form::text('var4', $cargueContacto->var4, ['class' => 'form-control' . ($errors->has('var4') ? ' is-invalid' : ''), 'placeholder' => 'Var4']) }}
            {!! $errors->first('var4', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var5') }}
            {{ Form::text('var5', $cargueContacto->var5, ['class' => 'form-control' . ($errors->has('var5') ? ' is-invalid' : ''), 'placeholder' => 'Var5']) }}
            {!! $errors->first('var5', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var6') }}
            {{ Form::text('var6', $cargueContacto->var6, ['class' => 'form-control' . ($errors->has('var6') ? ' is-invalid' : ''), 'placeholder' => 'Var6']) }}
            {!! $errors->first('var6', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var7') }}
            {{ Form::text('var7', $cargueContacto->var7, ['class' => 'form-control' . ($errors->has('var7') ? ' is-invalid' : ''), 'placeholder' => 'Var7']) }}
            {!! $errors->first('var7', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var8') }}
            {{ Form::text('var8', $cargueContacto->var8, ['class' => 'form-control' . ($errors->has('var8') ? ' is-invalid' : ''), 'placeholder' => 'Var8']) }}
            {!! $errors->first('var8', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var9') }}
            {{ Form::text('var9', $cargueContacto->var9, ['class' => 'form-control' . ($errors->has('var9') ? ' is-invalid' : ''), 'placeholder' => 'Var9']) }}
            {!! $errors->first('var9', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('var10') }}
            {{ Form::text('var10', $cargueContacto->var10, ['class' => 'form-control' . ($errors->has('var10') ? ' is-invalid' : ''), 'placeholder' => 'Var10']) }}
            {!! $errors->first('var10', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_usuario') }}
            {{ Form::text('id_usuario', $cargueContacto->id_usuario, ['class' => 'form-control' . ($errors->has('id_usuario') ? ' is-invalid' : ''), 'placeholder' => 'Id Usuario']) }}
            {!! $errors->first('id_usuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_campaña') }}
            {{ Form::text('id_campaña', $cargueContacto->id_campaña, ['class' => 'form-control' . ($errors->has('id_campaña') ? ' is-invalid' : ''), 'placeholder' => 'Id Campaña']) }}
            {!! $errors->first('id_campaña', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fec_creacion') }}
            {{ Form::text('fec_creacion', $cargueContacto->fec_creacion, ['class' => 'form-control' . ($errors->has('fec_creacion') ? ' is-invalid' : ''), 'placeholder' => 'Fec Creacion']) }}
            {!! $errors->first('fec_creacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $cargueContacto->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>