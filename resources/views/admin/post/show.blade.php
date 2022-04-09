@extends('layouts.admin')
@section('content')
    <div>
        <div>{{$post->id}} . {{$post->title}}</div>
        <div>{{$post->content}}</div>
    </div>
    <div>
        <a href="{{ route('admin.post.edit', $post->id)}}">Edit</a>
        <a href="{{ route('admin.post.index') }}">Back</a>
    </div>
@endsection
