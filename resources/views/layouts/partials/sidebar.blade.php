<!-- Page Sidebar Start-->
<header class="main-nav mt-2">

    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ request()->routeIs('evaluate.index') ? 'avtive' : '' }}" href="{{route('evaluate.index')}}">
                            <i data-feather="circle"></i>แบบประเมิน
                        </a>
                    </li> --}}

                    {{-- @if (Auth::user()->hasRole('administrator')) --}}
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('part-type.index')}}">
                            <i data-feather="circle"></i>ข้อมูลเกณฑ์มาตรฐาน
                        </a>
                    </li>
+
                    <li class="dropdown">
                        <a class="nav-link" href="javascript:void(0)">
                            <i data-feather="circle"></i><span>ตั้งค่าระบบ</span>
                        </a>
                            <li class="text-center mt-3">
                                <a href="{{route('user.index')}}">
                                    <i class="fa fa-circle"></i> จัดการผู้ใช้
                                </a>
                            </li>
                            <li class="text-center mt-3">
                                <a href="{{route('role.index')}}">
                                    <i class="fa fa-circle"></i> จัดการบทบาท
                                </a>
                            </li>
                    </li> --}}
                    {{-- @endif --}}
                    

                    @foreach ($menu as $item)
                        @if (count($item->submenus) > 0)
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="{{ $item->menu_route }}">
                                <i data-feather="circle"></i><span>{{$item->menu_name}}</span> 
                            </a>
                            <ul class="nav-submenu menu-content" id="menu-content">
                                @foreach ($item->submenus as $submenu)
                                <li>
                                    <a href="{{route($submenu->sub_menu_route)}}" id="nav-sub-menu">
                                        {{$submenu->sub_menu_name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route($item->menu_route) }}">
                                <i data-feather="circle"></i><span>{{$item->menu_name}}</span> 
                            </a>
                        </li>
                        @endif
                    @endforeach

                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </ul>
            </div>
        </div>
    </nav>
</header>

