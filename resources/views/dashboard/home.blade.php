@extends('layout.index')
@section('title', "Dashboard Page")

@section('dashboard_link', 'active')

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])
@can('user.view-all')
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
@endcan



@can('role.view-all')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">{{ __('All Roles') }} </div>
            
                
            </div>
            <div class="card-body">
                <table id="file-export" class="table table-bordered text-nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Guard Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                           
                            <td>
                                <div class="btn-list">
                                    <a href="{{route('roles.edit', $role->id)}}" target="_blank"class="btn btn-icon btn-success-transparent rounded-pill btn-wave waves-effect waves-light"> <i class="ri-pencil-fill"></i></a>
                                    <!-- <button class="btn btn-icon btn-danger-transparent rounded-pill btn-wave  waves-effect waves-light deleteBtn" data-id="" data-bs-toggle="modal" data-bs-target="#deleteModal"> <i class="ri-delete-bin-fill"></i> </button> -->
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
@endcan

@endsection