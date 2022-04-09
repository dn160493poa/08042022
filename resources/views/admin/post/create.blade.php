@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('admin.post.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{old('title')}}">
                    @error('title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div id="titleHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" id="content">{{old('content')}}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div id="contentHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" name="image" class="form-control" id="image" aria-describedby="imageHelp">
                    <div id="imageHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="categories"></label>
                    <select class="form-control" multiple id="categories" name="categories[]">
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}">{{$category->title}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
