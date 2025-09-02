<!DOCTYPE html>
<html lang="en" data-theme-mode="dark" >
   
    <head>
        <base href="{{ url('/') }}">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Your Email Has Not been Verified</title>
    
       
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
            <div class="col-xxl-7 col-xl-7 col-lg-12">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                        <form action="{{route('verification.resend')}}" method="POST">
                            @csrf
                            <div class="p-5">
                                <div class="mb-3">
                                    <a href="/" class="d-flex justify-content-center">
                                        <img src="{{asset('storage/'. $settings['logo_light_image'])}}" alt="" class="authentication-brand desktop-logo" />
                                        <img src="{{asset('storage/'. $settings['logo_dark_image'])}}" alt="" class="authentication-brand desktop-dark" />
                                    </a>
                                </div>
                                <p class="h5 fw-semibold mb-2 text-center">Email Verify</p>
                                <p class="mb-3 text-muted op-7 fw-normal text-center">Please Click the button below to get a email confirmation link in your email!</p>
                            
                                <div class="row gy-3">
                                    <div class="col-xl-12 d-grid mt-2 "><button class="btn btn-lg btn-primary rounded-pill">Get Verification Link</button></div>
                                </div>
                                <div class="text-center">

                                    <p class="fs-12 text-muted mt-4">
                                        Other User? <a class="text-primary" href="{{route('logout')}}"><u>Sign In</u></a> 
                                    </p>
                                   
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-5 d-xl-block d-none px-0">
                <div class="authentication-cover">
                    <div class="aunthentication-cover-content rounded">
                        <div class="swiper keyboard-control">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="text-fixed-white text-center p-5 d-flex align-items-center justify-content-center">
                                        <div>
                                            <div class="mb-5"><img src="images/authentication/2.png" class="authentication-image" alt="" /></div>
                                            <h6 class="fw-semibold">Email Verification</h6>
                                            <p class="fw-normal fs-14 op-7">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa eligendi expedita aliquam quaerat nulla voluptas facilis. Porro rem voluptates possimus, ad, autem quae culpa architecto, quam
                                                labore blanditiis at ratione.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="text-fixed-white text-center p-5 d-flex align-items-center justify-content-center">
                                        <div>
                                            <div class="mb-5"><img src="images/authentication/3.png" class="authentication-image" alt="" /></div>
                                            <h6 class="fw-semibold">Email Verification</h6>
                                            <p class="fw-normal fs-14 op-7">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa eligendi expedita aliquam quaerat nulla voluptas facilis. Porro rem voluptates possimus, ad, autem quae culpa architecto, quam
                                                labore blanditiis at ratione.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
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
            document.addEventListener('DOMContentLoaded', function () {
                // Check for 'status' in session and display a success alert
                @if (session('status'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('status') }}',
                        timer: 3000,
                        showConfirmButton: false
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = '{{ route('login') }}';  // redirect to login page
                        }
                    });
                @endif

                // Check for 'email' error in session and display an error alert
                @if ($errors->has('email'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ $errors->first('email') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>

    </body>
</html>
