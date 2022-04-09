@extends('layouts.main')
@section('content')
    <div>
        <div>{{$post->id}} . {{$post->title}}</div>
        <div>{{$post->content}}</div>
    </div>
    <div>
        <a href="{{ route('post.edit', $post->id)}}">Edit</a>
        <a href="{{ route('post.index') }}">Back</a>
    </div>
@endsection
