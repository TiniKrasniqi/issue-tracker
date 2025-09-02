@extends('layout.index')

@section('title', 'User Profile Information')
@section('scripts')
        <!-- Internal Sing-Up JS -->
    <script src="js/authentication.js"></script>
        <!-- Show Password JS -->
    <script src="js/show-password.js"></script>
@endsection
@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="d-sm-flex align-items-top p-4 border-bottom border-block-end-dashed main-profile-cover">
                            <div>
                                <span class="avatar avatar-xxl avatar-rounded online me-3"> <img src="images/faces/9.jpg" alt="" /> </span>
                            </div>
                            <div class="flex-fill main-profile-info">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="fw-semibold mb-1 text-fixed-white">{{ $user->name}} {{ $user->surname}}</h6>
                                    
                                </div>
                                <p class="mb-1 text-muted text-fixed-white op-7">{{ $userrole}}</p>
                                <p class="fs-12 text-fixed-white mb-4 op-5">
                                    <span class="me-3"><i class="ri-building-line me-1 align-middle"></i>{{ $user->country ?: 'No Contry added'}}</span> <span><i class="ri-map-pin-line me-1 align-middle"></i>{{ $user->city ?: 'No City added'}}</span>
                                </p>
                            </div>
                          
                        </div>
                        <div class="p-4 border-bottom border-block-end-dashed">
                            <p class="fs-15 mb-2 me-4 fw-semibold">Contact Information :</p>
                            <div class="text-muted">
                                <p class="mb-2">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted"> <i class="ri-mail-line align-middle fs-14"></i> </span> {{ $user->email}} 
                                </p>
                                <p class="mb-2">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted"> <i class="ri-phone-line align-middle fs-14"></i> </span> {{ $user->phone ?: 'No Phone Number'}} 
                                </p>
                                <p class="mb-0">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted"> <i class="ri-map-pin-line align-middle fs-14"></i> </span> {{ $user->country ?: 'No Contry added'}}, {{ $user->city ?: 'No City added'}}
                                    
                                </p>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">{{ __('Change Password') }}</div>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 mt-0" action="{{ route('auth.update-pass') }}" method="POST" >
                        @csrf
                            <div class="col-12">
                                <label class="form-label">{{ __('Current Password') }}</label> 
                                <input type="password" class="form-control" name="current_password" placeholder="{{ __('Current Password') }} ..." required />
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('New Password') }}</label> 
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="{{ __('New Password') }} ..." required />
                                    <button class="btn btn-light" onclick="createpassword('new_password',this)" type="button" id="button-addon22"><i class="ri-eye-off-line align-middle"></i></button>
                                </div>
                               
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('Confirm Password') }}</label> 
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password_confirmation" id="new_passwordconfirm"placeholder="{{ __('Password Confirmation') }} ..." required />
                                    <button class="btn btn-light" onclick="createpassword('new_passwordconfirm',this)" type="button" id="button-addon22"><i class="ri-eye-off-line align-middle"></i></button>
                                </div>
                            </div>

                            <div class="col-12"><button type="submit" class="btn btn-primary rounded-pill">{{ __('Change Password') }}</button></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
       
    </div>


    <div class="col-md-8 col-sm-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{ __('Edit Profile Information') }}</div>
                <a href="{{route('user.account')}}" target="_blank" class="btn btn-primary rounded-pill">Manage Accounts <i class="ri-user-settings-line align-middle fs-14"></i></a>
            </div>
            <div class="card-body">
                <form class="row g-3 mt-0" action="{{ route('profile.update', $user->id) }}" method="POST" >
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
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">{{ __('Country') }}</label>
                        <input type="text" class="form-control" id="inputAddress" name="country" placeholder="{{ __('Country') }}..."value='{{ $user->country }}' />
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">{{ __('City') }}</label>
                        <input type="text" class="form-control" id="inputAddress" name="city" placeholder="{{ __('City') }}..."value='{{ $user->city }}' />
                    </div>

                    <!-- User 2 Factor Authentication Select -->
                    <!-- <div class="col-md-12">
                        <label for="two_factor" class="form-label">{{ __('2-Factor Authentication') }}</label>
                        <select name="two_factor" id="two_factor" class="form-select form-select-lg">
                            <option value="1" {{ $user['2fa_enabled'] == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ $user['2fa_enabled'] == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div> -->
                    <input type="hidden" name="two_factor" value="0">


                  
                    
                    <div class="col-12"><button type="submit" class="btn btn-primary rounded-pill">{{ __('Save Changes') }}</button></div>
                </form>

            </div>
        </div>
       
    </div>

  
</div>

@endsection

