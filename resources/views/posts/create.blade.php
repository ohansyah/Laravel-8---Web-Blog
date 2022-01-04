@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    {{-- {!! Form::open(['url' => 'posts/create', 'method'=> 'POST']) !!} --}}
    {!! Form::open(['route' => 'posts.store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
        {!! Form::label('category', 'Category') !!}
        {!! Form::text('category', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Category']) !!}
        <small class="text-danger">{{ $errors->first('category') }}</small>
    </div>
    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', null, ['id' => 'ckeditor', 'class' => 'ckeditor_class', 'placeholder' => 'Body Text']) !!}
        {{-- <small class="text-danger">{{ $errors->first('body') }}</small> --}}
    </div>
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}


@endsection
