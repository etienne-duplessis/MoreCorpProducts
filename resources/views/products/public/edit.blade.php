@extends ('layouts.admin.master')

@section('content')

    <div class="col-sm-8 blog-main">

        <h1>Edit a product</h1>

        <hr>

        {!! Form::model($product, ['method' => 'PATCH', 'action' => ['AdminController@update', $product->id]]) !!}

            @include('products.admin.form', ['submitButtonText' => 'Update Product'])

            @include('layouts.admin.errors')

        {!! Form::close() !!}

    </div>
@endsection