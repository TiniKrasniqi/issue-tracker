@extends('layout.index')
@section('title', "Issue Details")

@section('issues_link', 'active')
@section('styles')
 <link rel="stylesheet" href="libs/choices.js/public/assets/styles/choices.min.css">
@endsection
@section('scripts')
 <script src="libs/choices.js/public/assets/scripts/choices.min.js"></script>
 <script>
    // Init Choices
    let tagsChoices;
    document.addEventListener('DOMContentLoaded', () => {
      const el = document.getElementById('tags-multiselect');
      if (el) {
        tagsChoices = new Choices(el, {
          removeItemButton: true,
          searchEnabled: true,
          placeholderValue: "{{ __('Select tags') }}",
          shouldSort: false,
        });
      }
    });

    document.getElementById('sync-tags-form').addEventListener('submit', async (e) => {
      e.preventDefault();

      const form = e.currentTarget;
      const token = form.querySelector('input[name=_token]').value;
      const url = "{{ route('issues.tags.sync', $issue) }}";

      const values = tagsChoices.getValue(true); 
      const fd = new FormData();
      values.forEach(v => fd.append('tag_ids[]', v));

      const res = await fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': token }, body: fd });

      if (res.ok) {
          const html = await res.text();
          document.getElementById('issue-tags').innerHTML = html;
          bootstrap.Modal.getInstance(document.getElementById('manageTagsModal')).hide();

          // Success feedback
          if (typeof Swal !== 'undefined') {
              Swal.fire({
                  icon: 'success',
                  title: 'Saved',
                  text: 'Tags updated successfully.',
                  timer: 2000,
                  showConfirmButton: false
              });
          }
      } else if (res.status === 422) {
          const errors = await res.json();
          if (typeof Swal !== 'undefined') {
              Swal.fire({
                  icon: 'error',
                  title: 'Validation error',
                  text: Object.values(errors.errors).flat().join('\n'),
              });
          }
      } else {
          if (typeof Swal !== 'undefined') {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Failed to update tags. Please try again.',
              });
          }
      }

    });
  </script>
@endsection

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
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">{{ __('Tags') }}</div>
        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#manageTagsModal">
          {{ __('Edit') }}
        </button>
      </div>
      <div class="card-body">
        <div id="issue-tags">
          @include('issues.partials.tag_pills', ['issue' => $issue])
        </div>
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




<div class="modal fade" id="manageTagsModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <form id="sync-tags-form" class="modal-content">
      @csrf
      <div class="modal-header">
        <h6 class="modal-title">{{ __('Manage Tags') }}</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <label class="form-label">{{ __('Select tags') }}</label>
        <select id="tags-multiselect" name="tag_ids[]" multiple class="form-control">
          @foreach(\App\Models\Tag::orderBy('name')->get(['id','name','color']) as $tag)
            <option value="{{ $tag->id }}" @selected($issue->tags->contains('id', $tag->id))>
              {{ $tag->name }}
            </option>
          @endforeach
        </select>
        <small class="text-muted d-block mt-2">
          {{ __('Pick one or more tags. Removing all will clear tags.') }}
        </small>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary rounded-pill" type="submit">{{ __('Save') }}</button>
        <button class="btn btn-light rounded-pill" type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
      </div>
    </form>
  </div>
</div>
@endsection