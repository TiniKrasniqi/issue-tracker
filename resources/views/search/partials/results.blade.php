@if($issues->count())
  <div class="mb-4">
    <div class="d-flex align-items-center mb-2">
      <span class="badge bg-primary me-2">ISSUES</span>
      <small class="text-muted">{{ $issues->total() }} found</small>
    </div>
    <div class="list-group">
      @foreach($issues as $issue)
        <a href="{{ route('issues.show', $issue) }}" class="list-group-item list-group-item-action">
          <div class="d-flex justify-content-between">
            <div class="fw-semibold">{{ $issue->title }}</div>
            <span class="badge bg-secondary text-uppercase">{{ $issue->priority }}</span>
          </div>
          <div class="small text-muted">
            In project: {{ optional($issue->project)->name ?? '—' }}
            @if($issue->due_date) · due {{ $issue->due_date->format('Y-m-d') }} @endif
          </div>
          @if($issue->description)
            <div class="small text-truncate">{{ Str::limit(strip_tags($issue->description), 140) }}</div>
          @endif
        </a>
      @endforeach
    </div>

    @if($issues->hasMorePages())
      <div class="mt-2">
        <a class="btn btn-sm btn-light rounded-pill" href="{{ route('issues.index', ['q' => request('q')]) }}">
          View all results
        </a>
      </div>
    @endif
  </div>
@endif

@if(isset($projects) && $projects->count())
  <div class="mb-2">
    <div class="d-flex align-items-center mb-2">
      <span class="badge bg-success me-2">PROJECTS</span>
      <small class="text-muted">{{ $projects->total() }} found</small>
    </div>
    <div class="list-group">
      @foreach($projects as $project)
        <a href="{{ route('projects.show', $project) }}" class="list-group-item list-group-item-action">
          <div class="d-flex justify-content-between">
            <div class="fw-semibold">{{ $project->name }}</div>
            @if($project->issues_count)
              <span class="badge bg-outline-primary">{{ $project->issues_count }} issues</span>
            @endif
          </div>
          @if($project->description)
            <div class="small text-truncate">{{ Str::limit(strip_tags($project->description), 160) }}</div>
          @endif
          @if($project->start_date || $project->deadline)
            <div class="small text-muted">
              @if($project->start_date) starts {{ \Illuminate\Support\Carbon::parse($project->start_date)->toDateString() }} @endif
              @if($project->deadline) · due {{ \Illuminate\Support\Carbon::parse($project->deadline)->toDateString() }} @endif
            </div>
          @endif
        </a>
      @endforeach
    </div>

    @if($projects->hasMorePages())
      <div class="mt-2">
        <a class="btn btn-sm btn-light rounded-pill" href="{{ route('projects.index', ['q' => request('q')]) }}">
          View all projects
        </a>
      </div>
    @endif
  </div>
@endif

@if((!isset($issues) || !$issues->count()) && (!isset($projects) || !$projects->count()))
  <div class="text-center text-muted py-5">
    <i class="ri-search-eye-line d-block mb-2" style="font-size: 2rem;"></i>
    <div>No results found.</div>
  </div>
@endif


@if(isset($tags) && $tags->count())
  <div class="my-2">
    <div class="d-flex align-items-center mb-2">
      <span class="badge bg-warning text-dark me-2">TAGS</span>
      <small class="text-muted">{{ $tags->total() }} found</small>
    </div>

    <div class="d-flex flex-wrap">
      @foreach($tags as $tag)
        <span class="badge rounded-pill me-2 mb-2"
              style="background-color: {{ $tag->color ?? '#6b7280' }}; color: #fff; padding: .45rem .7rem;">
          {{ $tag->name }}
        </span>
      @endforeach
    </div>

    @if($tags->hasMorePages())
      <div class="mt-2">
        <span class="text-muted small">…and more tags</span>
      </div>
    @endif
  </div>
@endif

