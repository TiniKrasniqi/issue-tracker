@php
  $issue = $issue ?? null;
@endphp

<form method="POST" action="{{ $issue ? route('issues.update', $issue) : route('issues.store') }}">
  @csrf
  @if($issue) @method('PUT') @endif

  <div class="mb-3">
    <label class="form-label">{{ __('Project') }}</label>
    <select name="project_id" class="form-select" required>
      <option value="">{{ __('Select project') }}</option>
      @foreach($projects as $project)
        <option value="{{ $project->id }}"
          @selected(old('project_id', $issue->project_id ?? $prefillProjectId ?? '') == $project->id)>
          {{ $project->name }}
        </option>
      @endforeach
    </select>
    @error('project_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">{{ __('Title') }}</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $issue->title ?? '') }}" required>
    @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">{{ __('Description') }}</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $issue->description ?? '') }}</textarea>
    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">{{ __('Status') }}</label>
      <select name="status" class="form-select" required>
        @foreach($statuses as $value => $label)
          <option value="{{ $value }}" @selected(old('status', $issue->status ?? 'open') == $value)>{{ $label }}</option>
        @endforeach
      </select>
      @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
      <label class="form-label">{{ __('Priority') }}</label>
      <select name="priority" class="form-select" required>
        @foreach($priorities as $value => $label)
          <option value="{{ $value }}" @selected(old('priority', $issue->priority ?? 'medium') == $value)>{{ $label }}</option>
        @endforeach
      </select>
      @error('priority') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
      <label class="form-label">{{ __('Due Date') }}</label>
      <input type="date" name="due_date" class="form-control"
             value="{{ old('due_date', optional($issue->due_date ?? null)->format('Y-m-d')) }}">
      @error('due_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
  </div>

  <div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary rounded-pill">{{ $issue ? __('Update') : __('Create') }}</button>
    <a href="{{ route('issues.index') }}" class="btn btn-light rounded-pill">{{ __('Cancel') }}</a>
  </div>
</form>
