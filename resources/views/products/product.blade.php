<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{$product->id}}">
            {{$product->title}}
        </a>
    </h2>
    <p class="blog-post-meta">
        {{$product->user->name}} on
        {{$product->created_at->toFormattedDateString()}}
    </p>

    {{$product->body}}
</div><!-- /.blog-post -->