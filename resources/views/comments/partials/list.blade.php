@foreach($comments as $comment)
  @include('comments.partials.item', ['comment' => $comment])
@endforeach
