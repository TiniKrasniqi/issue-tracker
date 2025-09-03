@forelse($issue->tags as $tag)
  <span class="badge rounded-pill me-1 mb-1"
        style="background-color: {{ $tag->color ?? '#e5e7eb' }};
               color: #fff;
               font-size: 0.85rem;
               padding: 0.5em 0.75em;">
    {{ $tag->name }}
  </span>
@empty
  <span class="text-muted">—</span>
@endforelse
