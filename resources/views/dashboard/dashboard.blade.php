@extends('layouts.master')

@section('content')

        {{--ชุมชน --}}
        @if ($role_name == 'community') 
            @include('dashboard.community-dashboard')
        @endif

        {{-- นักวิจัย --}}
        @if ($role_name == 'researcher')
            @include('dashboard.researcher-dashboard')
        @endif

        {{-- ผู้ดูแลระบบ --}}
        @if ($role_name == 'administrator')
            @include('dashboard.admin-dashboard')
        @endif

        {{-- กรรมการ --}}
        @if ($role_name == 'committee')
            @include('dashboard.committee-dashboard')
        @endif

@endsection


