@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1>All Posts</h1>
      </div>

      <div class="col-md-4 mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary pull-right" style="margin-top:15px;">Create New Post</a>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Title</th>
          <th>Published</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($posts as $post)
          <tr>
            <th>{{ $post->id }}</th>
            <td><a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></td>
            <td>
                @if ($post->published)
                    <span class="bg-success text-light pl-1 pr-1 rounded">Published</span>
                @else
                    <span class="bg-primary text-light pl-1 pr-1 rounded">Draft</span>
                @endif
            </td>
            <td><a href="{{ route('posts.edit', $post) }}" class="btn btn-light">Edit</a></td>
          </tr>
        @empty
          <tr>
              <td colspan="4">No posts yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="text-center">
      {{ $posts->links() }}
    </div>

  </div>
@endsection
