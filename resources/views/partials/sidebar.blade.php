 <!-- Start::app-sidebar -->
            <aside class="app-sidebar sticky" id="sidebar">
                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="/" class="header-logo">
                        <img src="{{ asset('storage/' . $settings['logo_light_image'] ?? '') }}" alt="logo" class="desktop-logo" /> <img src="{{ asset('storage/' . $settings['logo_light_icon'] ?? '') }}" alt="logo" class="toggle-logo" />
                        <img src="{{ asset('storage/' . $settings['logo_dark_image'] ?? '') }}" alt="logo" class="desktop-dark" /> <img src="{{ asset('storage/' . $settings['logo_dark_icon'] ?? '') }}" alt="logo" class="toggle-dark" />
                    </a>
                </div>
                <!-- End::main-sidebar-header -->
                <!-- Start::main-sidebar -->
                <div class="main-sidebar" id="sidebar-scroll">
                    <!-- Start::nav -->
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
                        </div>
                        <ul class="main-menu">
                            <li class="slide__category"><span class="category-name">Main</span></li>
                            <li class="slide">
                                <a href="/projects" class="side-menu__item @yield('projects_link')">
                                    <i class="bx bx-home side-menu__icon"></i> <span class="side-menu__label">Projects</span>
                                </a>
                            </li>
                            <li class="slide">
                                <a href="/issues" class="side-menu__item @yield('issues_link')">
                                    <i class="bx bx-home side-menu__icon"></i> <span class="side-menu__label">Issues</span>
                                </a>
                            </li>

                            @can('authentication-rights')
                            <li class="slide__category"><span class="category-name">Users</span></li>
                     
                            <li class="slide has-sub  @yield('authentication_cat') ">
                                <a href="javascript:void(0);" class="side-menu__item @yield('authentication_cat')">
                                    <i class="bx bx-fingerprint side-menu__icon"></i> <span class="side-menu__label">Authentication</span> <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1 ">

                                    <li class="slide has-sub @yield('user_category')">
                                        <a href="javascript:void(0);" class="side-menu__item @yield('user_category')">Users <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <!-- <li class="slide "><a href="" class="side-menu__item ">Add User</a></li> -->
                                            @can('user.view-all')
                                                <li class="slide"><a href="{{route('users.show')}}" class="side-menu__item @yield('view_users')">All Users</a></li>
                                                <li class="slide"><a href="{{route('users.disabled')}}" class="side-menu__item  @yield('disabled_users')">Disabled Users</a></li>
                                                <li class="slide"><a href="{{route('users.admin')}}" class="side-menu__item @yield('admin_users')">Administrators</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                    
                                    
                                    @can('role.view-all')
                                    <li class="slide"><a href="{{route('roles.show')}}" class="side-menu__item @yield('view_roles')">Roles</a></li>
                                    @endcan

                                  
                                </ul>
                            </li>
                            @endcan

                            @can('settings.manage')
                            <li class="slide__category"><span class="category-name">System Settings</span></li>
                    



                            <li class="slide has-sub  @yield('settings_cat') ">
                                <a href="javascript:void(0);" class="side-menu__item @yield('settings_cat')">
                                    <i class="bx bxs-cog side-menu__icon"></i> <span class="side-menu__label">Settings</span> <i class="fe fe-chevron-right side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1 ">
                                    <li class="slide"><a href="{{route('settings.app-settings')}}" class="side-menu__item @yield('app_settings')">App Settings</a></li>
                                    <li class="slide"><a href="{{route('settings.mail-settings')}}" class="side-menu__item @yield('mail_settings')">Mail Settings</a></li>
                                </ul>
                            </li>
                            @endcan
                            <li class="slide__category"><span class="category-name">Logout</span></li>
                            <li class="slide">
                                <a href="{{route('logout')}}" class="side-menu__item ">
                                    <i class="bx bx-log-out-circle side-menu__icon"></i> <span class="side-menu__label">Logout</span>
                                </a>
                            </li>

                        </ul>
                        <div class="slide-right" id="slide-right">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
                        </div>
                    </nav>
                    <!-- End::nav -->
                </div>
                <!-- End::main-sidebar -->
            </aside>
            <!-- End::app-sidebar -->