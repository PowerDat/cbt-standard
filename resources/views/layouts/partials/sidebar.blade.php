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

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="home"></i><span>Dashboard</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="index.html">Default</a></li>
                            <li><a href="dashboard-02.html">Ecommerce</a></li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>เกณฑ์มาตรฐาน</h6>
                        </div>
                    </li>
                    <li>
                        <a href="{{route('evaluate.community.index')}}" class="nav-link menu-title link-nav">
                            <i data-feather="circle"></i>ด้านการบริหารจัดการการท่องเที่ยวโดยชุมชน
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
