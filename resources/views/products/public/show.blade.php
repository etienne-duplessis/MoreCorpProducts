@extends ('layouts.public.master')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{$product->name}}</h1>
            <p class="lead text-muted">{{$product->description}}</p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">

                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16381872d53%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16381872d53%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text"><strong>{{$product->name}}</strong></p>
                            <p class="card-text">{{$product->description}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                {{--<div class="btn-group">--}}
                                    {{--<a href="{{ url('/public/products', $product->id) }}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>--}}
                                    {{--<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>--}}
                                {{--</div>--}}
                                <small class="text-muted">Updated at: {{$product->updated_at}}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    @unless($bids->isEmpty())
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                                <h5 class="card-title">Current Bids:</h5>
                                <p class="card-text">Highest bid: R{{$highestBid}}</p>
                                <p class="card-text">Lowest bid: R{{$lowestBid}}</p>
                                <p class="card-text">Bid average: R{{$averageBid}}</p>
                            </div>
                        </div>
                    @else
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                                <h5 class="card-text">There are currently no bids on this item!</h5>
                            </div>
                        </div>
                    @endunless

                    @include ('products.public.bid')

                </div>

            </div>
        </div>
    </div>
@endsection