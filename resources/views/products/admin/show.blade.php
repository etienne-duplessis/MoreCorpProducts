@extends ('layouts.admin.master')

@section('content')

    <article>
        <h1><a href="{{ url('/admin', $product->id) }}">{{$product->name}}</a></h1>

        <div class="body">
            <p>SKU: {{$product->sku}}</p>
            <p>Price: R{{$product->price}}</p>
            <p>Description: {{$product->description}}</p>
            <p>View Count: {{$product->view_count}}</p>
        </div>
        <div class="btn-group">
            <a href="{{ url('/admin/edit', $product->id) }}"><button type="button" class="btn btn-primary" style="margin-right:10px;">Edit</button></a>

            <form id="deleteButton" action="{{action('ProductsController@destroy', $product->id)}}" method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </article>
@endsection