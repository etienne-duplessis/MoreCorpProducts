@auth
    <div class="card mb-4 box-shadow">
        <div class="card-body">

            @if($userBid)

                <h5 class="card-text">Hello {{ Auth::user()->name }}!<br />Thank you for placing your bid of R{{$userBid->amount}}!</h5>

            @else

                <h5 class="card-title">Hello {{ Auth::user()->name }}, Would you like to place a bid?</h5>

                {!! Form::model($bid = new \App\Bid, ['method' => 'POST', 'action' => ['PublicController@store']]) !!}

                {{csrf_field()}}

                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </div>
                <div class="form-group">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                </div>

                <div class="form-group">
                    {!! Form::label('amount', 'Amount:') !!}
                    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <input class="btn btn-primary form-control" type="submit" value="Place Bid">
                </div>

                @include('layouts.public.errors')

                {!! Form::close() !!}
            @endif

        </div>
    </div>

@else

    <h5 class="card-title">Hello, Would you like to place a bid?</h5>
    <h5 class="card-text">Please place a bid by simply entering your email address and the amount that you would like to bid.</h5>
    <h5 class="card-text">Please note: You will be signed in automatically. Your email address will be used with a default name of "Guest" as well as a default password of "password".</h5>

    {!! Form::model($bid = new \App\Bid, ['method' => 'POST', 'action' => ['PublicController@create']]) !!}

    {{csrf_field()}}

    {{--<div class="form-group">--}}
        {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}
    {{--</div>--}}
    <div class="form-group">
        <input type="hidden" name="product_id" value="{{$product->id}}">
    </div>

    <div class="form-group">
        <label for="userEmail">Email address:</label>
        <input type="email" class="form-control" id="userEmail" placeholder="Please insert your email address" name="email">
    </div>

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::number('amount', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <input class="btn btn-primary form-control" type="submit" value="Place Bid">
    </div>

    @include('layouts.public.errors')

    {!! Form::close() !!}

@endauth
