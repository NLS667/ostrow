<div class="row">
    {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 control-label required']) }}
    <div class="col-sm-7">
        <div class="form-group">        
            {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Nazwa', 'required' => 'required']) }}
        </div><!--form control-->
    </div>
</div>
<div class="row">
    {{ Form::label('display_name', 'Nazwa Wyświetlana', ['class' => 'col-lg-2 control-label required']) }}
    <div class="col-sm-7">
        <div class="form-group">
            {{ Form::text('display_name', null,['class' => 'form-control box-size', 'placeholder' => 'Nazwa Wyświetlana', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    {{ Form::label('sort', 'Kolejność', ['class' => 'col-lg-2 control-label']) }}
    <div class="col-sm-7">
        <div class="form-group">
            {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
        </div>
    </div>
</div>