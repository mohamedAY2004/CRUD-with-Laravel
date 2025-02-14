@extends('layouts.app')
@section('content')
    <div class="card m-2" style="width: 18rem;">
        <img src="{{asset('images/'.$post['image'])}}" class="card-img-top" alt="{{ $post['title'] }} image">
        <div class="card-body">
            <h5 class="card-title">{{$post['title']}}</h5>
            <p class="card-text">{{$post['content']}}</p>
            <a href="{{route('posts.index')}}" class="btn btn-primary">Go back</a>
        </div>
    </div>
@endsection