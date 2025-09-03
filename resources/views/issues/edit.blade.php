@extends('layout.index')
@section('title', "Edit Issue")
@section('issues_link', 'active')


@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<div class="row">
  <div class="col-xl-12">
    <div class="card custom-card">
      <div class="card-header">
        <div class="card-title">{{ __('Edit Issue') }}</div>
      </div>
      <div class="card-body">
        @include('issues._form', ['issue' => $issue])
      </div>
    </div>
  </div>
</div>
@endsection
