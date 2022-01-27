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
        <a href="{{ route('boss.order.create') }}">
            <button class="btn btn-primary">
                Thêm mới
            </button>
        </a>
    </div> 
        <div class="row">
            <div class="card col-12" wire:ignore>
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-filter"></i> Bộ lọc</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sắp xếp theo:</label>
                                    <select class="select2_no_delete" style="width: 100%;" id="orderBy"
                                        wire:model='orderBy'>
                                        <option value="date" {{ $orderBy == 'date' ? 'selected="selected"' : '' }}>Ngày làm việc</option>
                                        <option value="driverName" {{ $orderBy == 'driverName' ? 'selected="selected"' : '' }}>Tên tài xế</option>
                                        <option value="detailNum" {{ $orderBy == 'detailNum' ? 'selected="selected"' : '' }}>Số chuyến</option>
                                        <option value="shift" {{ $orderBy == 'shift' ? 'selected="selected"' : '' }}>Ca làm việc</option>
                                        <option value="carOwnerName" {{ $orderBy == 'carOwnerName' ? 'selected="selected"' : '' }}>Tên chủ xe</option>
                                        <option value="updated_at" {{ $orderBy == 'updated_at' ? 'selected="selected"' : '' }}>Ngày cập nhật</option>
                                        <option value="init_money" {{ $orderBy == 'init_money' ? 'selected="selected"' : '' }}>Tiền giao</option>
                                        <option value="status" {{ $orderBy == 'status' ? 'selected="selected"' : '' }}>Trạng thái</option>
                                        <option value="truckPlate" {{ $orderBy == 'truckPlate' ? 'selected="selected"' : '' }}>Biển xe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Thứ tự:</label>
                                    <select class="select2_no_delete" style="width: 100%;" id="order" wire:model='order'>
                                        <option selected value="desc">Giảm</option>
                                        <option value="asc">Tăng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Khoảng thời gian:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="timeRangeFilter"
                                            wire:model='timeRange' onchange="handleChangeTiemRange(this);">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Tài xế:</label>
                                    <select class="select2" style="width: 100%;" id="driverFilter" wire:model='driverFilter'>
                                        <option></option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"> {{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Xe:</label>
                                    <select class="select2" style="width: 100%;" id="truckFilter" wire:model='truckFilter'>
                                        <option></option>
                                        @foreach ($trucks as $truck)
                                            <option value="{{ $truck->id }}"> {{ $truck->plate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Chủ xe:</label>
                                    <select class="select2" style="width: 100%;" id="carOwnerFilter" wire:model='carOwnerFilter'>
                                        <option></option>
                                        @foreach ($car_owners as $car_owner)
                                            <option value="{{ $car_owner->id }}"> {{ $car_owner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Loại hàng:</label>
                                    <select class="select2" style="width: 100%;" id="categoryFilter" wire:model='categoryFilter'>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Mua:</label>
                                    <select class="select2" style="width: 100%;" id="sellerFilter" wire:model='sellerFilter'>
                                        <option></option>
                                        @foreach ($sellers as $seller)
                                            <option value="{{ $seller->id }}"> {{ $seller->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Bán:</label>
                                    <select class="select2" style="width: 100%;" id="buyerFilter" wire:model='buyerFilter'>
                                        <option></option>
                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->id }}"> {{ $buyer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Đơn hàng:</label>
                                    <select class="select2" style="width: 100%;" id="orderFilter" wire:model='orderFilter'>
                                        <option></option>
                                        <option value="none"> Không thuộc đơn hàng nào</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}"> {{ $order->summary }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Multiple</label>
                                    <select class="select2bs4" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" id="hiden_Colums">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            @if ($schedule_details->count() == 0)
            <div class="text-center alert mt-5"><h2 >Không tìm thấy dữ liệu</h2></div>
            @else
                <div class="card col-12">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đối tác</h3>
                        <div class="input-group input-group-sm card-tools w-50">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="searchKey">Tìm kiếm</span>
                            </div>
                            <input type="text" class="form-control form-control-sm search" aria-label="Default"
                                aria-describedby="searchKey" wire:model='searchKey'>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>Ngày</th>
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
                                    <th class="text-right">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedule_details as $schedule_detail)
                                    <tr>
                                        <td>{{ Carbon\Carbon::parse($schedule_detail->schedule->date)->format('d-m-Y') }}</td>
                                        <td>{{ $schedule_detail->schedule->truck->plate }}</td>
                                        <td>{{ $schedule_detail->schedule->car_owner->name }}</td>
                                        <td>{{ $schedule_detail->schedule->driver->name }}</td>
                                        <td>
                                            @if ($schedule_detail->schedule->shift == 1)
                                                <span>Ngày</span>
                                            @else
                                                <span>Đêm</span>
                                            @endif
                                        </td>
                                        <td>{{ $schedule_detail->category->name }}</td>
                                        <td>{{$schedule_detail->seller->name}}</td>
                                        <td>{{$schedule_detail->buyer->name}}</td>
                                        <td>{{number_format($schedule_detail->price, 0)}}</td>
                                        <td>{{number_format($schedule_detail->revenue, 0)}}</td>
                                        <td>{{number_format($schedule_detail->actual_price, 0)}}</td>
                                        <td>{{ number_format($schedule_detail->actual_revenue, 0) }}</td>
                                        <td>@if($schedule_detail->order_id) {{$schedule_detail->order->summary}}@else Không có @endif</td>
                                        <td>{{$schedule_detail->quantity}}</td>
                                        <td>{!! $schedule_detail->description !!}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
        </div>
    @endif
    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
</div>
