@extends('layouts.app')
@section('content')
    <a href='/posts' class='btn btn-default'>Go Back</a>
    <h1>post detail</h1>
    <h3>{{$post->title}}</h3>
    <small>{{$post->created_at}} by {{$post->user->name}}</small>
    <h4>{!!$post->body!!}</h4>
    <hr>
    
    {{--  overriding guest to access user  --}}
    @if(!Auth::guest())
        {{--  overriding user to access another user post  --}}
        @if (Auth::User()->id == $post->user_id)
            <a href='/posts/{{$post->id}}/edit' class='btn btn-default'> Edit</a>

            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif

@endsection