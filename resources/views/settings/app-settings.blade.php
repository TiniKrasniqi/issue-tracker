@extends('layout.index')
@section('title', "Application Settings")
@section('settings_cat', 'active open')
@section('app_settings', 'active')


@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<form class="row g-3 mt-0" action="{{route('settings.app-update')}}" method="POST" enctype="multipart/form-data">            
@csrf
@method("PUT")
    <div class="row">
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Logo Light') }}</div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-3" style="height:100px">
                        <img src="{{ asset('storage/' . $logo_light_image) }}" alt="">
                    </div>
                    <input type="file" class="form-control" name="logo_light_image" placeholder="{{ __('Logo for light mode') }} ..."  />
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Logo Dark') }}</div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-3" style="height:100px">
                        <img src="{{ asset('storage/' . $logo_dark_image) }}" alt="">
                    </div>
                    <input type="file" class="form-control" name="logo_dark_image" placeholder="{{ __('Logo for dark mode') }} ..."  />
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Logo Icon Light') }}</div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-3" style="height:100px">
                        <img src="{{ asset('storage/' . $logo_light_icon) }}" alt="">
                    </div>
                    <input type="file" class="form-control" name="logo_light_icon" placeholder="{{ __('Logo icon for light mode') }} ..."  />
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Logo Icon Dark') }}</div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-3" style="height:100px">
                        <img src="{{ asset('storage/' . $logo_dark_icon) }}" alt="">
                    </div>
                    <input type="file" class="form-control" name="logo_dark_icon" placeholder="{{ __('Logo icon for dark mode') }} ..."  />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Other Application Settings') }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Footer Link Name') }}</label> 
                            <input type="text" class="form-control" name="footer_link_name" placeholder="{{ __('ex: Dekodeapp') }} ..." required value='{{$footer_link_name}}'/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Footer Link Url') }}</label> 
                            <input type="text" class="form-control" name="footer_link_url" placeholder="{{ __('ex: https://dekodeapp.com') }} ..." required value='{{$footer_link_url}}'/>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="form-label">{{ __('Simple Footer Text') }}</label> 
                            <input type="text" class="form-control" name="footer_link_text" placeholder="{{ __('ex: All rights reserved') }}" required value='{{$footer_link_text}}'/>
                        </div>
                    </div>
                    <div class="col-12 my-3 "><button type="submit" class="btn btn-primary rounded-pill">{{ __('Save Changes') }}</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


