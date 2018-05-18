@extends ('layouts.admin.master')

@section('content')

    <div class="col-sm-8 blog-main">

        <h1>Create a product</h1>

        <hr>

        {!! Form::model($product = new \App\Product, ['url' => '/admin']) !!}

            @include('products.admin.form', ['submitButtonText' => 'Add Product'])

            @include('layouts.admin.errors')

        {!! Form::close() !!}

    </div>
@endsection