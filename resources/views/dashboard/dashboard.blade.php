@extends('layouts.master')

@section('content')

        @if ($role_name == 'community')
            @include('dashboard.community-dashboard')
        @endif

        @if ($role_name == 'researcher')
            @include('dashboard.researcher-dashboard')
        @endif

        @if ($role_name == 'administrator')
            @include('dashboard.admin-dashboard')
        @endif

@endsection

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{asset('js/chart.js')}}"></script>
    <script>
        const data = {
            labels: [
                'ด้าน 1',
                'ด้าน 2',
                'ด้าน 3',
                'ด้าน 4',
                'ด้าน 5',
            ],
            datasets: [{
                label: 'ผลคะแนน',
                data: [2, 3, 2.5, 4, 1],
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
            }]
        };

        const config = {
            type: 'radar',
            data: data,
            options: {},
        };

        const myChart = new Chart(
            document.getElementById('myRadarGraph'),
            config
        );
    </script>
@endpush
