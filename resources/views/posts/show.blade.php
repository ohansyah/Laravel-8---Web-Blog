@extends('layouts.app')

@section('content')
    <main role="main" class="container">
        <div class="jumbotron">
            <h1>{{ $post->title }}</h1>

            <div class="">
                <img style="" src="/storage/cover_images/{{ $post->image }}" alt="" class="rounded mx-auto d-block">
            </div>

            {!! $post->body !!}
        </div>
    </main>

    @if ($post->is_owner)
        <hr>
        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
        {!! link_to_route('posts.edit', 'Edit', $post->id, ['class' => 'btn btn-secondary']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    @endif

@endsection
