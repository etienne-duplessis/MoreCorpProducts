{{csrf_field()}}
<div class="form-group">
    {!! Form::label('name', 'Product Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('sku', 'SKU:') !!}
    {!! Form::text('sku', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', 'Product Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>