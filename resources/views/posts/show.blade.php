@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{ $post->title }}</h1>
    {{ $post->updated_at->toFormattedDateString() }}
    @if ($post->published)
      <span class="bg-success text-light pl-1 pr-1 ml-1 rounded">Published</span>
    @else
      <span class="bg-primary text-light pl-1 pr-1 ml-1 rounded">Draft</span>
    @endif
    <hr />
    <p class="lead">
      {{ $post->content }}
    </p>
    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
    <hr />

    <h3>Comments:</h3>
    @auth
        <div style="margin-bottom:50px;">
        <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
        <button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment()">Post Comment</button>
        </div>
    @else
        <p>You must login to post a comment here.</p>
        <a href="{{ route('login') }}">Login Now>>></a>
    @endauth


    <div class="media" style="margin-top:20px;" v-for="comment in comments">
      <div class="media-left">
        <a href="#">
          <img class="media-object mr-3" src="{{ asset('storage/user.jpg') }}" alt="...">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">@{{ comment.user.name }}</h4>
        <p>
            @{{ comment.body }}
        </p>
        <span style="color: #aaa;">on @{{ comment.created_at }}</span>
      </div>
    </div>

  </div>
@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                comments: {},
                commentBox: '',
                post: {!! $post->toJson() !!},
                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
            },
            mounted(){
                this.getComments();
                this.listen();
            },
            methods: {
                getComments(){
                    axios.get(`/api/posts/${this.post.id}/comments`)
                        .then((response) => {
                            this.comments = response.data;
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                postComment(){
                    axios.post(`/api/posts/${this.post.id}/comments`, {
                        api_token: this.user.api_token,
                        body: this.commentBox
                    })
                    .then((response) => {
                        this.comments.unshift(response.data);
                        this.commentBox = '';
                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                },
                listen() {
                    Echo.channel(`post.${this.post.id}`)
                        .listen('NewComment', (comment) => {
                            this.comments.unshift(comment);
                            // alert(JSON.stringify(comment));
                        });
                }
            }
        });
    </script>
@endsection
