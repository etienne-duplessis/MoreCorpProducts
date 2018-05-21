@extends ('layouts.admin.master')

@section('content')

    <h2>Section title</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>SKU</th>
                <th>PRICE</th>
                <th>DESCRIPTION</th>
                <th>VIEW COUNT</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)

                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->view_count}}</td>
                        <td><a href="{{ url('/admin/products', $product->id) }}"><button class="btn">Show</button></a></td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

@endsection