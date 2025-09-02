@extends('layout.index')
@section('title', "View All Roles")

@section('authentication_cat', 'open active')
@section('view_roles', 'active')



    @section('styles')
        @include('partials.datatable-styles')
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @include('partials.datatable-scripts')


        <script>
        $('.deleteBtn').on('click', function() {
            console.log('delete button clicked');
            var id = $(this).data('id');
            var url = '/users/' + id;
            $('#deleteForm').attr('action', url);
        });
    </script>



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
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">{{ __('All Roles') }} </div>
                @can('role.add')
                <a class="modal-effect btn btn-primary d-grid mb-3 rounded-pill" data-bs-effect="effect-sign" data-bs-toggle="modal" href="#addRoleModal" >Add Role</a>
                @endcan
                
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




<div class="modal fade effect-sign" id="addRoleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered text-center " role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add a New Role</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('role.add') }}" method="POST">
                @csrf
                <div class="modal-body text-start">
                    <div class="row gy-4">
                        <div class="col-sm-12">
                            <label for="input-placeholder" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="input-placeholder" placeholder="Name..." name='name' required/>
                        </div>
                        <div class="col-sm-12">
                            <label for="input-placeholder2" class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="input-placeholder2" placeholder="Guard Name..." name='guard_name' required value="web" readonly/>
                        </div>
                    </div>

                    <!-- Permissions Table -->
                    <div class="table-responsive mt-4" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th colspan='2' class="text-center">User Permissions ( <input class="form-check-input " type="checkbox" onclick="toggleCheckboxes('user-permission-box', this)" > )</th>
                                </tr>
                                @foreach($usersP as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <input class="form-check-input user-permission-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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
                                            <input class="form-check-input permission-permissions-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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
                                            <input class="form-check-input role-permissions-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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
                                            <input class="form-check-input dashboard-permissions-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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
                                            <input class="form-check-input settings-permissions-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
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
                                            <input class="form-check-input profile-permissions-box" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection