@php($project = $project ?? null)

<form method="POST" action="{{ $project ? route('projects.update', $project) : route('projects.store') }}">
    @csrf
    @if($project) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">{{ __('Name') }}</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $project->name ?? '') }}" required>
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Description') }}</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">{{ __('Start Date') }}</label>
            <input type="date" name="start_date" class="form-control"
                   value="{{ old('start_date', optional($project->start_date ?? null)->format('Y-m-d')) }}">
            @error('start_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('Deadline') }}</label>
            <input type="date" name="deadline" class="form-control"
                   value="{{ old('deadline', optional($project->deadline ?? null)->format('Y-m-d')) }}">
            @error('deadline') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-primary rounded-pill">{{ $project ? __('Update') : __('Create') }}</button>
        <a href="{{ route('projects.index') }}" class="btn btn-light rounded-pill">{{ __('Cancel') }}</a>
    </div>
</form>
