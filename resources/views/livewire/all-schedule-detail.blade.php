<div>
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

    <div class="text-right mb-2">
        <a href="{{ route('boss.schedule_detail.create') }}">
            <button class="btn btn-primary">
                Thêm mới
            </button>
        </a>
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
                    <div class="card-body" style="max-height: 500px; overflow: auto">
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
                                            <option value="sellerLoan"
                                                {{ $orderBy == 'sellerLoan' ? 'selected="selected"' : '' }}>Nợ người
                                                bán
                                            </option>
                                            <option value="buyerLoan"
                                                {{ $orderBy == 'buyerLoan' ? 'selected="selected"' : '' }}>Người mua
                                                chịu
                                            </option>
                                            <option value="carOwnerName"
                                                {{ $orderBy == 'carOwnerName' ? 'selected="selected"' : '' }}>Tên chủ
                                                xe
                                            </option>
                                            <option value="schedule_details.updated_at"
                                                {{ $orderBy == 'updated_at' ? 'selected="selected"' : '' }}>Ngày cập
                                                nhật
                                            </option>
                                            <option value="categories.name"
                                                {{ $orderBy == 'truckPlate' ? 'selected="selected"' : '' }}>Loại hàng
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
                                        <label>Loại hàng:</label>
                                        <select class="select2" style="width: 100%;" id="categoryFilter"
                                            wire:model='categoryFilter'>
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mua:</label>
                                        <select class="select2" style="width: 100%;" id="sellerFilter"
                                            wire:model='sellerFilter'>
                                            <option></option>
                                            @foreach ($sellers as $seller)
                                                <option value="{{ $seller->id }}"> {{ $seller->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Bán:</label>
                                        <select class="select2" style="width: 100%;" id="buyerFilter"
                                            wire:model='buyerFilter'>
                                            <option></option>
                                            @foreach ($buyers as $buyer)
                                                <option value="{{ $buyer->id }}"> {{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Đơn hàng:</label>
                                        <select class="select2" style="width: 100%;" id="orderFilter"
                                            wire:model='orderFilter'>
                                            <option></option>
                                            <option value="none"> Không thuộc đơn hàng nào</option>
                                            @foreach ($orders as $order)
                                                <option value="{{ $order->id }}"> {{ $order->summary }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-3">
                            <label>Định dạng lại bảng:</label>
                            <button type="button" class="btn btn-block btn-default"
                                onclick="contentChanged()">Default</button>
                        </div> --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Ẩn cột:</label>
                                        <select class="select2bs4" multiple="multiple"
                                            data-placeholder="Chọn cột muốn ẩn" style="width: 100%;" id="hiden_Colums">
                                            @foreach ($hiddenColums as $key => $value)
                                                <option {{ $value ? 'selected="selected"' : '' }}>
                                                    {{ $key }}
                                                </option>
                                            @endforeach
                                            {{-- <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option> --}}
                                        </select>
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
            <div class="card w-100">
                <div class="card-header">
                    <h3 class="card-title">Danh sách chuyến</h3>
                    <div class="input-group input-group-sm card-tools w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="searchKey">Tìm kiếm</span>
                        </div>
                        <input type="text" class="form-control form-control-sm search" aria-label="Default"
                            aria-describedby="searchKey" wire:model='searchKey'>
                    </div>
                </div>
                @if ($schedule_details->count() == 0)
                    <div class="text-center alert mt-5">
                        <h2>Không tìm thấy dữ liệu</h2>
                    </div>
                @else
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-responsive-sm"
                            id="example{{ $updateNum }}" wire:ignore.self wire:loading.remove>
                            <thead>
                                <tr>
                                    @foreach ($hiddenColums as $key => $value)
                                        @if (!$value)
                                            <th>{{ $key }}</th>
                                        @endif
                                    @endforeach
                                    {{-- <th>Ngày</th>
                                <th>Xe</th>
                                <th>Chủ xe</th>
                                <th>Tài xế</th>
                                <th>Ca</th>
                                <th>Loại hàng</th>
                                <th>Nơi mua</th>
                                <th>Nơi bán</th>
                                <th>Giá mua</th>
                                <th>Giá bán</th>
                                <th>Thực chi</th>
                                <th>Thực thu</th>
                                <th>Đơn hàng</th>
                                <th>Khối lượng</th>
                                <th>Mô tả</th>
                                <th class="text-right">Hành động</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedule_details as $schedule_detail)
                                    <tr>
                                        @if (!$hiddenColums['Ngày'])
                                            <td>{{ Carbon\Carbon::parse($schedule_detail->schedule->date)->format('d-m-Y') }}
                                            </td>
                                        @endif
                                        @if (!$hiddenColums['Xe'])
                                            <td>{{ $schedule_detail->schedule->truck->plate }}</td>
                                        @endif
                                        @if (!$hiddenColums['Chủ xe'])
                                            <td>{{ $schedule_detail->schedule->car_owner->name }}</td>
                                        @endif
                                        @if (!$hiddenColums['Tài xế'])
                                            <td>{{ $schedule_detail->schedule->driver->name }}</td>
                                        @endif
                                        @if (!$hiddenColums['Ca'])
                                            <td>
                                                @if ($schedule_detail->schedule->shift == 1)
                                                    <span>Ngày</span>
                                                @else
                                                    <span>Đêm</span>
                                                @endif
                                            </td>
                                        @endif
                                        @if (!$hiddenColums['Hàng'])
                                            <td>{{ $schedule_detail->category->name }}</td>
                                        @endif
                                        @if (!$hiddenColums['Mua'])
                                            <td>{{ $schedule_detail->seller->name }}</td>
                                        @endif
                                        @if (!$hiddenColums['Bán'])
                                            <td>{{ $schedule_detail->buyer->name }}</td>
                                        @endif
                                        @if (!$hiddenColums['Giá mua'])
                                            <td>{{ number_format($schedule_detail->price, 0) }}</td>
                                        @endif
                                        @if (!$hiddenColums['Giá bán'])
                                            <td>{{ number_format($schedule_detail->revenue, 0) }}</td>
                                        @endif
                                        @if (!$hiddenColums['Thực chi'])
                                            <td>{{ number_format($schedule_detail->actual_price, 0) }}</td>
                                        @endif
                                        @if (!$hiddenColums['Thực thu'])
                                            <td>{{ number_format($schedule_detail->actual_revenue, 0) }}</td>
                                        @endif
                                        @if (!$hiddenColums['Đơn hàng'])
                                            <td>
                                                @if ($schedule_detail->order_id)
                                                    {{ $schedule_detail->order->summary }}
                                                @else
                                                    Không có
                                                @endif
                                            </td>
                                        @endif
                                        @if (!$hiddenColums['K.lượng'])
                                            <td>{{ $schedule_detail->quantity }}</td>
                                        @endif
                                        @if (!$hiddenColums['Mô tả'])
                                            <td>
                                                @if ($schedule_detail->description)
                                                    {!! $schedule_detail->description !!}
                                                @else
                                                    Không có
                                                @endif
                                            </td>
                                        @endif
                                        @if (!$hiddenColums['Hành động'])
                                            <td class="text-right">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('boss.schedule_detail.edit', $schedule_detail->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm btndelete"
                                                    href="{{ route('boss.schedule_detail.destroy', $schedule_detail->id) }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center" wire:loading>
                            <div class="spinner-border" role="status" wire:loading>
                                <span class="sr-only" wire:loading>Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="container w-100 d-flex justify-content-between pl-4 pr-4">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Paginator</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputEmail3" placeholder="Paginator"
                                    wire:model="itemsPerPage">
                            </div>
                        </div>
                        {{-- <input type="text"> --}}
                        <div class="">{{ $schedule_details->links() }}</div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-footer mt-0 sticky-bottom">
                        <span class="badge badge-dark">
                            Hiển thị: {{ $countShowing }}/{{ $total }}</span>
                        <span class="float-right">
                            <span class="badge badge-light">
                                Tổng doanh thu: </span>
                            <span class="badge badge-dark">
                                {{ $sum_revenue }} </span>
                            <span>&#9474;</span>
                            <span class="badge badge-light">
                                Tổng thực thu: </span>
                            <span class="badge badge-dark">
                                {{ $sum_actual_revenue }} </span>
                            <span>&#9474;</span>
                            <span class="badge badge-light">
                                Tổng chi: </span>
                            <span class="badge badge-dark">
                                {{ $sum_price }}</span>
                            <span>&#9474;</span>
                            <span class="badge badge-light">
                                Tổng thực chi: </span>
                            <span class="badge badge-dark">
                                {{ $sum_actual_price }}</span>
                            <span class="m-2"> &bull;</span>
                            <span class="badge badge-light">
                                Đơn vị: Triệu VNĐ </span>
                        </span>
                    </div>
                @endif
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
    <script>
        function handleChangeTimeRange(src) {
            Livewire.emit('ChangeTimeRange', src.value);
        }
    </script>
    <script>
        window.onload = (event) => {
            initTable()
        };

        function initTable() {
            $("#example{{ $updateNum }}").DataTable({
                destroy: true,
                searching: false,
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                select: true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example{{ $updateNum }}_wrapper .col-md-6:eq(0)');
        };
    </script>
</div>
@push('scripts')
@endpush
