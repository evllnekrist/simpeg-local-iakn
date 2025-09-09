<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="tapi" content="{{Session::get('_token_api')}}">
        <meta name="description" content="{{ config('app.desc') }}">
        <meta name="keywords" content="katingan,mandatling,bank data,dlh">
        <meta name="author" content="Evelline Krist.">
        <title>@yield('title') | {{ config('app.name') }}</title>
        <link rel="icon" type="image/x-icon" href="{{asset('image/logo-clean.png')}}">
        <!-- BEGIN: CSS Assets-->
         
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{asset('dist/css/vendors/simplebar.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/vendors/tippy.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('dist/css/components/mobile-menu.css')}}">
        <link rel="stylesheet" href="{{asset('dist/css/themes/enigma/side-nav.css?v=241023')}}">
        <link rel="stylesheet" href="{{asset('dist/css/app.css?v=25090801')}}">
        <link rel="stylesheet" href="{{asset('page/css/app.css?v=25090801')}}">
        <!-- END: CSS Assets-->
        @yield('addition_css')

        <style>
            .background-img {
                width: 100%;
                height: 100vh;
                background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5));
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                border: 2px solid #ccc;
            }
        </style>

    </head>
    <body>
        {{-- @include('components.enigma.display-change-widget') --}}
        <div class="enigma py-5 px-5 md:py-0 sm:px-8 md:px-0 before:content-[''] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 dark:before:from-darkmode-800 dark:before:to-darkmode-800 md:before:bg-none md:bg-slate-200 md:dark:bg-darkmode-800 before:fixed before:inset-0 before:z-[-1]">
            @include('components.enigma.nav-mobile')
            @include('components.enigma.top-bar')
            <div class="flex overflow-hidden">
                @include('components.enigma.nav-side')
                <!-- BEGIN: Content -->
                <div id="content-wrap" class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
                    @yield('content')
                </div>
                <!-- END: Content -->
            </div>
        </div>
        <script>
            const assetUrl = "{{asset('/')}}"
            const accept_mimes = JSON.parse(`{!! json_encode(Config::get('app.accept_mimes')) !!}`);
            // console.log('accept_mimes',accept_mimes);
        </script>
        <!-- BEGIN: Vendor JS Assets-->
        <script src="{{asset('dist/js/vendors/jquery.min.js')}}"></script>
        <script src="{{asset('dist/js/vendors/axios.min.js')}}"></script>
        {{-- <script src="{{asset('dist/js/vendors/dom.js')}}"></script> --}}
        <script src="{{asset('dist/js/vendors/tailwind-merge.js')}}"></script>
        <script src="{{asset('dist/js/vendors/lucide.js')}}"></script>
        <script src="{{asset('dist/js/vendors/popper.js')}}"></script>
        <script src="{{asset('dist/js/vendors/dropdown.js')}}"></script>
        <script src="{{asset('dist/js/vendors/tippy.js')}}"></script>
        <script src="{{asset('dist/js/vendors/transition.js')}}"></script>
        <script src="{{asset('dist/js/vendors/simplebar.js')}}"></script>
        <script src="{{asset('dist/js/vendors/modal.js')}}"></script>
        <script src="{{asset('dist/js/vendors/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('dist/js/components/base/theme-color.js')}}"></script>
        <script src="{{asset('dist/js/components/base/lucide.js')}}"></script>
        <script src="{{asset('dist/js/themes/enigma.js')}}"></script>
        <script src="{{asset('dist/js/components/mobile-menu.js')}}"></script>
        <script src="{{asset('dist/js/components/themes/enigma/top-bar.js')}}"></script>
        <script src="{{asset('page/js/app.js')}}?v=250117"></script>
        <!-- END: Vendor JS Assets-->
        <!-- BEGIN: Pages, layouts, components JS Assets-->
        @yield('addition_script')
        <script>
            $(document).ready(function () {
                const path = window.location.pathname; // Get the current pathname
                const allowedRoutes = [ // Define routes where the background should be applied
                    "/",            // Base URL
                    "/dashboard",   // Dashboard route
                ];

                if (allowedRoutes.includes(path)) { // Check if the current route is in the allowed routes
                    const images = [ // Define the list of images
                        'bg-1','bg-2','bg-3','bg-4','bg-5'
                    ];

                    const randomImage = images[Math.floor(Math.random() * images.length)]; // Pick a random image

                    // Add the class and set the background image
                    $("#content-wrap")
                        .addClass('background-img')
                        .css('background-image', `linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1)), url(/image/bg/${randomImage}.jpg)`);
                }
            });
        </script>
        <!-- END: Pages, layouts, components JS Assets-->
    </body>
</html>
