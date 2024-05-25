<header class="main-nav">
    <nav class="mt-3">
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    
                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav active" href="{{route('dashboard')}}">
                            <i data-feather="circle"></i><span>ข้อมูลชุมชนการท่องเที่ยว</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav active" href="{{route('dashboard')}}">
                            <i data-feather="circle"></i><span>ข้อมูลกรรมการ</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ request()->routeIs('evaluate.index') ? 'avtive' : '' }}" href="{{route('evaluate.index')}}">
                            <i data-feather="circle"></i>แบบประเมิน
                        </a>
                    </li>
                    @endif
                    
                    <li class="dropdown">
                        <a class="nav-link" href="javascript:void(0)">
                            <i data-feather="circle"></i><span>สรุปรายงาน</span>
                        </a>
                        {{-- <ul class="nav-submenu menu-content"> --}}
                            <li class="text-center mt-3">
                                <a href="{{route('report.part-first')}}">
                                    <i class="fa fa-circle"></i> ด้าน 1
                                </a>
                            </li>
                            <li class="text-center mt-3">
                                <a href="{{route('report.part-second')}}">
                                    <i class="fa fa-circle"></i> ด้าน 2
                                </a>
                            </li>
                            <li class="text-center mt-3">
                                <a href="{{route('report.part-third')}}">
                                    <i class="fa fa-circle"></i> ด้าน 3
                                </a>
                            </li>
                            <li class="text-center mt-3">
                                <a href="{{route('report.part-fourth')}}">
                                    <i class="fa fa-circle"></i> ด้าน 4
                                </a>
                            </li>
                            <li class="text-center mt-3">
                                <a href="{{route('report.part-fifth')}}">
                                    <i class="fa fa-circle"></i> ด้าน 5
                                </a>
                            </li>
                        {{-- </ul> --}}
                    </li>

                    @if (Auth::user()->role_id == 3)
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('part.index')}}">
                            <i data-feather="circle"></i>ข้อมูลเกณฑ์มาตรฐาน
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>