@extends('layout.index')
@section('title', "Projects")
@section('projects_link', 'active ')
@section('styles')
    @include('partials.datatable-styles')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    @include('partials.datatable-scripts')

    <script>
        // Delete modal: inject form action
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            $('#deleteForm').attr('action', '{{ url('projects') }}/' + id);
        });
    </script>
@endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title">{{ __('Projects') }}</div>
                <a href="{{ route('projects.create') }}" class="btn btn-primary rounded-pill">
                    <i class="bx bx-plus"></i>{{ __('New Project') }} 
                </a>
            </div>

            <div class="card-body">
                {{-- @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif --}}

                <table id="file-export" class="table table-bordered text-nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Issues') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('Deadline') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>
                                    <a href="{{ route('projects.show', $project) }}">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($project->description, 80) }}</td>
                                <td>{{ $project->issues_count }}</td>
                                <td>{{ $project->start_date?->format('Y-m-d') ?? '--' }}</td>
                                <td>{{ $project->deadline?->format('Y-m-d') ?? '--' }}</td>
                                <td>
                                    <div class="btn-list">
                                        <a href="{{ route('projects.show', $project) }}"
                                           class="btn btn-icon btn-info-transparent rounded-pill btn-wave">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        @can('update', $project)
                                        <a href="{{ route('projects.edit', $project) }}"
                                           class="btn btn-icon btn-success-transparent rounded-pill btn-wave">
                                            <i class="ri-pencil-fill"></i>
                                        </a>
                                        @endcan
                                        @can('delete', $project)
                                        <button class="btn btn-icon btn-danger-transparent rounded-pill btn-wave deleteBtn"
                                                data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="ri-delete-bin-fill"></i>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-top text-center">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('Delete Project') }}</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-start">
                <h6>{{ __('Are you sure you want to delete this project?') }}</h6>
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