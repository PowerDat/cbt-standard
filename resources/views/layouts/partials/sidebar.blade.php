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

                    @php
                    $role_id = "";
                    foreach (Auth::user()->roles as $key => $value) {
                        $role_id = $value->id;
                    }

                    $permissions = DB::select("
                    select route, action 
                    from permissions 
                    INNER JOIN permission_role ON permissions.id = permission_role.permission_id
                    WHERE action = 'view' AND permission_role.role_id = $role_id
                    ");
                    $permission_sub_menu = DB::select("
                    SELECT route, action 
                    from permissions 
                    INNER JOIN permission_role ON permissions.id = permission_role.permission_id
                    WHERE action = 'view'
                        AND route = (SELECT sub_menu_route FROM sub_menu WHERE route = sub_menu_route)
                        AND permission_role.role_id = $role_id
                    ");
                    @endphp

                    @foreach ($menus as $item)
                        @if (count($item->submenus) > 0)
                            @if (!empty($permission_sub_menu))
                            <li class="dropdown">
                                <a class="nav-link menu-title" href="{{ $item->menu_route }}">
                                    <i class="fa fa-circle-o"></i> <span>{{$item->menu_name}}</span>
                                </a>
                                <ul class="nav-submenu menu-content" id="menu-content">
                                    @foreach ($item->submenus as $submenu)
                                        @foreach ($permissions as $permission)
                                            @if ($submenu->sub_menu_route == $permission->route)
                                                <li>
                                                    <a href="{{route($submenu->sub_menu_route)}}" id="nav-sub-menu">
                                                        <i class="fa fa-angle-right"></i> <span>{{$submenu->sub_menu_name}}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li>        
                            @endif
                        @else
                            <li class="dropdown">
                                @foreach ($permissions as $permission)
                                    @if ($permission->route == $item->menu_route)
                                    <a class="nav-link menu-title link-nav" href="{{ route($item->menu_route) }}">
                                        <i class="fa fa-circle-o"></i> <span>{{$item->menu_name}}</span>
                                    </a>
                                    @endif
                                @endforeach
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