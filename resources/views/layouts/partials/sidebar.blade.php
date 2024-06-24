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

                    @foreach ($menus as $item)
                    @if (count($item->submenus) > 0)
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="{{ $item->menu_route }}">
                            <i class="fa fa-circle-o"></i> <span>{{$item->menu_name}}</span>

                        </a>
                        <ul class="nav-submenu menu-content" id="menu-content">
                            @foreach ($item->submenus as $submenu)
                            <li>
                                <a href="{{route($submenu->sub_menu_route)}}" id="nav-sub-menu">
                                    <i class="fa fa-angle-right"></i> <span>{{$submenu->sub_menu_name}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route($item->menu_route) }}">
                            <i class="fa fa-circle-o"></i> <span>{{$item->menu_name}}</span>
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

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#menu-content").css("display", "block");
    });
</script>
@endpush