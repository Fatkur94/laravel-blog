@extends('layouts.app')
@section('content')
    <h1>{{$title}}</h1>
    @if(count($makanan) > 0)
        <ul>
        @foreach($makanan as $menu)
            <li>{{$menu}}</li>
        @endforeach
        </ul>
    @endif
@endsection