<!DOCTYPE html>
<html lang="en"  data-theme-mode="dark" >
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>User Login</title>
     
        <!-- Favicon -->
        <link rel="icon" href="images/brand-logos/favicon.ico" type="image/x-icon" />
        <!-- Main Theme Js -->
        <script src="js/authentication-main.js"></script>
        <!-- Bootstrap Css -->
        <link id="style" href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Style Css -->
        <link href="css/styles.min.css" rel="stylesheet" />
        <!-- Icons Css -->
        <link href="css/icons.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="libs/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="libs/sweetalert2/sweetalert2.min.css" />
       
    </head>
    <body class="bg-white">
        <div class="row authentication mx-0">
            <div class="col-xxl-12 col-xl-12 col-lg-12 d-xl-block  px-0">
                <div class="authentication-cover py-5">
                    <div class="aunthentication-cover-content rounded h-auto w-auto">
                        <div class="row justify-content-center align-items-center ">
                            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                                <div class="">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div>
                                            <img src="{{asset('storage/'. $settings['logo_light_image'])}}" alt="" class="authentication-brand desktop-logo h-auto" />
                                            <img src="{{asset('storage/'. $settings['logo_dark_image'])}}" alt="" class="authentication-brand desktop-dark h-auto" />
                                        </div>
                                    </div>
                                    <p class="h5 fw-semibold mb-2 text-center">Sign In</p>
                                    
                                    <div class="btn-list text-center">
                                        <button class="btn btn-light">
                                            <svg class="google-svg" xmlns="http://www.w3.org/2000/svg" width="2443" height="2500" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                                                <path
                                                    fill="#4285F4"
                                                    d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                                />
                                                <path
                                                    fill="#34A853"
                                                    d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                                />
                                                <path
                                                    fill="#FBBC05"
                                                    d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                                />
                                                <path
                                                    fill="#EB4335"
                                                    d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                                />
                                            </svg>
                                            Sign In with google
                                        </button>
                                        <button class="btn btn-icon btn-light"><i class="ri-facebook-fill"></i></button> <button class="btn btn-icon btn-light"><i class="ri-twitter-fill"></i></button>
                                    </div>
                                    <div class="text-center my-5 authentication-barrier"><span>OR</span></div>
                                    <form action="{{route('login.authenticate')}}" method="POST">
                                        @csrf
                                        <div class="row gy-3">
                                            <div class="col-xl-12 mt-0">
                                                <label for="signin-username" class="form-label text-default">Email</label> 
                                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} form-control-lg" id="signin-username" placeholder="Email..." name="email" value="{{ old('email')}}" />
                                                @if($errors->has('email'))
                                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-xl-12 mb-3">
                                                <label for="signin-password" class="form-label text-default d-block">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} form-control-lg" id="signin-password" placeholder="Password..." name="password"/>
                                                    <button class="btn btn-light" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                                    @if($errors->has('password'))
                                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                                    @endif
                                                    
                                                </div>
                                                <div class="mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" /> <label class="form-check-label text-muted fw-normal" for="defaultCheck1"> Remember password ? </label>
                                                        <a href="{{route('password.request')}}" class="float-end text-danger">Forget password ?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 d-grid mt-2"><button  type="submit" class="btn btn-lg btn-primary rounded-pill">Sign In</button></div>
                                        </div>
                                    </form>
                                    
                                    <div class="text-center">
                                        <p class="fs-12 text-muted mt-4">Dont have an account? <a href="/register" class="text-primary ">Sign Up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- Bootstrap JS -->
        <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Swiper JS -->
        <script src="libs/swiper/swiper-bundle.min.js"></script>
        <!-- Internal Sing-Up JS -->
        <script src="js/authentication.js"></script>
        <!-- Show Password JS -->
        <script src="js/show-password.js"></script>

        <script src="libs/sweetalert2/sweetalert2.min.js"></script>

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
