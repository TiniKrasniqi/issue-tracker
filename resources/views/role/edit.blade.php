@extends('layout.index')

@section('title', 'Edit Role Information')
@section('scripts')
<script>
        // This function is called when the checkbox with a specific class is clicked
        function toggleCheckboxes(className, source) {
            // Get all checkboxes with the specified class name
            const checkboxes = document.querySelectorAll(`input[type="checkbox"].${className}`);

            // Iterate through the NodeList and set each checkbox's 'checked' property
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
    </script>
@endsection
@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{ __('Edit Role') }}</div>
            </div>
            <div class="card-body">
                <form class="row g-3 mt-0" action="{{ route('roles.update', $role->id) }}" method="POST" >
                @csrf
                @method('PUT')
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Name') }}</label> 
                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }} ..." required value='{{ $role->name }}'/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Guard Name ') }}</label> 
                        <input type="text" class="form-control" name="surname" placeholder="{{ __('Guard Name') }}..." required value='{{ $role->guard_name }}'/>
                    </div>

                    <div class="table-responsive mt-4" style="max-height: 450px; overflow-y: auto;">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th colspan='2' class="text-center">User Permissions ( <input class="form-check-input " type="checkbox" onclick="toggleCheckboxes('user-permission-box', this)" > )</th>
                                </tr>
                                @foreach($usersP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach

                           

                                <tr>
                                    <th colspan='2' class="text-center">Permission Permissions ( <input class="form-check-input" type="checkbox" onclick="toggleCheckboxes('permission-permissions-box', this)" > )</th>
                                </tr>

                               
                                @foreach($permissionP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach



                                <tr>
                                    <th colspan='2' class="text-center">Role Permissions ( <input class="form-check-input" type="checkbox" onclick="toggleCheckboxes('role-permissions-box', this)" > )</th>
                                </tr>

                               
                                @foreach($roleP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach



                                
                                <tr>
                                    <th colspan='2' class="text-center">Dashboard Permissions ( <input class="form-check-input" type="checkbox" onclick="toggleCheckboxes('dashboard-permissions-box', this)" > )</th>
                                </tr>

                               
                                @foreach($dashboardP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach


                                <tr>
                                    <th colspan='2' class="text-center">Settings Permissions ( <input class="form-check-input" type="checkbox" onclick="toggleCheckboxes('settings-permissions-box', this)" > )</th>
                                </tr>

                               
                                @foreach($settingsP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach



                                <tr>
                                    <th colspan='2' class="text-center">Profile Permissions ( <input class="form-check-input" type="checkbox" onclick="toggleCheckboxes('profile-permissions-box', this)" > )</th>
                                </tr>

                               
                                @foreach($profileP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ $rolePermissions->contains('name', $permission->name) ? "checked" : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-12 mt-3"><button type="submit" class="btn btn-primary rounded-pill">{{ __('Save Changes') }}</button></div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection


