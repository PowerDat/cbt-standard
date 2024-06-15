<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                        
    <div class="table-responsive mt-3">
        <table class="table table-bordered ">
            <thead class="bg-light text-center">
                <tr>
                    <th>ลำดับ</th>
                    <th>เกณฑ์</th>
                    <th>คะแนนเต็ม</th>
                    <th>คะแนนดิบ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($score_second as $item)
                <tr>
                    <td class="text-center">{{$item->part_target_order}}</td>
                    <td>{{$item->part_target_name}}</td>
                    <td class="text-center">4</td>
                    <td class="text-center">{{$item->sum_score}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-end"><strong>คะแนนรวม</strong></td>
                    <td class="text-center"><strong>{{count($score_second) * 4}}</strong></td>
                    <td class="text-center"><strong>{{number_format($total_second, 2)}}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-end"><strong>คะแนนที่ได้</strong></td>
                    <td class="text-center">
                        @if (!empty($total_second))
                        <strong>{{number_format($total_second/count($score_second), 2) }}</strong>
                        @endif
                    </td>
                    <td class="text-center"></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    {{-- grahp --}}
    <div class="row mt-3">
        <h5 class="text-center">การนำผลคะแนนไปใช้ในการวางแผนพัฒนา</h5>
        <div class="col-sm-6">
            <div class="chart-container" style="position: relative; height:60vh; width:120vw">
                <canvas id="myRadarGraph_second"></canvas>
            </div>
        </div>
        <div class="col-sm-6 m-t-50">
            <ul class="list-group" style="font-size: 12px;">
                @foreach ($part_target_second as $item)
                <li class="list-group-item">
                    <i class="fa fa-circle"></i> {{'เกณฑ์ '.$item->part_target_order.' '.$item->part_target_name}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /* ----- ด้าน 2 ----- */ 
    const data_second = {
        labels: @json($data_second['labels']),
        datasets: [{
            label: 'ผลคะแนน',
            data: @json($data_second['data']),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
    };

    const config_second = {
        type: 'radar',
        data: data_second,
        options: {},
    };

    const myChart_second = new Chart(
        document.getElementById('myRadarGraph_second'),
        config_second
    );
</script>