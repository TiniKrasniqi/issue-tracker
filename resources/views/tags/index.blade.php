@extends('layout.index')
@section('title', "Tags")

@section('tags_link', 'active')

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
            <div class="card-header">
                <div class="card-title mb-0">{{ __('Create Tag') }}</div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tags.store') }}" class="row g-3">
                    @csrf
                    <div class="col-md-9">
                        <label class="form-label">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">{{ __('Color') }}</label>
                        <input type="color" name="color" class="form-control form-control-color w-100 h-50 rounded-pill" value="{{ old('color') }}">
                        @error('color') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary rounded-pill w-100">{{ __('Add Tag') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title mb-0">{{ __('All Tags') }}</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-export" class="table table-bordered text-nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Color') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        @if($tag->color)
                                            <span class="badge" style="background-color: {{ $tag->color }};">{{ $tag->color }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-4">{{ __('No tags yet.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
