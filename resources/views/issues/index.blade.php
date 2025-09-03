@extends('layout.index')
@section('title', "Issues")
@section('issues_link', 'active')

@section('styles')
    @include('partials.datatable-styles')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    @include('partials.datatable-scripts')

    <script>
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            $('#deleteForm').attr('action', '{{ url('issues') }}/' + id);
        });
    </script>
@endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">{{ __('Issues') }}</div>
                <a href="{{ route('issues.create') }}" class="btn btn-primary rounded-pill">
                    <i class="bx bx-plus"></i> {{ __('New Issue') }}
                </a>
            </div>

            <div class="card-body">
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Status') }}</label>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('All') }}</option>
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(request('status')===$value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Priority') }}</label>
                        <select name="priority" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('All') }}</option>
                            @foreach($priorities as $value => $label)
                                <option value="{{ $value }}" @selected(request('priority')===$value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Tag') }}</label>
                        <select name="tag" class="form-select" onchange="this.form.submit()">
                            <option value="">{{ __('All') }}</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @selected((string)request('tag')===(string)$tag->id)>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <a href="{{ route('issues.index') }}" class="btn btn-light rounded-pill w-100">{{ __('Reset') }}</a>
                    </div>
                </form>

                {{-- Table --}}
                <div class="table-responsive">
                    <table id="file-export" class="table table-bordered text-nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Project') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Priority') }}</th>
                                <th>{{ __('Due Date') }}</th>
                                <th>{{ __('Tags') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($issues as $issue)
                                <tr>
                                    <td>
                                        <a href="{{ route('issues.show', $issue) }}">{{ $issue->title }}</a>
                                    </td>
                                    <td>
                                        @if($issue->project)
                                            <a href="{{ route('projects.show', $issue->project) }}">{{ $issue->project->name }}</a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                   @php
                                        $statusColors = [
                                            'open'        => 'bg-light text-dark',
                                            'in_progress' => 'bg-warning text-dark',
                                            'closed'      => 'bg-success',
                                        ];
                                        @endphp
                                        <td>
                                            <span class="badge {{ $statusColors[$issue->status] ?? 'bg-secondary' }} text-uppercase">
                                                {{ $issue->status }}
                                            </span>
                                        </td>

                                        
                                        @php
                                        $priorityColors = [
                                            'low'    => 'bg-outline-success',
                                            'medium' => 'bg-outline-warning',
                                            'high'   => 'bg-outline-danger ',
                                        ];
                                        @endphp
                                        <td>
                                            <span class="badge {{ $priorityColors[$issue->priority] ?? 'bg-outline-primary' }} text-uppercase">
                                                {{ $issue->priority }}
                                            </span>
                                        </td>
                                    <td>{{ $issue->due_date?->format('Y-m-d') ?? '—' }}</td>
                                    <td>
                                        @forelse($issue->tags as $tag)
                                            <span class="badge" style="background-color: {{ $tag->color ?? '#e5e7eb' }}">{{ $tag->name }}</span>
                                        @empty
                                            <span class="text-muted">—</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('issues.show', $issue) }}"
                                               class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('issues.edit', $issue) }}"
                                               class="btn btn-icon btn-success-transparent rounded-pill btn-wave">
                                                <i class="ri-pencil-fill"></i>
                                            </a>
                                            <button class="btn btn-icon btn-danger-transparent rounded-pill btn-wave deleteBtn"
                                                    data-id="{{ $issue->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="ri-delete-bin-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">{{ __('No issues found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-top text-center">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Delete Issue') }}</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <h6>{{ __('Are you sure you want to delete this issue?') }}</h6>
                <span class="text-danger">{{ __("This action can't be reverted back!") }}</span>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger rounded-pill" type="submit">{{ __('Delete Now') }}</button>
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
