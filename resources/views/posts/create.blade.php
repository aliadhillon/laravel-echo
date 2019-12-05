@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>New Post</h1>
    <hr />
    <form method="post" action="{{ route('posts.store') }}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="post_title" name="title" placeholder="Title" value="{{ old('title') }}" autocomplete="off">
        @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control @error('title') is-invalid @enderror" rows="10" id="post_content" name="content" placeholder="Write something amazing..." value="{{ old('content') }}"></textarea>
        @error('content')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group form-check">
        <input class="form-check-input @error('published') is-invalid @enderror" type="checkbox" value="1" name="published">
        <label class="form-check-label" for="published">Published</label>
        @error('published')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-lg">Save Post</button>
    </form>

  </div>
@endsection
