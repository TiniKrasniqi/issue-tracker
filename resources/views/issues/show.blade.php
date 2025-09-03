@extends('layout.index')
@section('title', "Issue Details")

@section('issues_link', 'active')

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row g-3">

  <div class="col-12">
    <div class="card custom-card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          {{ $issue->title }}
        </div>
        <div class="btn-list">
          <a href="{{ route('issues.edit', $issue) }}" class="btn  btn-outline-secondary rounded-pill">{{ __('Edit') }}</a>
          <a href="{{ route('issues.index') }}" class="btn  btn-outline-light rounded-pill">{{ __('Back to Issues') }}</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-8">
            <div class="text-muted small mb-1">{{ __('Project') }}</div>
            <div>
              @if($issue->project)
                <a href="{{ route('projects.show', $issue->project) }}">{{ $issue->project->name }}</a>
              @else
                —
              @endif
            </div>

            <div class="text-muted small mt-3 mb-1">{{ __('Description') }}</div>
            <p class="mb-0">{{ $issue->description ?: '—' }}</p>
          </div>

          <div class="col-md-4">
            <div class="row g-3">
              <div class="col-6">
                <div class="text-muted small">{{ __('Status') }}</div>
                <div class="badge bg-secondary text-uppercase">{{ $issue->status }}</div>
              </div>
              <div class="col-6">
                <div class="text-muted small">{{ __('Priority') }}</div>
                <div class="badge bg-outline-primary text-uppercase">{{ $issue->priority }}</div>
              </div>
              <div class="col-6">
                <div class="text-muted small">{{ __('Due Date') }}</div>
                <div>{{ $issue->due_date?->format('Y-m-d') ?? '—' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card custom-card">
      <div class="card-header">
        <div class="card-title mb-0">{{ __('Tags') }}</div>
      </div>
      <div class="card-body">
        @forelse($issue->tags as $tag)
          <span class="badge me-1 mb-1" style="background-color: {{ $tag->color ?? '#e5e7eb' }};">
            {{ $tag->name }}
          </span>
        @empty
          <span class="text-muted">—</span>
        @endforelse
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card custom-card">
      <div class="card-header">
        <div class="card-title mb-0">{{ __('Comments') }}</div>
      </div>
      <div class="card-body">
        <div class="text-muted">
          {{ __('Comments will appear here. (AJAX load & add to be implemented)') }}
        </div>
      </div>
    </div>
  </div>

</div>
@endsection