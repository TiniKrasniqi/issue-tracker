<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">
    <head>
        <base href="{{ url('/') }}">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield('title')</title>
        @yield('extra_meta')
        <script src="libs/choices.js/public/assets/scripts/choices.min.js"></script>
        <script src="js/main.js"></script>
        <link id="style" href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/styles.min.css" rel="stylesheet" />
        <link href="css/icons.css" rel="stylesheet" />
        <link href="libs/node-waves/waves.min.css" rel="stylesheet" />
        <link href="libs/simplebar/simplebar.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="libs/flatpickr/flatpickr.min.css" />
        <link rel="stylesheet" href="libs/%40simonwep/pickr/themes/nano.min.css" />
        <link rel="stylesheet" href="libs/choices.js/public/assets/styles/choices.min.css" />
        <link rel="stylesheet" href="libs/sweetalert2/sweetalert2.min.css" />
        @yield('styles')
        <style>
            #preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                z-index: 9999;
                display:flex;
                justify-content:center;
                align-items: center;
            }

            .spinner {
                border: 4px solid rgba(var(--primary-rgb), .1);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border-left-color: var(--primary-color);
                animation: spin 1s ease infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

        </style>
    </head>
    <body>
      
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    @include('partials.switcher')
        <div class="page">
            
            @include('partials.header')
            @include('search.partials.overlay')
            @include('partials.sidebar')
            <!-- Start::app-content -->
            <div class="main-content app-content">
                <div class="container-fluid">
                    
                    @yield('content')
                </div>
            </div>
            <!-- End::app-content -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="input-group">
                                <a href="javascript:void(0);" class="input-group-text" id="Search-Grid"><i class="fe fe-search header-link-icon fs-18"></i></a>
                                <input type="search" class="form-control border-0 px-2" placeholder="Search" aria-label="Username" />
                                <a href="javascript:void(0);" class="input-group-text" id="voice-search"><i class="fe fe-mic header-link-icon"></i></a>
                                <a href="javascript:void(0);" class="btn btn-light btn-icon" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fe fe-more-vertical"></i> </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <div class="mt-4">
                                <p class="font-weight-semibold text-muted mb-2">Are You Looking For...</p>
                                <span class="search-tags">
                                    <i class="fe fe-user me-2"></i>People<a href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a>
                                </span>
                                <span class="search-tags">
                                    <i class="fe fe-file-text me-2"></i>Pages<a href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a>
                                </span>
                                <span class="search-tags">
                                    <i class="fe fe-align-left me-2"></i>Articles<a href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a>
                                </span>
                                <span class="search-tags">
                                    <i class="fe fe-server me-2"></i>Tags<a href="javascript:void(0)" class="tag-addon"><i class="fe fe-x"></i></a>
                                </span>
                            </div>
                            <div class="my-4">
                                <p class="font-weight-semibold text-muted mb-2">Recent Search :</p>
                                <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                                    <a href="notifications.html"><span>Notifications</span></a> <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                                </div>
                                <div class="p-2 border br-5 d-flex align-items-center text-muted mb-2 alert">
                                    <a href="alerts.html"><span>Alerts</span></a> <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                                </div>
                                <div class="p-2 border br-5 d-flex align-items-center text-muted mb-0 alert">
                                    <a href="mail.html"><span>Mail</span></a> <a class="ms-auto lh-1" href="javascript:void(0);" data-bs-dismiss="alert" aria-label="Close"><i class="fe fe-x text-muted"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group ms-auto"><button class="btn btn-sm btn-primary-light">Search</button> <button class="btn btn-sm btn-primary">Clear Recents</button></div>
                        </div>
                    </div>
                </div>
            </div>
           @include('partials.footer')
        </div>
        <div class="scrollToTop">
            <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
        </div>
        <div id="responsive-overlay"></div>
        <!-- Popper JS -->
        <script src="libs/%40popperjs/core/umd/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Defaultmenu JS -->
        <script src="js/defaultmenu.min.js"></script>
        <!-- Node Waves JS-->
        <script src="libs/node-waves/waves.min.js"></script>
        <!-- Sticky JS -->
        <script src="js/sticky.js"></script>
        <!-- Simplebar JS -->
        <script src="libs/simplebar/simplebar.min.js"></script>
        <script src="js/simplebar.js"></script>
        <!-- Color Picker JS -->
        <script src="libs/%40simonwep/pickr/pickr.es5.min.js"></script>
        <!-- Custom-Switcher JS -->
        <script src="js/custom-switcher.min.js"></script>
        <!-- Custom JS -->
        <script src="js/custom.js"></script>
        <script src="libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
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
            @if (session('success'))
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
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
                    timer: 5000
                })
            @endif
            @if($errors->any())
                let errors = {!! json_encode($errors->all()) !!};
                Swal.fire({
                    title: 'Error!',
                    html: errors.join('<br>'),
                    icon: 'error'
                });
            @endif

            document.addEventListener('DOMContentLoaded', function() {
                var preloader = document.getElementById('preloader');
                preloader.style.display = 'none';
            });

            function debounce(fn, delay = 300) {
                let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
            }

            const overlay   = document.getElementById('global-search-overlay');
            const input     = document.getElementById('global-search-input');
            const closeBtn  = document.getElementById('global-search-close');
            const bodyEl    = document.getElementById('global-search-body');
            const loadingEl = document.getElementById('global-search-loading');
            const resultsEl = document.getElementById('global-search-results');
            const emptyEl   = document.getElementById('global-search-empty');

            window.openGlobalSearch = function(preset = '') {
                overlay.classList.remove('d-none');
                resultsEl.innerHTML = '';
                emptyEl.classList.add('d-none');
                loadingEl.classList.add('d-none');
                input.value = preset || input.value || '';
                setTimeout(() => input.focus(), 10);
            };

            function closeOverlay() { overlay.classList.add('d-none'); }
            closeBtn.addEventListener('click', closeOverlay);
            overlay.addEventListener('click', (e) => { if (e.target === overlay) closeOverlay(); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !overlay.classList.contains('d-none')) closeOverlay(); });

            const doSearch = debounce(async (q) => {
                if (!q || q.trim().length < 2) {
                    resultsEl.innerHTML = '';
                    emptyEl.classList.add('d-none');
                    loadingEl.classList.add('d-none');
                    return;
                }

                loadingEl.classList.remove('d-none');
                emptyEl.classList.add('d-none');
                
                try {
                    const res = await fetch(`{{ route('search.index') }}?q=` + encodeURIComponent(q));
                    const data = await res.json(); // { html }
                    resultsEl.innerHTML = data.html || '';
                    loadingEl.classList.add('d-none');
                    emptyEl.classList.toggle('d-none', !!data.html?.trim());
                } catch (err) {
                    loadingEl.classList.add('d-none');
                    resultsEl.innerHTML = '';
                    emptyEl.classList.remove('d-none');
                }
            
            }, 350);

            input.addEventListener('input', (e) => doSearch(e.target.value));
            document.getElementById('searchIcon').addEventListener('focus', () => openGlobalSearch());
        </script>


        @yield('scripts')
    </body>
</html>
