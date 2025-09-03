<div class="comment-item border rounded p-3 mb-2">
  <div class="d-flex justify-content-between align-items-center mb-1">
    <strong>{{ $comment->author_name }}</strong>
    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
  </div>
  <div>{{ $comment->body }}</div>
</div>
