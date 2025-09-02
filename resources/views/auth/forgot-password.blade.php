<!DOCTYPE html>
<html lang="en"  data-theme-mode="dark" >
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Forgot Password</title>
     
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
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <form action="{{route('password.email')}}" method="POST">
                                    @csrf
                                    <div class="p-5">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <div>
                                                <img src="{{asset('storage/'. $settings['logo_light_image'])}}" alt="" class="authentication-brand desktop-logo h-auto" />
                                                <img src="{{asset('storage/'. $settings['logo_dark_image'])}}" alt="" class="authentication-brand desktop-dark h-auto" />
                                            </div>
                                        </div>
                                        <p class="h5 fw-semibold mb-2 text-center">Password Reset.</p>
                                        <p class="mb-3 text-muted op-7 fw-normal text-center">If you forgot your password then you are in the right place to reset it!</p>
                                    
                                        <div class="row gy-3">
                                            <div class="col-xl-12 mb-3">
                                                <label for="lockscreen-password" class="form-label text-default">Email</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control form-control-lg" id="lockscreen-password" placeholder="Your email.." name="email"/>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 d-grid mt-2 "><button class="btn btn-lg btn-primary rounded-pill">Get Reset Link</button></div>
                                        </div>
                                        <div class="text-center">
                                            <p class="fs-12 text-muted mt-4">
                                                Try reseting with different methods <a class="text-success" href="javascript:void(0);"><u>Phone Number</u></a> 
                                            </p>
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
