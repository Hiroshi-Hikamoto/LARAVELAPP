<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('from') }}
            {{ Form::text('from', $msmWhatsApp->from, ['class' => 'form-control' . ($errors->has('from') ? ' is-invalid' : ''), 'placeholder' => 'From']) }}
            {!! $errors->first('from', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('idMsg') }}
            {{ Form::text('idMsg', $msmWhatsApp->idMsg, ['class' => 'form-control' . ($errors->has('idMsg') ? ' is-invalid' : ''), 'placeholder' => 'Idmsg']) }}
            {!! $errors->first('idMsg', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('text') }}
            {{ Form::text('text', $msmWhatsApp->text, ['class' => 'form-control' . ($errors->has('text') ? ' is-invalid' : ''), 'placeholder' => 'Text']) }}
            {!! $errors->first('text', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $msmWhatsApp->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>