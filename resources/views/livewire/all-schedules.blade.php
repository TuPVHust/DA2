<div>
    <div class="">
        @foreach (['date'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible fade show ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card col-12" wire:ignore>
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-filter"></i> Bộ lọc</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="max-height: 450px; overflow: auto">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Sắp xếp theo:</label>
                                        <select class="select2_no_delete" style="width: 100%;" id="orderBy"
                                            wire:model='orderBy'>
                                            <option value="date"
                                                {{ $orderBy == 'date' ? 'selected="selected"' : '' }}>Ngày
                                                làm việc</option>
                                            <option value="driverName"
                                                {{ $orderBy == 'driverName' ? 'selected="selected"' : '' }}>Tên tài xế
                                            </option>
                                            <option value="shift"
                                                {{ $orderBy == 'shift' ? 'selected="selected"' : '' }}>Ca
                                                làm việc</option>
                                            <option value="carOwnerName"
                                                {{ $orderBy == 'carOwnerName' ? 'selected="selected"' : '' }}>Tên chủ
                                                xe
                                            </option>
                                            <option value="updated_at"
                                                {{ $orderBy == 'updated_at' ? 'selected="selected"' : '' }}>Ngày cập
                                                nhật
                                            </option>
                                            <option value="truckPlate"
                                                {{ $orderBy == 'truckPlate' ? 'selected="selected"' : '' }}>Biển xe
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Thứ tự:</label>
                                        <select class="select2_no_delete" style="width: 100%;" id="order"
                                            wire:model='order'>
                                            <option selected value="desc">Giảm</option>
                                            <option value="asc">Tăng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Khoảng thời gian:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="timeRangeFilter"
                                                wire:model='timeRange' onchange="handleChangeTimeRange(this);">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Tài xế:</label>
                                        <select class="select2" style="width: 100%;" id="driverFilter"
                                            wire:model='driverFilter'>
                                            <option></option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}"> {{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Xe:</label>
                                        <select class="select2" style="width: 100%;" id="truckFilter"
                                            wire:model='truckFilter'>
                                            <option></option>
                                            @foreach ($trucks as $truck)
                                                <option value="{{ $truck->id }}"> {{ $truck->plate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Chủ xe:</label>
                                        <select class="select2" style="width: 100%;" id="carOwnerFilter"
                                            wire:model='carOwnerFilter'>
                                            <option></option>
                                            @foreach ($car_owners as $car_owner)
                                                <option value="{{ $car_owner->id }}"> {{ $car_owner->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Số chuyến</label>
                                        <input type="number" class="form-control" placeholder="Nhập số chuyến ..."
                                            id="detailNumFilter" wire:model='detailNumFilter'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card col-12">
                <div class="card-header font-size-bold">
                    <h3 class="card-title ">Danh sách lịch trình</h3>
                    <div class="input-group input-group-sm card-tools w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="searchKey">Tìm kiếm</span>
                        </div>
                        <input type="text" class="form-control form-control-sm search" aria-label="Default"
                            aria-describedby="searchKey" wire:model='searchKey'>
                    </div>
                </div>
                <!-- /.card-header -->
                @if ($schedules->count() == 0)
                    <div class="text-center alert mt-5">
                        <h2>Không tìm thấy dữ liệu</h2>
                    </div>
                @else
                    <div class="card-body">
                        <table class="table table-hover table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài xế</th>
                                    <th>Xe</th>
                                    <th>Chuyến</th>
                                    <th>Ngày</th>
                                    <th>Ca</th>
                                    <th>Tiền giao</th>
                                    <th>Chủ xe</th>
                                    <th>Trạng thái</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>{{ $schedule->id }}</td>
                                        <td>{{ $schedule->driver->name }}</td>
                                        <td>{{ $schedule->truck->plate }}</td>
                                        <td>{{ $schedule->schedule_details->count() }}</td>
                                        <td>{{ Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if ($schedule->shift == 1)
                                                <span>Ngày</span>
                                            @else
                                                <span>Đêm</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($schedule->init_money, 0) }}</td>
                                        <td>{{ $schedule->car_owner->name }}</td>
                                        <td>
                                            @if ($schedule->status == 1)
                                                <span class="badge badge-secondary">Waiting</span>
                                            @else
                                                <span class="badge badge-success">Complete</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('boss.schedule.edit', $schedule->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm btndelete"
                                                href="{{ route('boss.schedule.destroy', $schedule->id) }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="expandable-body d-none">
                                        <td colspan="10">
                                            <div class="card-body">
                                                <span class="font-weight-bold">Mô tả</span>:
                                                @if ($schedule->description)
                                                    {!! $schedule->description !!}
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
                                                                        @foreach ($schedule->schedule_details as $schedule_detail)
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
                                                                            <tr class="expandable-body d-none">
                                                                                <td colspan="5">
                                                                                    <div>
                                                                                        <span
                                                                                            class="font-weight-bold">Ghi
                                                                                            chú</span>:@if ($schedule_detail->description)
                                                                                            {{ $schedule_detail->description }}
                                                                                        @else
                                                                                            Không có
                                                                                        @endif
                                                                                    </div>
                                                                                    <div>
                                                                                        <span
                                                                                            class="font-weight-bold">Đơn
                                                                                            hàng</span>:@if ($schedule_detail->order)
                                                                                            {{ $schedule_detail->order->summary }}
                                                                                        @else
                                                                                            Không có
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-6">
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
                                                                                        <div class="col-6">
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
                                                                        @foreach ($schedule->cost_details as $cost_detail)
                                                                            <tr>
                                                                                <td>{{ $cost_detail->id }}</td>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <!-- /.card-body -->
                <div class="container">
                    {{ $schedules->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <script>
        function handleChangeTimeRange(src) {
            Livewire.emit('ChangeTimeRange', src.value);
        }
    </script>
</div>
