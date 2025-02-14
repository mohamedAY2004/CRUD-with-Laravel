@extends('layouts.app')
@section('content')
<h1>Create post</h1>
<form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" >{{old('content',$post->content)}}</textarea>
        @error('content')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control  @error('image') is-invalid @enderror" type="file" name="image" id="formFile">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection