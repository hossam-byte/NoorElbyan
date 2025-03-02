<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="rtl" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>


    <style>
        ::-webkit-scrollbar {
            width: 12px;
            /* Width of the scrollbar */
            height: 12px;
            /* Height of the horizontal scrollbar */
        }

        ::-webkit-scrollbar-thumb {
            background-color: #696cff;
            /* Scrollbar color */
            border-radius: 10px;
            /* Rounded corners */
            border: 13px solid #ffffff;
            /* Space around the thumb */
        }

        ::-webkit-scrollbar-track {
            background: #f8f9fa;
            /* Track color */
            border-radius: 10px;
        }

        /* Firefox-specific styling */
        * {
            scrollbar-width: thin;
            /* Thin scrollbar */
            scrollbar-color: #696cff #f8f9fa;
            /* Thumb and track colors */
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo active">
                    <a href="{{ route('dashboard') }}" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bold ms-2">اكاديمية نور البيان</span>
                    </a>

                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item mb-3 {{ request()->is('dashboard') ? 'active' : '' }} open">
                        <a href="/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div class="text-truncate" data-i18n="لوحة التحكم">لوحة التحكم</div>
                        </a>
                    </li>
                    <li
                        class="menu-item mb-3 {{ request()->is('students') || request()->is('students/create') || request()->is('students/*/edit') || request()->is('students/*/show') || request()->is('students/absence') || request()->is('students/*/absence-h') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div class="text-truncate" data-i18n="الطلاب">الطلاب</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('students') ? 'active' : '' }}">
                                <a href="{{ route('students.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة الطلاب">قائمة الطلاب</div>
                                </a>
                            </li>
                            {{--                        <li class="menu-item mt-3 {{request()->is('students/create')? "active": ""}}"> --}}
                            {{--                            <a href="{{route('students.create')}}" class="menu-link"> --}}
                            {{--                                <div class="text-truncate" data-i18n="اضافة طالب">اضافة طالب</div> --}}
                            {{--                            </a> --}}
                            {{--                        </li> --}}
                            <li class="menu-item mt-3 {{ request()->is('students/*/show') ? 'active' : '' }}">
                                <a href="#" class="menu-link">
                                    <div class="text-truncate" data-i18n="بيانات الطالب">بيانات الطالب</div>
                                </a>
                            </li>
                            <li
                                class="menu-item mt-3 {{ request()->is('students/absence') || request()->is('students/*/absence-h') ? 'active' : '' }}">
                                <a href="{{ route('students.absence.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="الغياب">الغياب</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item mb-3 {{ request()->is('teachers') || request()->is('teachers/create') || request()->is('teachers/*/edit') || request()->is('teachers/*/show') || request()->is('teachers/absence') || request()->is('teachers/absence-h') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                            <div class="text-truncate" data-i18n="المعلمين">المعلمين</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('teachers') ? 'active' : '' }}">
                                <a href="{{ route('teachers.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة المعلمين">قائمة المعلمين</div>
                                </a>
                            </li>
                            <li class="menu-item mt-3 {{ request()->is('teachers/*/show') ? 'active' : '' }}">
                                <a href="#" class="menu-link">
                                    <div class="text-truncate" data-i18n="بيانات المعلم">بيانات المعلم</div>
                                </a>
                            </li>
                            <li
                                class="menu-item mt-3 {{ request()->is('teachers/absence') || request()->is('teachers/absence-h') ? 'active' : '' }}">
                                <a href="{{ route('teachers.absence.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="الغياب">الغياب</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="menu-item mb-3 {{ request()->is('classes') || request()->is('classes/create') || request()->is('classes/*/edit') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-school"></i>
                            <div class="text-truncate" data-i18n="الفصول">الفصول</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('classes') ? 'active' : '' }}">
                                <a href="{{ route('classes.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة الفصول">قائمة الفصول</div>
                                </a>
                            </li>
                            <li class="menu-item mt-3 {{ request()->is('classes/create') ? 'active' : '' }}">
                                <a href="{{ route('classes.create') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="اضافة فصل">اضافة فصل</div>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="menu-item mb-3 {{ request()->is('quizzes') || request()->is('quizzes/create') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-help-circle"></i>
                            <div class="text-truncate" data-i18n="الاختبارات">الاختبارات</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('quizzes') ? 'active' : '' }}">
                                <a href="{{ route('quizzes.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة الاختبارات">قائمة الاختبارات</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item mb-3 {{ request()->is('drivers') || request()->is('drivers/create') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-car"></i>
                            <div class="text-truncate" data-i18n="السائقين">السائقين</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('drivers') ? 'active' : '' }}">
                                <a href="{{ route('drivers.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة السائقين">قائمة السائقين</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item mb-3 {{ request()->is('stuff') || request()->is('stuff/create') ? 'active open' : '' }} ">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon fa-solid fa-user-tie"></i>
                            <div class="text-truncate" data-i18n="اعضاء المؤسسه">اعضاء المؤسسه</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item mt-3 {{ request()->is('stuff') ? 'active' : '' }}">
                                <a href="{{ route('stuff.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="قائمة اعضاء المؤسسه">قائمة اعضاء المؤسسه
                                    </div>
                                </a>
                            </li>
                            <li class="menu-item mt-3 {{ request()->is('stuff/create') ? 'active' : '' }}">
                                <a href="{{ route('stuff.create') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="اضافة عضو">اضافة عضو</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item mb-3">
                        <a href="#" class="menu-link">
                            <i class="menu-icon fa-solid fa-dollar-sign"></i>
                            <div class="text-truncate" data-i18n="مصاريف">مصاريف</div>
                        </a>
                    </li>
                    <li class="menu-item mb-3 ">
                        <a href="#" class="menu-link">
                            <i class="menu-icon fa-solid fa-gear"></i>
                            <div class="text-truncate" data-i18n="الاعدادات">الاعدادات</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="#">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            @if (!request()->is('dashboard'))
                                <a href="javascript:history.back()" class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-right-arrow"></i>
                                </a>
                            @endif
                            <h5 class="m-0">- {{ $heading }}</h5>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-danger">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    {{ $slot }}
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                <a href="https://foursw.com/" class="footer-link fw-bolder">FourSw</a>
                                , made with ❤️ by ,
                            </div>
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            ©
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/jquery-sticky/jquery-sticky.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/academy.js') }}"></script>
</body>

</html>
