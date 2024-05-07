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

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav active" href="{{route('dashboard')}}">
                            <i data-feather="circle"></i><span>ข้อมูลชุมชนการท่องเที่ยว</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav {{ request()->routeIs('evaluate.index') ? 'avtive' : '' }}" href="{{route('evaluate.index')}}">
                            <i data-feather="circle"></i>แบบประเมิน
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="circle"></i><span>สรุปรายงาน</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li>
                                <a href="{{route('report.part')}}">ด้าน 1</a>
                            </li>
                            {{-- <li>
                                <a href="">ด้าน 2</a>
                            </li>
                            <li>
                                <a href="">ด้าน 3</a>
                            </li>
                            <li>
                                <a href="">ด้าน 4</a>
                            </li>
                            <li>
                                <a href="">ด้าน 5</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="circle"></i><span>ข้อมูลเกณฑ์มาตรฐาน</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li>
                                <a href="{{route('part.index')}}">ข้อมูลด้านเกณฑ์มาตรฐาน</a>
                            </li>
                            <li>
                                <a href="{{route('part-target.index')}}">ข้อมูลเป้าประสงค์</a>
                            </li>
                            <li>
                                <a href="{{route('part-target-sub.index')}}">ข้อมูลเกณฑ์การพิจารณา</a>
                            </li>
                            <li>
                                <a href="{{route('part-index.index')}}">ข้อมูลเกณฑ์การให้คะแนน</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>