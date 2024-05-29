<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="{{ asset('images/logo/logo.png') }}" alt="">
                </a>
            </div>
            <div class="dark-logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="{{ asset('images/logo/dark-logo.png') }}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i>
            </div>
        </div>
        <div class="left-menu-header col">

        </div>
        <div class="nav-right col pull-right right-menu p-0 box-col-6">
            <ul class="nav-menus">
                <li>
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a> --}}
                        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto">
            <i data-feather="more-horizontal"></i>
        </div>
    </div>
</div>