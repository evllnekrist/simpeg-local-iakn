
<!-- BEGIN: Side Menu -->
<nav class="side-nav z-50 -mt-4 hidden w-[100px] overflow-x-hidden px-5 pb-16 pt-32 md:block xl:w-[180px]">
    @php
        $navs = (session('role_permission')?session('role_permission'):[]);
    @endphp
    @if(sizeof($navs))
        <ul>
            @foreach($navs as $nav)
                @if($nav['display_type'] == 'divider-text')
                    {{$nav['name']}}
                @else
                    <li>
                        <a href="{{$nav['slug']}}" class="side-menu">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="{{$nav['icon']}}" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                {{$nav['name']}}
                            </div>
                        </a>
                    </li>
                @endif
                @foreach($nav['children'] as $nav2)
                    <li>
                        <a href="{{$nav2['slug']}}" class="side-menu {{'/'.Request::path()==$nav2['slug'] ?'side-menu--active':''}}">
                            <div class="side-menu__icon">
                                <i data-tw-merge="" data-lucide="{{$nav2['icon']}}" class="stroke-1.5 w-5 h-5"></i>
                            </div>
                            <div class="side-menu__title">
                                {{$nav2['name']}}
                            </div>
                        </a>
                    </li>
                @endforeach        
                <li class="side-nav__divider my-6"></li>
            @endforeach
        </ul>
    @endif
</nav>
<!-- END: Side Menu -->