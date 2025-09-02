@extends('layout.index')

@section('title', 'Edit User Information')

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{ __('Edit User') }}</div>
            </div>
            <div class="card-body">
                <form class="row g-3 mt-0" action="{{ route('users.update', $user->id) }}" method="POST" >
                @csrf
                @method('PUT')
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Name') }}</label> 
                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }} ..." required value='{{ $user->name }}'/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Surname ') }}</label> 
                        <input type="text" class="form-control" name="surname" placeholder="{{ __('Surname') }}..." required value='{{ $user->surname }}'/>
                    </div>
                   
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">{{ __('Email') }}</label> 
                        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="{{ __('Email') }}..." required  value='{{ $user->email }}'/>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">{{ __('Phone') }}</label>
                        <input type="tel" class="form-control" id="inputAddress" name="phone" placeholder="{{ __('Phone') }}..."value='{{ $user->phone }}' />
                    </div>

                   <!-- User Status Select -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">{{ __('User Status') }}</label>
                        <select name="status" id="status" class="form-select form-select-lg">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <input type="hidden" name="two_factor" value="0">
                    <!-- User 2 Factor Authentication Select -->
                    <!-- <div class="col-md-6">
                        <label for="two_factor" class="form-label">{{ __('User 2 Factor Authentication') }}</label>
                        <select name="two_factor" id="two_factor" class="form-select form-select-lg">
                            <option value="1" {{ $user['2fa_enabled'] == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ $user['2fa_enabled'] == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div> -->


                    <div class="col-md-6">
                        <label for="role" class="form-label">{{ __('User Role') }}</label>
                        <select name="role" id="role" class="form-select form-select-lg">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                  
                    
                    <div class="col-12 mt-3"><button type="submit" class="btn btn-primary rounded-pill">{{ __('Save Changes') }}</button></div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection


