@extends ('layouts.master')

@section('content')

    <div class="col-sm-8 blog-main">

        <h1>Create a product</h1>

        <hr>

        <form method="POST" action="/products">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="sku">Product SKU:</label>
                <input type="text" class="form-control" id="sku" name="sku" required>
            </div>
            <div class="form-group">
                <label for="price">Product Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Product Description:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include('layouts.errors')
        </form>



    </div>
@endsection