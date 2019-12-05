@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Edit Post</h1>
    <hr />
    <form method="post" action="{{ route('posts.update', $post) }}" id="update-post">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="post_title">Title</label>
            <input type="text" class="form-control" id="post_title" placeholder="Title" value="{{ $post->title }}" name="title">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" rows="10" id="post_content" placeholder="Write something amazing..." name="content">{{ $post->content }}</textarea>
        </div>

        <div class="form-group">
            <label><input type="checkbox" name="published" value="1" style="margin-right: 15px;" {{ $post->published ? "checked" : '' }}>Published</label>
        </div>
        
        <button type="submit" class="btn btn-success">Update post</button>
        <a class="btn btn-light" href="{{ route('posts.show', $post) }}">Cancel</a>
    </form>
        <button 
            onclick="
            if(confirm('Are You sure?')){
             document.getElementById('delete-post-form').submit();}" 
             class="btn btn-danger float-right">
            <i class="fa fa-trash">Delete</i>
        </button>
        <form id="delete-post-form" method="post" action="{{ route('posts.destroy', $post->id) }}">
            @csrf
            @method('DELETE')
        </form>
  </div>
@endsection
