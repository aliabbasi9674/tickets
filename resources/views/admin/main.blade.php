@extends('layouts.admin')

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h5 class="main-content-title tx-18 mg-b-1 mg-b-lg-1">سلام ، خوش آمدید!</h5>
                <p class="mg-b-0">پنل مدیریت تیکت آپارتمانا</p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">تعداد تیکت ها</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white"> {{$countTickets}}</h4>
{{--                                <p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>--}}
                            </div>
{{--                            <span class="float-right my-auto mr-auto">--}}
{{--										<i class="fas fa-arrow-circle-up text-white"></i>--}}
{{--										<span class="text-white op-7"> +427</span>--}}
{{--									</span>--}}
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">
                        @foreach($ret['count_tickets_month'] as $item)
                        {{$item}},
                    @endforeach
                </span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">تیکت های در حال بررسی</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$countTicketsP}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">
                   @foreach($ret['count_ticketsP_month'] as $item)
                        {{$item}},
                    @endforeach
                </span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">تیکت های تکمیل شده</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$countTicketsC}}</h4>
{{--                                <p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>--}}
                            </div>
{{--                            <span class="float-right my-auto mr-auto">--}}
{{--										<i class="fas fa-arrow-circle-up text-white"></i>--}}
{{--										<span class="text-white op-7"> 52.09٪</span>--}}
{{--									</span>--}}
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">
                       @foreach($ret['count_ticketsC_month'] as $item)
                        {{$item}},
                    @endforeach
                </span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">تیکت های بسته شده</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$countTicketsR}}</h4>
{{--                                <p class="mb-0 tx-12 text-white op-7">در مقایسه با هفته گذشته</p>--}}
                            </div>
{{--                            <span class="float-right my-auto mr-auto">--}}
{{--										<i class="fas fa-arrow-circle-down text-white"></i>--}}
{{--										<span class="text-white op-7"> -152.3</span>--}}
{{--									</span>--}}
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">
                    @foreach($ret['count_ticketsR_month'] as $item)
                        {{$item}},
                    @endforeach
                </span>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        نمودار تیکت
                    </div>
                    <p class="mg-b-20">نمودار یک ماه اخیر تیکت ها</p>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="chartArea1"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- col-6 -->
        <div class="col-sm-12 col-md-12 col-xl-4 d-none mg-t-20 mg-xl-t-0">
            <div class="main-content-label tx-12 mg-b-15">
                با استفاده از گرادینت
            </div>
            <div class="ht-200 ht-lg-250">
                <canvas id="chartBar3"></canvas>
            </div>
        </div><!-- col-6 -->
        <div class="col-sm-12 col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        نمودار کاربران
                    </div>
                    <p class="mg-b-20">نمودار یک ماه اخیر کاربران</p>
                    <div class="chartjs-wrapper-demo">
                        <canvas id="chartArea2"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- col-6 -->
        <div class="col-sm-12 col-md-12 col-xl-4 d-none mg-t-20 mg-xl-t-0">
            <div class="main-content-label tx-12 mg-b-15">
                با استفاده از گرادینت
            </div>
            <div class="ht-200 ht-lg-250">
                <canvas id="chartBar4"></canvas>
            </div>
        </div><!-- col-6 -->
    </div>
    <!-- row closed -->

@endsection


@section('js')
    <!-- Internal Flot js -->
    <script src="/admin/assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <script>
        var ctx3 = document.getElementById('chartBar3').getContext('2d');
        var gradient = ctx3.createLinearGradient(0, 0, 0, 250);

        var ctx9 = document.getElementById('chartArea1');

        var gradient2 = ctx3.createLinearGradient(0, 280, 0, 0);
        gradient2.addColorStop(0, 'rgba(0,123,255,0)');
        gradient2.addColorStop(1, 'rgba(0,123,255,.3)');

        new Chart(ctx9, {
            type: 'line',
            data: {
                labels:  @json($ret['date']),
                datasets: [{
                    data: @json($ret['count_tickets_month']),
                    borderColor: '#007bff',
                    borderWidth: 1,
                    backgroundColor: gradient2
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10,
                            max: 80,
                            fontColor: "rgb(171, 167, 167,0.9)",
                        },
                        gridLines: {
                            display: true,
                            color: 'rgba(171, 167, 167,0.2)',
                            drawBorder: false
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11,
                            fontColor: "rgb(171, 167, 167,0.9)",
                        },
                        gridLines: {
                            display: true,
                            color: 'rgba(171, 167, 167,0.2)',
                            drawBorder: false
                        },
                    }]
                }
            }
        });















        var ctx4 = document.getElementById('chartBar4').getContext('2d');
        var gradient1 = ctx4.createLinearGradient(0, 0, 0, 250);

        var ctx8 = document.getElementById('chartArea2');

        var gradient3 = ctx4.createLinearGradient(0, 280, 0, 0);
        gradient3.addColorStop(0, 'rgba(247, 85, 122,0)');
        gradient3.addColorStop(1, 'rgba(247, 85, 122,.5)');

        new Chart(ctx8, {
            type: 'line',
            data: {
                labels:  @json($ret['date']),
                datasets: [{
                    data: @json($ret['count_user_month']),
                    borderColor: '#f7557a',
                    borderWidth: 1,
                    backgroundColor: gradient3
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10,
                            max: 80,
                            fontColor: "rgb(171, 167, 167,0.9)",
                        },
                        gridLines: {
                            display: true,
                            color: 'rgba(171, 167, 167,0.2)',
                            drawBorder: false
                        },
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11,
                            fontColor: "rgb(171, 167, 167,0.9)",
                        },
                        gridLines: {
                            display: true,
                            color: 'rgba(171, 167, 167,0.2)',
                            drawBorder: false
                        },
                    }]
                }
            }
        });

    </script>
@endsection
