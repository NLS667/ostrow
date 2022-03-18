<div class="form-group">
    {{ Form::label('name', 'Nazwa', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('name', null, ['class' => 'form-control box-size', 'placeholder' => 'Nazwa', 'required' => 'required']) }}
    </div><!--col-lg-10-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('display_name', 'Nazwa Wyświetlana', ['class' => 'col-lg-2 control-label required']) }}

    <div class="col-lg-10">
        {{ Form::text('display_name', null,['class' => 'form-control box-size', 'placeholder' => 'Nazwa Wyświetlana', 'required' => 'required']) }}
    </div><!--col-lg-3-->
</div><!--form control-->

<div class="form-group">
    {{ Form::label('sort', 'Kolejność', ['class' => 'col-lg-2 control-label']) }}

    <div class="col-lg-10">
        {{ Form::text('sort', null, ['class' => 'form-control box-size', 'placeholder' => 'Kolejność']) }}
    </div><!--col-lg-10-->
</div><!--form control-->