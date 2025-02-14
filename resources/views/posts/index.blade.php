@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        event.target.closest('form').submit();
        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
      }
    });
  }
</script>
<div class="container d-flex justify-content-between align-items-center">
  <h1>Posts</h1>
  <a href="{{route('posts.create')}}" class="btn btn-success">Create post</a>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post['id']}}</th>
      <td>{{$post['title']}}</td>
      <td>
        <a href="{{route('posts.show',$post['id'])}}" class="btn btn-primary">Show post</a>
        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" onsubmit="return confirmDelete(event)" class="d-inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete post</button>
        </form>
        <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-warning">Edit post</a>
      </td>
      @endforeach
    </tr>
  </tbody>
</table>
<div class="d-flex justify-content-center">
  {{$posts->links('pagination::bootstrap-4')}}
</div>
@endsection