@extends ('layouts.admin.master')

@section('content')

    <div class="col-sm-8 blog-main">

        <h1>Create a product</h1>

        <hr>

        {!! Form::model($product = new \App\Product, ['url' => 'products']) !!}

        {{--<form method="POST" action="/products">--}}
            {{csrf_field()}}
            <div class="form-group">
                {{--<label for="name">Product Name:</label>--}}
                {{--<input type="text" class="form-control" id="name" name="name" required>--}}
                {!! Form::label('name', 'Product Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{--<label for="sku">Product SKU:</label>--}}
                {{--<input type="text" class="form-control" id="sku" name="sku" required>--}}
                {!! Form::label('sku', 'SKU:') !!}
                {!! Form::text('sku', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{--<label for="price">Product Price:</label>--}}
                {{--<input type="number" class="form-control" id="price" name="price" required>--}}
                {!! Form::label('price', 'Product Price:') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {{--<label for="description">Product Description:</label>--}}
                {{--<input type="text" class="form-control" id="description" name="description" required>--}}
                {!! Form::label('description', 'Description:') !!}
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include('layouts.admin.errors')
        {{--</form>--}}
        {!! Form::close() !!}

    </div>
@endsection