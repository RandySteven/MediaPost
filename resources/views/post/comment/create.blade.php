@if (is_array($comments) || is_object($comments))
@foreach ($comments as $comment)
<div class="display-comment">
    <img width="40" class="rounded-circle mr-3" src="{{ $post->user->gravatar() }}" alt="">
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('comment.reply') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="comment" class="form-control" placeholder="Reply to {{ $comment->user->name }}"/>
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
        </div>
    </form>
    <div class="ml-3">
        @include('post.comment.create', ['comments' => $comment->replies])
    </div>
</div>
@endforeach
@endif

