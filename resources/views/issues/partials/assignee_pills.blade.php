
<div class="d-flex flex-wrap">
@forelse($issue->users as $u)
  <span class="badge rounded-pill me-2 mb-2 d-inline-flex align-items-center"
        style="background:#334155;color:#fff;padding:.45rem .7rem;">
  
    {{ $u->name }} {{ $u->surname ?? '' }}
  </span>
@empty
  <span class="text-muted">—</span>
@endforelse
</div>
