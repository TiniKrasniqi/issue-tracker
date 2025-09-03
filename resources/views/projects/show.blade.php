@extends('layout.index')
@section('title', "Project Details")
@section('projects_link', 'active')


@section('styles')
    @include('partials.datatable-styles')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    @include('partials.datatable-scripts')
@endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row g-3">
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    {{ $project->name }}
                </div>
                <div class="btn-list">
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-success rounded-pill">
                        {{ __('Edit Project') }}
                    </a>
                    <a href="{{ route('projects.index') }}" class="btn btn-sm btn-light rounded-pill">
                        {{ __('Back to Projects') }}
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-muted mb-2">{{ __('Description') }}</h6>
                        <p class="mb-0">{{ $project->description ?: '—' }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-muted small">{{ __('Start Date') }}</div>
                                <div>{{ $project->start_date?->format('Y-m-d') ?? '—' }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">{{ __('Deadline') }}</div>
                                <div>{{ $project->deadline?->format('Y-m-d') ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="d-flex align-items-center gap-3">
                    <div class="text-muted">{{ __('Total Issues') }}:</div>
                    <div class="badge bg-primary">{{ $project->issues->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Issues table --}}
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">{{ __('Issues') }}</div>
                <a href="#"
                   class="btn btn-primary rounded-pill">
                    {{ __('New Issue') }}
                </a>
            </div>

            <div class="card-body">
                @if($issues->isEmpty())
                    <div class="text-center text-muted py-5">
                        {{ __('No issues for this project yet.') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table id="file-export" class="table table-bordered text-nowrap" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Priority') }}</th>
                                    <th>{{ __('Due Date') }}</th>
                                    <th>{{ __('Tags') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($issues as $issue)
                                    <tr>
                                        <td>
                                            <a href="#">
                                                {{ $issue->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary text-uppercase">{{ $issue->status }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-outline-primary text-uppercase">{{ $issue->priority }}</span>
                                        </td>
                                        <td>{{ $issue->due_date?->format('Y-m-d') ?? '—' }}</td>
                                        <td>
                                            @forelse($issue->tags as $tag)
                                                <span class="badge"
                                                      style="background-color: {{ $tag->color ?? '#e5e7eb' }};">
                                                    {{ $tag->name }}
                                                </span>
                                            @empty
                                                <span class="text-muted">—</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <a href=""
                                                   class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href=""
                                                   class="btn btn-icon btn-success-transparent rounded-pill btn-wave">
                                                    <i class="ri-pencil-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
