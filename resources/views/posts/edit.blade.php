@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
        {!! Form::label('category', 'Category') !!}
        {!! Form::text('category', $post->category, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Category']) !!}
        <small class="text-danger">{{ $errors->first('category') }}</small>
    </div>
    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', $post->body, ['id' => 'ckeditor', 'class' => 'ckeditor', 'placeholder' => 'Body Text']) !!}
        {{-- <small class="text-danger">{{ $errors->first('body') }}</small> --}}
    </div>
    <div class="form-group">
        {!! Form::file('image') !!}
    </div>
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}


@endsection
