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

    const routes = {
      commentsIndex: "{{ route('issues.comments.index', $issue) }}",
      commentsStore: "{{ route('issues.comments.store', $issue) }}",
    };

    async function loadComments(url) {
      const res = await fetch(url || routes.commentsIndex);
      if (!res.ok) return;
      const data = await res.json(); // { html, next_page_url }
      const list = document.getElementById('comments-list');
      list.insertAdjacentHTML(url ? 'beforeend' : 'afterbegin', data.html);

      const moreBtn = document.getElementById('load-more');
      if (data.next_page_url) {
        moreBtn.classList.remove('d-none');
        moreBtn.dataset.url = data.next_page_url;
      } else {
        moreBtn.classList.add('d-none');
        moreBtn.dataset.url = '';
      }
    }

    document.addEventListener('DOMContentLoaded', () => loadComments());
    document.getElementById('load-more').addEventListener('click', (e) => loadComments(e.currentTarget.dataset.url));

    document.getElementById('comment-modal-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.currentTarget;
      const fd = new FormData(form);

      const res = await fetch(routes.commentsStore, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value },
        body: fd
      });

      if (res.status === 201) {
        const html = await res.text();
        document.getElementById('comments-list').insertAdjacentHTML('afterbegin', html);
        form.reset();
        // keep the user's name prefilled after reset
        const author = form.querySelector('input[name="author_name"]');
        if (author && "{{ auth()->user()->name ?? '' }}") author.value = "{{ auth()->user()->name ?? '' }}";

        const modal = bootstrap.Modal.getInstance(document.getElementById('addCommentModal'));
        modal.hide();

        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon: 'success', title: 'Added', text: 'Comment added.', timer: 1500, showConfirmButton: false });
        }
      } else if (res.status === 422) {
        const payload = await res.json();
        const errors = Object.values(payload.errors).flat().join('\n');
        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon: 'error', title: 'Validation error', text: errors });
        }
      } else {
        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to add comment.' });
        }
      }
    });





    let assigneesChoices;
    document.addEventListener('DOMContentLoaded', () => {
      const el = document.getElementById('assignees-multiselect');
      if (el && window.Choices) {
        assigneesChoices = new Choices(el, { removeItemButton: true, shouldSort: false, searchEnabled: true });
      }
    });

    document.getElementById('sync-assignees-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.currentTarget;
      const token = form.querySelector('input[name=_token]').value;
      const url = "{{ route('issues.assignees.sync', $issue) }}";

      const values = (window.Choices && assigneesChoices)
        ? assigneesChoices.getValue(true)
        : Array.from(document.getElementById('assignees-multiselect').selectedOptions).map(o => o.value);

      const fd = new FormData();
      values.forEach(v => fd.append('user_ids[]', v));

      const res = await fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': token }, body: fd });

      if (res.ok) {
        const html = await res.text();
        document.getElementById('issue-assignees').innerHTML = html;
        bootstrap.Modal.getInstance(document.getElementById('manageAssigneesModal')).hide();

        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon: 'success', title: 'Saved', text: 'Assignees updated.', timer: 1500, showConfirmButton: false });
        }
      } else if (res.status === 422) {
        const payload = await res.json();
        const errors = Object.values(payload.errors).flat().join('\n');
        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon:'error', title:'Validation error', text: errors });
        }
      } else {
        if (typeof Swal !== 'undefined') {
          Swal.fire({ icon:'error', title:'Error', text:'Failed to update assignees.' });
        }
      }
    });
  </script>
@endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row align-items-stretch flex-grow-1 min-vh-75"style="min-height: calc(100vh - 120px);" >
  <div class="col-lg-9 d-flex flex-column">
    <div class="card custom-card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">{{ $issue->title }}</div>
        <div class="btn-list">
          <a href="{{ route('issues.edit', $issue) }}" class="btn btn-outline-secondary rounded-pill">{{ __('Edit') }}</a>
          <a href="{{ route('issues.index') }}" class="btn btn-outline-light rounded-pill">{{ __('Back') }}</a>
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

    <div class="card custom-card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">{{ __('Comments') }}</div>
        <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#addCommentModal">
          {{ __('Add Comment') }}
        </button>
      </div>
      <div class="card-body">
        <div id="comments-list"></div>
        <div class="d-grid mt-3">
          <button id="load-more" class="btn btn-light rounded-pill d-none">{{ __('Load more') }}</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 d-flex">
    <div class="card custom-card h-auto w-100 d-flex flex-column">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">{{ __('Tags') }}</div>
        <button class="btn btn-primary  rounded-pill" data-bs-toggle="modal" data-bs-target="#manageTagsModal">
          {{ __('Manage') }}
        </button>
      </div>
      <div class="card-body flex-grow-1 overflow-auto">
        <div id="issue-tags">
          @include('issues.partials.tag_pills', ['issue' => $issue])
        </div>

        <hr class="mt-5">
        

         <div class="my-2 mt-3 d-flex justify-content-between">
          <h6 class="mb-2">{{ __('Assignees') }}</h6>
          <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#manageAssigneesModal">
            {{ __('Manage Assignees') }}
          </button>
        </div>
        <div id="issue-assignees" class="mt-3">
          @include('issues.partials.assignee_pills', ['issue' => $issue])
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

<div class="modal fade" id="addCommentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <form id="comment-modal-form" class="modal-content">
      @csrf
      <div class="modal-header">
        <h6 class="modal-title">{{ __('Add Comment') }}</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">{{ __('Your Name') }}</label>
          <input type="text" name="author_name" class="form-control"
                 value="{{ auth()->user()->name ?? '' }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">{{ __('Comment') }}</label>
          <textarea name="body" class="form-control" rows="3" placeholder="{{ __('Write a comment…') }}" required></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-light rounded-pill" type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        <button class="btn btn-primary rounded-pill" type="submit">{{ __('Add') }}</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="manageAssigneesModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <form id="sync-assignees-form" class="modal-content">
      @csrf
      <div class="modal-header">
        <h6 class="modal-title">{{ __('Manage Assignees') }}</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label class="form-label">{{ __('Select users') }}</label>
        <select id="assignees-multiselect" name="user_ids[]" multiple class="form-control">
          @foreach(\App\Models\User::orderBy('name')->get(['id','name','surname']) as $user)
            <option value="{{ $user->id }}" @selected($issue->users->contains('id', $user->id))>
              {{ $user->name }} {{ $user->surname }}
            </option>
          @endforeach
        </select>
        <small class="text-muted d-block mt-2">
          {{ __('Pick one or more users. Leaving none selected will remove all assignees.') }}
        </small>
      </div>

      <div class="modal-footer">
        <button class="btn btn-light rounded-pill" type="button" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        <button class="btn btn-primary rounded-pill" type="submit">{{ __('Save') }}</button>
      </div>
    </form>
  </div>
</div>


@endsection