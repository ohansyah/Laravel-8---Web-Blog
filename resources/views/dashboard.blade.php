@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome Back !') }}

                    </div>
                </div>

                @if (count($posts))
                    @foreach ($posts as $post)
                        <div class="well">
                            <div
                                class="row g-0 border rounded overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">
                                <div class="col-xl-3 col-md-4 col-sm-5">
                                    <img style="width: 100%" src="/storage/cover_images/{{ $post->image }}" alt=""
                                        class="img-thumbnail"
                                        onerror="this.onerror=null;this.src='{{ Config::get('const_vars.no_image') }}';">
                                </div>

                                <div class="col p-4 d-flex flex-column position-static">
                                    <h4 class="mb-0">{{ $post->title }}</h4>
                                    <strong class="d-inline-block mb-1">{{ $post->category }}</strong>
                                    <div class="mb-1 text-muted">{{ $post->created_at }}</div>
                                    <p class="card-text">
                                        @php
                                            echo substr($post->body, 0, 120);
                                        @endphp
                                    </p>
                                    <a href="/posts/{{ $post->id }}" class="stretched-link"></a>
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


        </div>

    </div>
@endsection
