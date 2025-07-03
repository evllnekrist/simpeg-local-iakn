<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu group top-0 inset-x-0 fixed bg-theme-1/90 z-[60] border-b border-white/[0.08] dark:bg-darkmode-800/90 md:hidden before:content-[''] before:w-full before:h-screen before:z-10 before:fixed before:inset-x-0 before:bg-black/90 before:transition-opacity before:duration-200 before:ease-in-out before:invisible before:opacity-0 [&.mobile-menu--active]:before:visible [&.mobile-menu--active]:before:opacity-100">
    <div class="flex h-[70px] items-center px-3 sm:px-8">
        <a class="mr-auto flex" href="">
            <img class="w-6" src="{{asset('image/logo-clean.png')}}" alt="logo">
        </a>
        <a class="mobile-menu-toggler" href="#">
            <i data-tw-merge="" data-lucide="bar-chart2" class="stroke-1.5 h-8 w-8 -rotate-90 transform text-white"></i>
        </a>
    </div>
    <div class="scrollable h-screen z-20 top-0 left-0 w-[270px] -ml-[100%] bg-primary transition-all duration-300 ease-in-out dark:bg-darkmode-800 [&[data-simplebar]]:fixed [&_.simplebar-scrollbar]:before:bg-black/50 group-[.mobile-menu--active]:ml-0">
        <a href="#" class="fixed top-0 right-0 mt-4 mr-4 transition-opacity duration-200 ease-in-out invisible opacity-0 group-[.mobile-menu--active]:visible group-[.mobile-menu--active]:opacity-100">
            <i data-tw-merge="" data-lucide="x-circle" class="stroke-1.5 mobile-menu-toggler h-8 w-8 -rotate-90 transform text-white"></i>
        </a>
        
        @php
            $navs = (session('role_permission')?session('role_permission'):[]);
        @endphp
        @if(sizeof($navs))
            <ul class="py-2">
                @foreach($navs as $nav)
                    @if($nav['display_type'] == 'divider-text')
                        <li class="text-white text-center">{{$nav['name']}}</li>
                    @else
                        <li>
                            <a href="{{$nav['slug']}}" class="menu">
                                <div class="menu__icon">
                                    <i data-tw-merge="" data-lucide="{{$nav['icon']}}" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="menu__title">
                                    {{$nav['name']}}
                                </div>
                            </a>
                        </li>
                    @endif
                    @foreach($nav['children'] as $nav2)
                        <li>
                            <a href="{{$nav2['slug']}}" class="menu {{'/'.Request::path()==$nav2['slug'] ?'menu--active':''}}">
                                <div class="menu__icon">
                                    <i data-tw-merge="" data-lucide="{{$nav2['icon']}}" class="stroke-1.5 w-5 h-5"></i>
                                </div>
                                <div class="menu__title">
                                    {{$nav2['name']}}
                                </div>
                            </a>
                        </li>
                    @endforeach        
                    <li class="side-nav__divider my-6"></li>
                @endforeach
            </ul>
        @endif
    
    </div>
</div>
<!-- END: Mobile Menu -->