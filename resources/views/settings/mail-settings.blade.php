@extends('layout.index')
@section('title', "Application Settings")
@section('settings_cat', 'active open')
@section('mail_settings', 'active')


@section('scripts')
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const mailerSelect = document.getElementById('mailer');
    const smtpFields = document.querySelectorAll('.smtp-field');

    function updateSmtpFields() {
        const isSmtp = mailerSelect.value === 'smtp';
        smtpFields.forEach(field => {
            field.disabled = !isSmtp;
        });
    }

    // Initialize on load
    updateSmtpFields();

    // Update on change
    mailerSelect.addEventListener('change', function () {
        updateSmtpFields();
    });
});

</script>

@endsection

@section('content')
@include('partials.breadcrumb', ['name1' => $name1, 'name2'=> $name2, 'name3'=> $name3])

<form class="row g-3 mt-0" action="{{route('settings.mail-update')}}" method="POST" enctype="multipart/form-data">            
@csrf
@method("PUT")
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">{{ __('Mail Settings') }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="mailer" class="form-label">{{ __('Mail Mailer') }}</label>
                            <select name="mail_mailer" id="mailer" class="form-select form-select-lg">
                                <option value="mail" {{ (env('MAIL_MAILER') == 'mail') ? 'selected' : '' }}>Mail</option>
                                <option value="smtp" {{ (env('MAIL_MAILER') == 'smtp') ? 'selected' : '' }}>SMTP</option>
                            </select>

                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Mail From Address') }}</label> 
                            <input type="text" class="form-control" name="mail_from_address" placeholder="{{ __('ex: ') }}" required value="{{ env('MAIL_FROM_ADDRESS')}}"/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Mail Host') }}</label> 
                            <input type="text" class="form-control smtp-field" name="mail_host" placeholder="{{ __('ex: ') }} ..." required value="{{ env('MAIL_HOST')}}"/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Mail Port') }}</label> 
                            <input type="text" class="form-control smtp-field" name="mail_port" placeholder="{{ __('ex: ') }} ..." required value="{{ env('MAIL_PORT')}}"/>
                        </div>
                       
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Mail Username') }}</label> 
                            <input type="text" class="form-control smtp-field" name="mail_username" placeholder="{{ __('ex: ') }}" required value="{{ env('MAIL_USERNAME')}}"/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">{{ __('Mail Password') }}</label> 
                            <input type="text" class="form-control smtp-field" name="mail_password" placeholder="{{ __('ex: ') }}" required value="{{ env('MAIL_PASSWORD')}}"/>
                        </div>
                    </div>
                    <div class="col-12 my-3 "><button type="submit" class="btn btn-primary rounded-pill">{{ __('Save Changes') }}</button></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


