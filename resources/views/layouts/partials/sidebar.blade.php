@php
use App\Models\Permission;

$role_id = "";

foreach (Auth::user()->roles as $key => $value) {
    $role_id = $value->id;
}

$permissions = DB::select("
select menu_id, sub_menu_id
from permissions
INNER JOIN permission_role ON permissions.id = permission_role.permission_id
WHERE permission_role.role_id = $role_id
ORDER BY menu_id, sub_menu_id asc
");
@endphp

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
                                    
                                @for ($i=0; $i < count($permissions); $i++)
                                    @if ($permissions[$i]->sub_menu_id != "" && $i == 0)
                                    <a class="nav-link menu-title" href="javascript:void(0)">
                                        <i class="fa fa-circle-o"></i> <span>{{$item->menu_name}}</span>
                                    </a>
                                    @endif
                                @endfor

                                <ul class="nav-submenu menu-content">
                                    @foreach ($item->submenus as $submenu)
                                        @foreach ($permissions as $permission)
                                            @if ($permission->sub_menu_id == $submenu->sub_menu_id)
                                            <li>
                                                <a href="{{route($submenu->sub_menu_route)}}" 
                                                    class="{{ (request()->route()->getName() == $submenu->sub_menu_route) ? 'active' : '' }}">
                                                    <i class="fa fa-angle-right"></i> <span>{{$submenu->sub_menu_name}}</span>
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li> 
                        @else
                        <li class="dropdown">
                            @foreach ($permissions as $permission)
                                @if ($permission->menu_id == $item->menu_id)
                                <a class="nav-link menu-title link-nav 
                                {{ (request()->route()->getName() == $item->menu_route) ? 'active' : '' }}" 
                                href="{{ route($item->menu_route) }}">
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
        
    });
</script>
@endpush