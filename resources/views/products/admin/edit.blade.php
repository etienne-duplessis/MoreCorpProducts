@extends ('layouts.admin.master')

@section('content')

    <div class="col-sm-8 blog-main">

        <h1>Edit a product</h1>

        <hr>

        {{--{!! Form::model($product = new \App\Product, ['url' => '/admin']) !!}--}}
        {!! Form::model($product, ['method' => 'PATCH', 'action' => ['ProductsController@update', $product->id]]) !!}

            @include('products.admin.form', ['submitButtonText' => 'Update Product'])

            @include('layouts.admin.errors')

        {!! Form::close() !!}

    </div>
@endsection