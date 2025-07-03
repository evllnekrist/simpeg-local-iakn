
<!-- BEGIN: Top Bar -->
<div class="h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-5 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700 before:content-[''] before:absolute before:h-[65px] before:inset-0 before:top-0 before:mx-7 before:bg-primary/30 before:mt-3 before:rounded-xl before:hidden before:md:block before:dark:bg-darkmode-600/30 after:content-[''] after:absolute after:inset-0 after:h-[65px] after:mx-3 after:bg-primary after:mt-5 after:rounded-xl after:shadow-md after:hidden after:md:block after:dark:bg-darkmode-600">
    <div class="flex h-full items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="-intro-x hidden md:flex xl:w-[100px]">
            <img src="{{asset('image/logo-sli-horizon-darkmode.png')}}" alt="Logo" class="w-24">
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="flex h-[45px] md:ml-10 md:border-l border-white/[0.08] dark:border-white/[0.08] mr-auto -intro-x md:pl-6">
            @if(isset($breadcrumbs))
            <ol class="flex items-center text-theme-1 dark:text-slate-300 text-white/90">
                @for($i=0;$i<sizeof($breadcrumbs);$i++)
                    @if($i==sizeof($breadcrumbs)-1)
                    <li class="relative ml-5 pl-0.5 before:content-[''] before:w-[14px] before:h-[14px] before:bg-chevron-white before:transform before:rotate-[-90deg] before:bg-[length:100%] before:-ml-[1.125rem] before:absolute before:my-auto before:inset-y-0 dark:before:bg-chevron-white text-white/70">
                    @else
                    <li class="">
                    @endif
                        <a href="{{@$breadcrumbs[$i]['url']}}">{{@$breadcrumbs[$i]['label']}}</a>
                    </li>
                @endfor
            </ol>
            @endif
        </nav>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Search -->
        <div class="intro-x relative mr-3 sm:mr-6">
            <div class="search relative hidden sm:block">
                <input id="global-file-search" data-tw-merge="" type="text" placeholder="Cari..." class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent ease-in-out text-sm placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-opacity-40 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 w-56 rounded-full border-transparent bg-slate-200 pr-8 shadow-none transition-[width] duration-300 focus:w-72 focus:border-transparent dark:bg-darkmode-400">
                <i data-tw-merge="" data-lucide="search" class="stroke-1.5 w-5 h-5 absolute inset-y-0 right-0 my-auto mr-3 text-slate-600 dark:text-slate-500"></i>
            </div>
            <a class="relative text-white/70 sm:hidden" href="">
                <i data-tw-merge="" data-lucide="search" class="stroke-1.5 w-5 h-5 dark:text-slate-500"></i>
            </a>
            <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="mt-5 invisible opacity-0 translate-y-1" data-enter-to="mt-[3px] visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="mt-[3px] visible opacity-100 translate-y-0" data-leave-to="mt-5 invisible opacity-0 translate-y-1" class="search-result absolute right-0 z-10 mt-[3px] hidden">
                <div class="box w-[450px] p-5">
                    <div class="mb-5 font-medium global-file-search-result-more" style="display: none">Berkas</div>
                    <div  id="global-file-search-result">
                        Pencarian minimal dari 3 karakter ...
                    </div>
                    <div href="#" class="mt-5 global-file-search-result-more font-medium text-slate-400 flex justify-between" style="display: none">
                        <div class="flex-1 text-warning">
                            <a class="search-close"><i class="fas fa-minus-square mr-5"></i>tutup bar</a>
                        </div>
                        <div class="flex-1 text-right">
                            <a href="#" id="global-file-search-result-open-link">
                                lihat list (<b>total <span id="global-file-search-result-total"></span> data</b>)
                                <i class="fas fa-angle-right ml-5"></i><i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Search -->
        <!-- BEGIN: Notifications -->
        {{-- <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative intro-x mr-4 sm:mr-6">
            <div data-tw-toggle="dropdown" aria-expanded="false" class="cursor-pointer relative block text-white/70 outline-none before:absolute before:right-0 before:top-[-2px] before:h-[8px] before:w-[8px] before:rounded-full before:bg-danger before:content-['']"><i data-tw-merge="" data-lucide="bell" class="stroke-1.5 w-5 h-5 dark:text-slate-500"></i></div>
            <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                <div data-tw-merge="" class="dropdown-content rounded-md border-transparent bg-white shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 mt-2 w-[280px] p-5 sm:w-[350px]">
                    <div class="mb-5 font-medium">Notifications</div>
                    <div class="cursor-pointer relative flex items-center">
                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            <img class="rounded-full" src="{{asset('dist/images/fakers/profile-3.jpg')}}" alt="profile picture">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                            </div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a class="mr-5 truncate font-medium" href="">
                                    Johnny Depp
                                </a>
                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                    06:05 AM
                                </div>
                            </div>
                            <div class="mt-0.5 w-full truncate text-slate-500">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer relative flex items-center mt-5">
                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            <img class="rounded-full" src="{{asset('dist/images/fakers/profile-11.jpg')}}" alt="profile picture">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                            </div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a class="mr-5 truncate font-medium" href="">
                                    Christian Bale
                                </a>
                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                    01:10 PM
                                </div>
                            </div>
                            <div class="mt-0.5 w-full truncate text-slate-500">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer relative flex items-center mt-5">
                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            <img class="rounded-full" src="{{asset('dist/images/fakers/profile-12.jpg')}}" alt="profile picture">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                            </div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a class="mr-5 truncate font-medium" href="">
                                    Kate Winslet
                                </a>
                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                    06:05 AM
                                </div>
                            </div>
                            <div class="mt-0.5 w-full truncate text-slate-500">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer relative flex items-center mt-5">
                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            <img class="rounded-full" src="{{asset('dist/images/fakers/profile-3.jpg')}}" alt="profile picture">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                            </div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a class="mr-5 truncate font-medium" href="">
                                    Al Pacino
                                </a>
                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                    05:09 AM
                                </div>
                            </div>
                            <div class="mt-0.5 w-full truncate text-slate-500">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer relative flex items-center mt-5">
                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            <img class="rounded-full" src="{{asset('dist/images/fakers/profile-13.jpg')}}" alt="profile picture">
                            <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">
                            </div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a class="mr-5 truncate font-medium" href="">
                                    Denzel Washington
                                </a>
                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">
                                    01:10 PM
                                </div>
                            </div>
                            <div class="mt-0.5 w-full truncate text-slate-500">
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative">
            <button data-tw-toggle="dropdown" aria-expanded="false" class="cursor-pointer image-fit zoom-in intro-x block h-8 w-8 scale-110 overflow-hidden rounded-full shadow-lg">
                <img src="{{asset(Auth::check()?Auth::user()->user_group_attr->img_main:'image/no-image-clean.png')}}" alt="profile picture">
            </button>
            <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                <div data-tw-merge="" class="dropdown-content rounded-md border-transparent p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 relative mt-px w-56 bg-theme-1/80 text-white before:absolute before:inset-0 before:z-[-1] before:block before:rounded-md before:bg-black">
                    <div class="p-2 font-medium font-normal">
                        @if(Auth::check())
                            <div class="font-medium">{{Auth::user()->name}}</div>
                            <div class="mt-0.5 text-xs">
                                <span class="text-white/70 dark:text-slate-500">{{Auth::user()->user_group_attr->nickname}}</span> &#124;
                                <span class="text-warning">{{Auth::user()->role_attr->name}}</span>
                            </div>
                        @else
                            <div class="font-medium">Publik</div>
                        @endif
                    </div>
                    <div class="h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400 bg-white/[0.08]">
                    </div>
                    @if(Auth::check())
                    <a  href="{{route('profile.edit')}}"
                        class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="user" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Profil</a>
                    <a  href="{{route('register')}}" target="_blank"
                        class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="edit" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Tambah Akun Baru</a>
                    <a  href="{{route('password.request')}}" target="_blank"
                        class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="lock" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Reset Password</a>
                    <a  href="{{route('faq')}}"
                        class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="help-circle" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Tanya?</a>
                    <div class="h-px my-2 -mx-2 bg-slate-200/60 dark:bg-darkmode-400 bg-white/[0.08]">
                    </div>
                    <a  href="{{route('logout')}}"
                        class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="toggle-right" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Logout</a>
                    @else
                    <a  href="{{route('login')}}"
                        class="text-sm cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item hover:bg-white/5"><i data-tw-merge="" data-lucide="toggle-right" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Punya akun?&nbsp;<u>Login disini</u></a>
                    @endif
                </div>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->