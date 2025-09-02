<!DOCTYPE html>
<html lang="en" data-theme-mode="dark" >
   
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Forgot Password</title>
    
        <script src="{{asset('js/authentication-main.js')}}"></script>
        <!-- Bootstrap Css -->
        <link id="style" href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Style Css -->
        <link href="{{asset('css/styles.min.css')}}" rel="stylesheet" />
        <!-- Icons Css -->
        <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('libs/swiper/swiper-bundle.min.css')}}" />
        <link rel="stylesheet" href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" />
  
    </head>
   <body class="bg-white">
        <div class="row authentication mx-0">
            <div class="col-xxl-12 col-xl-12 col-lg-12 d-xl-block  px-0">
                <div class="authentication-cover py-5">
                    <div class="aunthentication-cover-content rounded h-auto w-auto">
                        <div class="row justify-content-center align-items-center ">
                            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                                <form action="{{ route('password.update')}}" method="POST">
                                    @csrf
                                    <div class="p-5">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div>
                                                <img src="{{asset('storage/'. $settings['logo_light_image'])}}" alt="" class="authentication-brand desktop-logo h-auto" />
                                                <img src="{{asset('storage/'. $settings['logo_dark_image'])}}" alt="" class="authentication-brand desktop-dark h-auto" />
                                            </div>
                                        </div>
                                        <p class="h5 fw-semibold mb-2 text-center">Password Reset.</p>
                                        <p class="mb-3 text-muted op-7 fw-normal text-center">Create your new password!</p>
                                    
                                        <div class="row gy-3">

                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="email" value="{{ $email }}">

                                            <div class="col-xl-12">
                                                <label for="reset-newpassword" class="form-label text-default">New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control form-control-lg" id="reset-newpassword" placeholder="new password" name="password"/>
                                                    <button class="btn btn-light" onclick="createpassword('reset-newpassword',this)" type="button" id="button-addon21"><i class="ri-eye-off-line align-middle"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 mb-3">
                                                <label for="reset-confirmpassword" class="form-label text-default">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control form-control-lg" id="reset-confirmpassword" placeholder="confirm password" name="password_confirmation"/>
                                                    <button class="btn btn-light" onclick="createpassword('reset-confirmpassword',this)" type="button" id="button-addon22"><i class="ri-eye-off-line align-middle"></i></button>
                                                </div>
                                            
                                            </div>
                                            <div class="col-xl-12 d-grid mt-2"><button type="submit" class="btn btn-lg btn-primary rounded-pill">Reset Now</button></div>
                                        </div>
                                    
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- Bootstrap JS -->
        <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 
        <!-- Show Password JS -->
        <script src="{{asset('js/show-password.js')}}" ></script>

        <script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>

        <script>
            @if (session('status'))
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: "{{ session('status') }}",
                    showConfirmButton: true,
                    timer: 5000
                })
            @endif

            @if (session('error'))
                Swal.fire({
                    // position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: true,
                    timer: 15000
                })
            @endif
        </script>
        
    </body>
</html>
