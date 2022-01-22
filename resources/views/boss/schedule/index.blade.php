@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Công việc
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .border-5 {
            border-width: 5px !important;
        }

        .border-2 {
            border-width: 2px !important;
        }
    </style>
@endsection
@section('title')
    <h1>Công việc</h1>
@endsection
@section('content')
    <div class="">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible fade show ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
    </div>
    {{-- <div class="text-right mb-2 col-12">
        <a href="{{ route('boss.schedule.create') }}">
            <button class="btn btn-info">
                Thêm mới
            </button>
        </a>
    </div> --}}
    <!-- /.card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <ul class="nav nav-tabs card-header-tabs" class="d-inline">
                            <li class="nav-item">
                                <a class="nav-link font-size-bold" style="color: black" href="#activity"
                                    data-toggle="tab">Hôm
                                    nay</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active font-size-bold" style="color: black" href="#timeline"
                                    data-toggle="tab">Đang chờ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-size-bold" style="color: black" href="#settings"
                                    data-toggle="tab">Tất
                                    cả</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <span class="text-right mb-0">
                        <a href="{{ route('boss.schedule.create') }}">
                            <button class="btn btn-info btn-sm">
                                Thêm mới
                            </button>
                        </a>
                    </span> --}}
                    <div class="card-tools">
                        <a href="{{ route('boss.schedule.create') }}">
                            <button class="btn btn-info btn-sm">
                                Thêm mới
                            </button>
                        </a>
                        {{-- <a href="{{ route('boss.schedule.create') }}" class="btn btn-sm">
                            <i class="fas fa-plus"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            <div class="row">
                                {{-- công việc hôm nay --}}
                                <div class="col-md-6" style="height: 380px">
                                    <div class="card card-info overflow-auto" style="height: 100%">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-shipping-fast"></i> Đang tiến hành
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12" id="accordion">
                                                    @if ($todayDoingSchedules->count() > 0)
                                                        <div class="card card-outline">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($todayDoingSchedules as $todayDoingSchedule)
                                                                <a class="d-block w-100" data-toggle="collapse"
                                                                    href="#completedOne{{ $todayDoingSchedule->id }}"
                                                                    class="collapse">
                                                                    <div class="card-header w-100">
                                                                        <div class="card-title">
                                                                            <button type="button"
                                                                                class="btn btn-sm bg-gray  border border-light color-palette"><i
                                                                                    class="fas fa-truck-moving"></i>
                                                                                {{ $todayDoingSchedule->truck->plate }}</button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-users"></i>
                                                                                {{ $todayDoingSchedule->driver->name }}</button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-adjust"></i>
                                                                                @if ($todayDoingSchedule->shift == 1)
                                                                                    <span>Ngày</span>
                                                                                @else
                                                                                    <span>Đêm</span>
                                                                                @endif
                                                                            </button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-dollar-sign"></i>
                                                                                {{ number_format($todayDoingSchedule->init_money, 0) }}</button>
                                                                        </div>
                                                                        <div class="card-tools">
                                                                            @if ($todayDoingSchedule->schedule_details)
                                                                                <a class="btn btn-tool btn-link"
                                                                                    data-toggle="collapse"
                                                                                    href="#completedOne{{ $todayDoingSchedule->id }}">#{{ $todayDoingSchedule->schedule_details->count() }}</a>
                                                                            @endif
                                                                            <a href="{{ route('boss.schedule.edit', $todayDoingSchedule->id) }}"
                                                                                class="btn btn-tool">
                                                                                <i class="fas fa-pen"></i>
                                                                            </a>
                                                                            <a href="{{ route('boss.schedule.destroy', $todayDoingSchedule->id) }}"
                                                                                class="btn btn-tool btndelete">
                                                                                <i class="fas fa-trash">
                                                                                </i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div id="completedOne{{ $todayDoingSchedule->id }}"
                                                                    class="collapse">
                                                                    <div class="card-body">
                                                                        <span class="font-weight-bold">Mô tả</span>:
                                                                        @if ($todayDoingSchedule->description)
                                                                            {!! $todayDoingSchedule->description !!}
                                                                        @else
                                                                            không có
                                                                        @endif
                                                                        <div class="row mt-3">
                                                                            <div class="col-12">
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h3 class="card-title">Chuyến đã
                                                                                            hoàn thành</h3>
                                                                                    </div>
                                                                                    <!-- ./card-header -->
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-sm">
                                                                                            <thead class="thead-light">
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Loại</th>
                                                                                                    <th>Mua</th>
                                                                                                    <th>Bán</th>
                                                                                                    <th>Lượng</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($todayDoingSchedule->schedule_details as $schedule_detail)
                                                                                                    <tr data-widget="expandable-table"
                                                                                                        aria-expanded="false">
                                                                                                        <td>{{ $schedule_detail->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->category->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->seller->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->buyer->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->quantity }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr
                                                                                                        class="expandable-body">
                                                                                                        <td colspan="5">
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Ghi
                                                                                                                    chú</span>:{!! $schedule_detail->description !!}
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Đơn
                                                                                                                    hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="row">
                                                                                                                <div
                                                                                                                    class="col-6">
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Bán</span>:
                                                                                                                        {{ number_format($schedule_detail->revenue, 0) }}
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Mua</span>:
                                                                                                                        {{ number_format($schedule_detail->price, 0) }}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-6">
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Thực
                                                                                                                            Thu</span>:
                                                                                                                        {{ number_format($schedule_detail->actual_revenue, 0) }}
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Thực
                                                                                                                            Chi</span>:
                                                                                                                        {{ number_format($schedule_detail->actual_price, 0) }}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- Kết thúc bẳng chuyến --}}
                                                                                {{-- bắt đầu bảng chi phí --}}
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h3 class="card-title">Chi phí
                                                                                        </h3>
                                                                                    </div>
                                                                                    <!-- ./card-header -->
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-sm">
                                                                                            <thead class="thead-light">
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Loại</th>
                                                                                                    <th>Giá</th>
                                                                                                    <th>Thực chi</th>
                                                                                                    <th>Mô Tả</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($todayDoingSchedule->cost_details as $cost_detail)
                                                                                                    <tr data-widget="expandable-table"
                                                                                                        aria-expanded="false">
                                                                                                        <td>{{ $cost_detail->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $cost_detail->cost_group->name }}
                                                                                                        </td>
                                                                                                        <td>{{ number_format($cost_detail->cost, 0) }}
                                                                                                        </td>
                                                                                                        <td>{{ number_format($cost_detail->actual_cost, 0) }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {!! $cost_detail->description !!}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <!-- /.card-body -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <h5>Không có công việc nào hôm nay</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                {{-- Đã hoàn thành hôm nay --}}
                                <div class="col-md-6" style="height: 380px">
                                    <div class="card card-success overflow-auto" style="height: 100%">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="far fa-check-circle"></i> Hoàn thành</h3>
                                        </div>
                                        <div class="card-body">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-12" id="accordion">
                                                    @if ($todayCompltedSchedules->count() > 0)
                                                        <div class="card card-success card-outline">
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($todayCompltedSchedules as $todayCompltedSchedule)
                                                                <a class="d-block w-100" data-toggle="collapse"
                                                                    href="#collapseOne{{ $todayCompltedSchedule->id }}">
                                                                    <div class="card-header w-100">
                                                                        <div class="card-title">
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-truck-moving"></i>
                                                                                {{ $todayCompltedSchedule->truck->plate }}</button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-users"></i>
                                                                                {{ $todayCompltedSchedule->driver->name }}</button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-adjust"></i>
                                                                                @if ($todayCompltedSchedule->shift == 1)
                                                                                    <span>Ngày</span>
                                                                                @else
                                                                                    <span>Đêm</span>
                                                                                @endif
                                                                            </button>
                                                                            <button type="button"
                                                                                class="btn bg-gray color-palette btn-sm"><i
                                                                                    class="fas fa-dollar-sign"></i>
                                                                                {{ number_format($todayCompltedSchedule->init_money, 0) }}</button>
                                                                        </div>
                                                                        <div class="card-tools">
                                                                            @if ($todayCompltedSchedule->schedule_details)
                                                                                <a class=" btn btn-tool btn-link "
                                                                                    data-toggle="collapse"
                                                                                    href="#collapseOne{{ $todayCompltedSchedule->id }}">#{{ $todayCompltedSchedule->schedule_details->count() }}</a>
                                                                            @endif
                                                                            <a href="{{ route('boss.schedule.edit', $todayCompltedSchedule->id) }}"
                                                                                class="btn btn-tool">
                                                                                <i class="fas fa-pen"></i>
                                                                            </a>
                                                                            <a href="{{ route('boss.schedule.destroy', $todayCompltedSchedule->id) }}"
                                                                                class="btn btn-tool btndelete">
                                                                                <i class="fas fa-trash">
                                                                                </i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div id="collapseOne{{ $todayCompltedSchedule->id }}"
                                                                    class="collapse card-body">
                                                                    <div class="card-body">
                                                                        <span class="font-weight-bold">Mô tả</span>:
                                                                        @if ($todayCompltedSchedule->description)
                                                                            {!! $todayCompltedSchedule->description !!}
                                                                        @else
                                                                            không có
                                                                        @endif
                                                                        <div class="row mt-3">
                                                                            <div class="col-12">
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h3 class="card-title">Chuyến
                                                                                            đã
                                                                                            hoàn thành</h3>
                                                                                    </div>
                                                                                    <!-- ./card-header -->
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-sm">
                                                                                            <thead class="thead-light">
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Loại</th>
                                                                                                    <th>Mua</th>
                                                                                                    <th>Bán</th>
                                                                                                    <th>Lượng</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($todayCompltedSchedule->schedule_details as $schedule_detail)
                                                                                                    <tr data-widget="expandable-table"
                                                                                                        aria-expanded="false">
                                                                                                        <td>{{ $schedule_detail->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->category->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->seller->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->buyer->name }}
                                                                                                        </td>
                                                                                                        <td>{{ $schedule_detail->quantity }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr
                                                                                                        class="expandable-body">
                                                                                                        <td colspan="5">
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Ghi
                                                                                                                    chú</span>:{!! $schedule_detail->description !!}
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Đơn
                                                                                                                    hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="row">
                                                                                                                <div
                                                                                                                    class="col-6">
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Bán</span>:
                                                                                                                        {{ number_format($schedule_detail->revenue, 0) }}
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Mua</span>:
                                                                                                                        {{ number_format($schedule_detail->price, 0) }}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col-6">
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Thực
                                                                                                                            Thu</span>:
                                                                                                                        {{ number_format($schedule_detail->actual_revenue, 0) }}
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <span
                                                                                                                            class="font-weight-bold">Thực
                                                                                                                            Chi</span>:
                                                                                                                        {{ number_format($schedule_detail->actual_price, 0) }}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- Kết thúc bẳng chuyến --}}
                                                                                {{-- bắt đầu bảng chi phí --}}
                                                                                <div class="card">
                                                                                    <div class="card-header">
                                                                                        <h3 class="card-title">Chi phí
                                                                                        </h3>
                                                                                    </div>
                                                                                    <!-- ./card-header -->
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-bordered table-hover table-sm">
                                                                                            <thead class="thead-light">
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Loại</th>
                                                                                                    <th>Giá</th>
                                                                                                    <th>Thực chi</th>
                                                                                                    <th>Mô Tả</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($todayCompltedSchedule->cost_details as $cost_detail)
                                                                                                    <tr data-widget="expandable-table"
                                                                                                        aria-expanded="false">
                                                                                                        <td>{{ $cost_detail->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $cost_detail->cost_group->name }}
                                                                                                        </td>
                                                                                                        <td>{{ number_format($cost_detail->cost, 0) }}
                                                                                                        </td>
                                                                                                        <td>{{ number_format($cost_detail->actual_cost, 0) }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {!! $cost_detail->description !!}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <!-- /.card-body -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <h5>Chưa hoàn thành công việc nào hôm nay</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        {{-- Today schedule end --}}




                        {{-- waiting schedule begin --}}
                        <div class="tab-pane active" id="timeline" style="height: 380px">
                            <div class="card card-secondary overflow-auto" style="height: 100%">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="far fa-clock"></i> Đang chờ </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12" id="accordion">
                                            @if ($inQueueSchedules->count() > 0)
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($inQueueSchedules as $inQueueSchedule)
                                                    <div class="card ">
                                                        <a class="d-inline w-80" data-toggle="collapse"
                                                            href="#waitingOne{{ $inQueueSchedule->id }}">
                                                            <div
                                                                class="card-header border-left border-warning border-bottom-0 border-5">
                                                                <h4 class="card-title">
                                                                    {{-- <span class="badge badge-info letf">2</span> --}}
                                                                    {{-- {{ $i }}. --}}
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"><i
                                                                            class="fas fa-truck-moving"></i>
                                                                        {{ $inQueueSchedule->truck->plate }}</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"><i
                                                                            class="fas fa-users"></i>
                                                                        {{ $inQueueSchedule->driver->name }}</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"><i
                                                                            class="fas fa-adjust"></i>
                                                                        @if ($inQueueSchedule->shift == 1)
                                                                            <span>Ngày</span>
                                                                        @else
                                                                            <span>Đêm</span>
                                                                        @endif
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"><i
                                                                            class="fas fa-dollar-sign"></i>
                                                                        {{ number_format($inQueueSchedule->init_money, 0) }}</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary btn-sm"><i
                                                                            class="far fa-calendar-alt"></i>
                                                                        {{ Carbon\Carbon::parse($inQueueSchedule->date)->format('d-m-Y') }}</button>
                                                                    {{-- <button
                                                                        onclick="location.href='{{ route('boss.schedule.edit', $inQueueSchedule->id) }}'"
                                                                        type="button"
                                                                        class="btn btn-secondary float-right btn-sm"><i
                                                                            class="fas fa-edit"></i>
                                                                    </button> --}}
                                                                </h4>
                                                                <div class="card-tools">
                                                                    @if ($inQueueSchedule->schedule_details)
                                                                        <a class="btn btn-tool btn-link"
                                                                            data-toggle="collapse"
                                                                            href="#waitingOne{{ $inQueueSchedule->id }}">#{{ $inQueueSchedule->schedule_details->count() }}</a>
                                                                    @endif
                                                                    <a href="{{ route('boss.schedule.edit', $inQueueSchedule->id) }}"
                                                                        class="btn btn-tool">
                                                                        <i class="fas fa-pen"></i>
                                                                    </a>
                                                                    <a href="{{ route('boss.schedule.destroy', $inQueueSchedule->id) }}"
                                                                        class="btn btn-tool btndelete">
                                                                        <i class="fas fa-trash ">
                                                                        </i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div id="waitingOne{{ $inQueueSchedule->id }}"
                                                            class="collapse">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <span class="col-12">
                                                                        <span class="font-weight-bold">Mô tả</span>:
                                                                        @if ($inQueueSchedule->description)
                                                                            {!! $inQueueSchedule->description !!}
                                                                        @else
                                                                            Lorem ipsum dolor sit amet, consectetuer
                                                                            adipiscing elit. Aenean commodo ligula eget
                                                                            dolor. Aenean massa. Cum sociis natoque
                                                                            penatibus et magnis dis parturient montes,
                                                                            nascetur ridiculus mus.
                                                                        @endif
                                                                    </span>
                                                                    {{-- <span class="col-2 text-right">
                                                                        <a class="btn btn-info btn-sm"
                                                                        href="{{ route('boss.schedule.edit', $inQueueSchedule->id) }}">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm btndelete"
                                                                        href="{{ route('boss.schedule.destroy', $inQueueSchedule->id) }}">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                    </span> --}}
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title">Chuyến đã
                                                                                    hoàn thành</h3>
                                                                            </div>
                                                                            <!-- ./card-header -->
                                                                            <div class="card-body">
                                                                                <table
                                                                                    class="table table-bordered table-hover table-sm">
                                                                                    <thead class="thead-light">
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Loại</th>
                                                                                            <th>Mua</th>
                                                                                            <th>Bán</th>
                                                                                            <th>Lượng</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($inQueueSchedule->schedule_details as $schedule_detail)
                                                                                            <tr data-widget="expandable-table"
                                                                                                aria-expanded="false">
                                                                                                <td>{{ $schedule_detail->id }}
                                                                                                </td>
                                                                                                <td>{{ $schedule_detail->category->name }}
                                                                                                </td>
                                                                                                <td>{{ $schedule_detail->seller->name }}
                                                                                                </td>
                                                                                                <td>{{ $schedule_detail->buyer->name }}
                                                                                                </td>
                                                                                                <td>{{ $schedule_detail->quantity }}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="expandable-body">
                                                                                                <td colspan="5">
                                                                                                    <div>
                                                                                                        <span
                                                                                                            class="font-weight-bold">Ghi
                                                                                                            chú</span>:{!! $schedule_detail->description !!}
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <span
                                                                                                            class="font-weight-bold">Đơn
                                                                                                            hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="row">
                                                                                                        <div
                                                                                                            class="col-6">
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Bán</span>:
                                                                                                                {{ number_format($schedule_detail->revenue, 0) }}
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Mua</span>:
                                                                                                                {{ number_format($schedule_detail->price, 0) }}
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-6">
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Thực
                                                                                                                    Thu</span>:
                                                                                                                {{ number_format($schedule_detail->actual_revenue, 0) }}
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <span
                                                                                                                    class="font-weight-bold">Thực
                                                                                                                    Chi</span>:
                                                                                                                {{ number_format($schedule_detail->actual_price, 0) }}
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        {{-- Kết thúc bẳng chuyến --}}
                                                                        {{-- bắt đầu bảng chi phí --}}
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title">Chi phí
                                                                                </h3>
                                                                            </div>
                                                                            <!-- ./card-header -->
                                                                            <div class="card-body">
                                                                                <table
                                                                                    class="table table-bordered table-hover table-sm">
                                                                                    <thead class="thead-light">
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Loại</th>
                                                                                            <th>Giá</th>
                                                                                            <th>Thực chi</th>
                                                                                            <th>Mô Tả</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($inQueueSchedule->cost_details as $cost_detail)
                                                                                            <tr data-widget="expandable-table"
                                                                                                aria-expanded="false">
                                                                                                <td>{{ $cost_detail->id }}
                                                                                                </td>
                                                                                                <td>{{ $cost_detail->cost_group->name }}
                                                                                                </td>
                                                                                                <td>{{ number_format($cost_detail->cost, 0) }}
                                                                                                </td>
                                                                                                <td>{{ number_format($cost_detail->actual_cost, 0) }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    {!! $cost_detail->description !!}
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <!-- /.card-body -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                            @else
                                                <h5>Không có công việc nào trong hàng đợi</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        {{-- Wating schedule end --}}



                        {{-- All schedule begin --}}
                        <div class="tab-pane" id="settings">
                            @livewire('all-schedules')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card-header -->
    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
@endsection
@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('bossUI') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                select: true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
        });
    </script>
    <script>
        $(".btndelete").click(function(ev) {
            ev.preventDefault();
            let _href = $(this).attr('href');
            $("form#formdelete").attr('action', _href);
            if (confirm('Bạn muốn xóa bản ghi này không?')) {
                $("form#formdelete").submit();
            }
        });
    </script>
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn để lọc",
                allowClear: true
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2_no_delete').select2({
                placeholder: "Chọn để lọc",
            })
        });
    </script>
    <script>
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        $('#reservation').daterangepicker()
    </script>
@endsection
