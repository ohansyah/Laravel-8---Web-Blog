@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <div class="row mb-2">
        @if (count($posts))
            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">{{ $post->category }}</strong>
                            <h4 class="mb-0">{{ $post->title }}</h4>
                            <div class="mb-1 text-muted">{{ $post->created_at }}</div>
                            <p class="card-text mb-auto">
                                @php
                                    echo substr($post->body, 0, 120).'...';
                                @endphp
                            </p>
                            <a href="/posts/{{ $post->id }}" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{$post->image}}" class="img-thumbnail" alt="...">
                        </div>
                    </div>
                </div>

            @endforeach
            <div class="d-flex justify-content-center">{{ $posts->links() }}
            </div>

        @else
            <p>Post Not Found</p>
        @endif
    </div>
@endsection
