@extends('layouts.app')
@section('content')
    <h1>post</h1>
    @foreach($posts as $post)
      <div class='well'>
        <h3><a href='/posts/{{$post->id}}'>{{$post->title}}</a></h3>
        <small>written on {{$post->created_at}} by {{$post->user->name}}</small>
        <h4>{!!$post->body!!}</h4>
      </div>
    @endforeach
    {{$posts->links()}}
@endsection