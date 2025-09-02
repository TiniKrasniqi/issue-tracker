@extends('layout.index')
@section('title', "View All Users")

@section('authentication_cat', 'open active')
@section('user_category', 'active open')
@section('view_users', 'active')



    @section('styles')
        @include('partials.datatable-styles')
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @include('partials.datatable-scripts')


        <script>
            $('.deleteBtn').on('click', function() {
                var id = $(this).data('id');
                var url = 'users/' + id;
                $('#deleteForm').attr('action', url);
            });
        </script>
    @endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">{{ __('All Users') }}</div>
            </div>
            <div class="card-body">
                <table id="file-export" class="table table-bordered text-nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Surname') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Status') }}</th>
                            <!-- <th>{{ __('2FA') }}</th> -->
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?: '--Not Set--' }}</td>
                            <td>{{ $user->status == 1 ? 'Enabled' : 'Disabled' }}</td>
                            <!-- <td>{{ $user['2fa_enabled'] == 1 ? 'Enabled' : 'Disabled' }}</td> -->
                            <td>
                                <div class="btn-list">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn-success-transparent rounded-pill btn-wave waves-effect waves-light"> <i class="ri-pencil-fill"></i></a>
                                    <button class="btn btn-icon btn-danger-transparent rounded-pill btn-wave  waves-effect waves-light deleteBtn" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal"> <i class="ri-delete-bin-fill"></i> </button>
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





<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-top text-center"> 
        <div class="modal-content modal-content-demo"> 
            <div class="modal-header"> 
                <h6 class="modal-title" >{{ __('Delete User') }}</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button> 
            </div> 
            <div class="modal-body text-start"> 
                <h6>{{ __('Are you sure to delete the user') }}</h6> 
                <span class="text-danger">This action can't be reverted back!</span><br>
              
            </div> 
            <div class="modal-footer"> 
                <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger rounded-pill" type="submit">{{ __('Delete Now') }}</button> 
                    <button class="btn btn-light rounded-pill" data-bs-dismiss="modal">{{ __('Cancel') }}</button> 
                </form>
            </div> 
        </div> 
    </div>
</div>
@endsection