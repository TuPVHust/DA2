<div class="container-fluid h-100 ">
    <div class="card card-row card-default">
        <div class="card-header bg-info">
            <h3 class="card-title">
                In Progress
            </h3>
        </div>
        <div class="card-body">
            @if ($todayDoingSchedules->count() > 0)
                @foreach ($todayDoingSchedules as $todayDoingSchedule)
                    <div @class([
                        'card',
                        'card-outline',
                        'text-muted',
                        'card-info',
                        // 'card-secondary' => $todayDoingSchedule->date > Carbon\Carbon::now(),
                        // 'card-warning' => $todayDoingSchedule->date < Carbon\Carbon::now(),
                    ])>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h5>
                                        <span class="badge badge-light text-muted"><i class="fas fa-truck-moving"></i>
                                            {{ $todayDoingSchedule->truck->plate }}</span>
                                        <p class="float-right"><span @class([
                                            'badge',
                                            'text-muted',
                                            'badge-light',
                                            // 'badge-light' => $todayDoingSchedule->shift == 1,
                                            // 'badge-dark' => $todayDoingSchedule->shift == 0,
                                        ])>
                                                @if ($todayDoingSchedule->shift == 1)
                                                    <span>Ngày</span>
                                                @else
                                                    <span>Đêm</span>
                                                @endif
                                            </span> <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                            <span
                                                class="badge badge-light text-muted">{{ Carbon\Carbon::parse($todayDoingSchedule->date)->format('d-m-Y') }}</span>
                                        </p>
                                    </h5>
                                </div>
                                <!-- /.col -->
                            </div>
                            <hr>
                            <dl>
                                <dt>Mô tả</dt>
                                @if ($todayDoingSchedule->description)
                                    <p style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                        line-clamp: 1; 
                                -webkit-box-orient: vertical;">{!! $todayDoingSchedule->description !!}</p>
                                @else
                                    Không có
                                @endif
                            </dl>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-info btn-xs"
                                        onclick='handleClick({{ $todayDoingSchedule->id }});'>Hoàn thành</button>
                                </div>
                                <div><a href="#" class="btn btn-tool btn-link"><i
                                            class="fas fa-truck-loading fa-xs"></i>
                                        {{ $todayDoingSchedule->schedule_details->count() }}</a>

                                    <a href="#" class="btn btn-tool btn-link"><i class="fas fa-dollar-sign fa-xs"></i>
                                        {{ $todayDoingSchedule->cost_details->count() }}</a>
                                    <a href="#" class="btn btn-tool" data-toggle="modal"
                                        data-target="#exampleModal{{ $todayDoingSchedule->id }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade scheduleInforModal" id="exampleModal{{ $todayDoingSchedule->id }}"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-xl overflow-auto" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN LỊCH TRÌNH
                                </div>
                                <div class="modal-body">
                                    <div class="card card-primary card-outline card-outline-tabs">
                                        <div class="card-header p-0 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a @class(['nav-link', 'active' => !$activeCost]) id="custom-tabs-four-home-tab"
                                                        data-toggle="tab"
                                                        href="#custom-tabs-four-home{{ $todayDoingSchedule->id }}"
                                                        role="tab"
                                                        aria-controls="custom-tabs-four-home{{ $todayDoingSchedule->id }}"
                                                        aria-selected="true"
                                                        wire:click="changeTab">Chuyến({{ $todayDoingSchedule->schedule_details->count() }})</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a @class(['nav-link', 'active' => $activeCost]) id="custom-tabs-four-profile-tab"
                                                        data-toggle="tab"
                                                        href="#custom-tabs-four-profile{{ $todayDoingSchedule->id }}"
                                                        role="tab" aria-controls="custom-tabs-four-profile"
                                                        aria-selected="false" wire:click="changeTab">Chí
                                                        phí({{ $todayDoingSchedule->cost_details->count() }})</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                                <div @class([
                                                    'tab-pane fade',
                                                    'show active' => !$activeCost,
                                                ])
                                                    id="custom-tabs-four-home{{ $todayDoingSchedule->id }}"
                                                    role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                    <div class="">
                                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                            @if (Session::has('alert-' . $msg))
                                                                <div
                                                                    class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">&times;</button>
                                                                    {{ Session::get('alert-' . $msg) }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-light btn-sm collapsed"
                                                                    wire:click="toggleAddForm">
                                                                    Thêm chuyến
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo{{ $todayDoingSchedule->id }}"
                                                            @class(['d-none' => !$showAddForm])
                                                            aria-labelledby="headingTwo{{ $todayDoingSchedule->id }}">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <div class="form-group mb-0" wire:ignore>
                                                                            <label>Mua:</label>
                                                                            <select class="select2 select2-seller"
                                                                                style="width: 100%;" name="seller"
                                                                                wire:model='seller'>
                                                                                <option
                                                                                    {{ !$seller ? 'selected="selected"' : '' }}>
                                                                                </option>
                                                                                @foreach ($sellers as $seller)
                                                                                    <option value="{{ $seller->id }}"
                                                                                        @if (old('seller') and old('seller') == $seller->id) selected = 'selected' @endif>
                                                                                        {{ $seller->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('seller')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group mb-0" wire:ignore>
                                                                            <label>Bán:</label>
                                                                            <select class="select2 select2-buyer"
                                                                                style="width: 100%;" name="buyer"
                                                                                wire:model='buyer'>
                                                                                <option></option>
                                                                                @foreach ($buyers as $buyer)
                                                                                    <option value="{{ $buyer->id }}"
                                                                                        @if (old('buyer') and old('buyer') == $buyer->id) selected = 'selected' @endif>
                                                                                        {{ $buyer->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('buyer')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group mb-0" wire:ignore>
                                                                            <label>Đơn hàng:</label>
                                                                            <select class="select2 select2-order"
                                                                                style="width: 100%;" name="order"
                                                                                wire:model='order'>
                                                                                <option></option>
                                                                                <option value='none'> Không thuộc
                                                                                    đơn hàng nào</option>
                                                                                @foreach ($orders as $order)
                                                                                    <option value="{{ $order->id }}"
                                                                                        @if (old('order') and old('order') == $order->id) selected = 'selected' @endif>
                                                                                        {{ $order->summary }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('order')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group mb-0" wire:ignore>
                                                                            <label>Loại hàng:</label>
                                                                            <select class="select2 select2-category"
                                                                                style="width: 100%;" name="category"
                                                                                wire:model='category'>
                                                                                <option></option>
                                                                                @foreach ($categories as $category)
                                                                                    <option
                                                                                        value="{{ $category->id }}"
                                                                                        @if (old('category') and old('category') == $category->id) selected = 'selected' @endif>
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('category')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Giá</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập giá ..." name="price"
                                                                                @if (old('price')) value="{{ old('price') }}" @else  @endif
                                                                                wire:model='price'>
                                                                            @error('price')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Thực chi</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập tiền thực thu ..."
                                                                                name="actual_price"
                                                                                @if (old('actual_price')) value="{{ old('actual_price') }}" @else  @endif
                                                                                wire:model='actual_price'>
                                                                            @error('actual_price')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Thu</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập doanh thu ..."
                                                                                name="revenue" @if (old('revenue')) value="{{ old('revenue') }}" @else  @endif
                                                                                wire:model='revenue'>
                                                                            @error('revenue')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Thực thu</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập tiền thực thu ..."
                                                                                name="actual_revenue"
                                                                                @if (old('actual_revenue')) value="{{ old('actual_revenue') }}" @else  @endif
                                                                                wire:model='actual_revenue'>
                                                                            @error('actual_revenue')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Khối lượng</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập khối lượng hàng ..."
                                                                                name="quantity" @if (old('quantity')) value="{{ old('quantity') }}" @else @endif
                                                                                wire:model='quantity'>
                                                                            @error('quantity')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="form-group">
                                                                            <label>Quãng đường</label>
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Nhập quãng đường di chuyển ..."
                                                                                name="distance" @if (old('distance')) value="{{ old('distance') }}" @else @endif
                                                                                wire:model='distance'>
                                                                            @error('distance')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="summernote">Mô tả chuyến vừa hoàn
                                                                        thành (không bắt buộc)</label>
                                                                    <textarea name="description"
                                                                        class="form-control summernoteAdd"
                                                                        wire:model='scheDetDescription'></textarea>
                                                                    @error('summernote')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="w-100">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm float-right"
                                                                        onclick='addScheduleDetail({{ $todayDoingSchedule->id }})'>Thêm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Danh sách chuyến</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Loại</th>
                                                                        <th>Mua</th>
                                                                        <th>Bán</th>
                                                                        <th>Lượng</th>
                                                                        <th>Hành động</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($todayDoingSchedule->schedule_details as $schedule_detail)
                                                                        <tr data-widget="expandable-table"
                                                                            aria-expanded="true">
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
                                                                            <td class="text-right">
                                                                                {{-- <a class="btn btn-primary btn-sm" href="#">
                                                                                    <i class="fas fa-folder">
                                                                                    </i>
                                                                                    View
                                                                                </a> --}}
                                                                                <a class="btn btn-info btn-sm"
                                                                                    href="javascript:void(0)"
                                                                                    wire:click="editScheDeatail({{ $schedule_detail }})">
                                                                                    <i class="fas fa-pencil-alt">
                                                                                    </i>
                                                                                    Edit
                                                                                </a>
                                                                                <a class="btn btn-danger btn-sm btndelete"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="handleDeleteScheDetail({{ $schedule_detail->id }});">
                                                                                    <i class="fas fa-trash">
                                                                                    </i>
                                                                                    Delete
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="expandable-body">
                                                                            <td colspan="6">
                                                                                <div>
                                                                                    <span class="font-weight-bold">Ghi
                                                                                        chú</span>:@if ($schedule_detail->description) {{ $schedule_detail->description }} @else Không có @endif
                                                                                    <br>
                                                                                    <span class="font-weight-bold">Đơn
                                                                                        hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
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
                                                        <!-- /.card-body -->
                                                        {{-- <div class="card-footer clearfix">

                                                            </div> --}}
                                                    </div>
                                                </div>
                                                <div @class(['tab-pane', 'show active' => $activeCost])
                                                    id="custom-tabs-four-profile{{ $todayDoingSchedule->id }}"
                                                    role="tabpanel"
                                                    aria-labelledby="custom-tabs-four-profile-tab{{ $todayDoingSchedule->id }}">
                                                    {{-- add form --}}
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-light btn-sm collapsed"
                                                                    wire:click="toggleAddForm">
                                                                    Thêm chi phí
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo{{ $todayDoingSchedule->id }}"
                                                            @class(['d-none' => !$showAddForm])
                                                            aria-labelledby="headingTwo{{ $todayDoingSchedule->id }}">
                                                            @livewire('cost-detail-add-form',['todayDoingSchedule'=>
                                                            $todayDoingSchedule],key($todayDoingSchedule->id))
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                            @if (Session::has('alert-' . $msg))
                                                                <div
                                                                    class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">&times;</button>
                                                                    {{ Session::get('alert-' . $msg) }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    {{-- end add form --}}
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Danh sách chi phí</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Loại</th>
                                                                        <th>Giá</th>
                                                                        <th>Thực chi</th>
                                                                        <th>Mô Tả</th>
                                                                        <th>Hành động</th>
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
                                                                            <td class="text-right">
                                                                                {{-- <a class="btn btn-primary btn-sm" href="#">
                                                                                    <i class="fas fa-folder">
                                                                                    </i>
                                                                                    View
                                                                                </a> --}}
                                                                                <a class="btn btn-info btn-sm"
                                                                                    href="javascript:void(0)"
                                                                                    wire:click="editCostDeatail({{ $cost_detail }})">
                                                                                    <i class="fas fa-pencil-alt">
                                                                                    </i>
                                                                                    Edit
                                                                                </a>
                                                                                <a class="btn btn-danger btn-sm btndelete"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="handleDeleteCostDetail({{ $cost_detail->id }});">
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
                                                        {{-- <div class="card-footer clearfix">
                                                                
                                                            </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button class="btn btn-success"
                                        onclick='handleClick({{ $todayDoingSchedule->id }});'>Hoàn
                                        thành</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row ">
                    <div class="col-12 d-flex align-items-center">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Không có công việc nào</span>
                                <span class="info-box-number text-center text-muted mb-0"><i
                                        class="fas fa-folder-open"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card card-row card-success">
        <div class="card-header">
            <h3 class="card-title">
                Done
            </h3>
        </div>
        <div class="card-body">
            @if ($todayCompltedSchedules->count() > 0)
                @foreach ($todayCompltedSchedules as $todayCompltedSchedule)
                    <div @class([
                        'card',
                        'text-muted',
                        'card-outline',
                        'card-success',
                        // 'card-secondary' => $todayCompltedSchedule->date > Carbon\Carbon::now(),
                        // 'card-warning' => $todayCompltedSchedule->date < Carbon\Carbon::now(),
                    ])>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h5>
                                        <span class="badge badge-light text-muted"><i class="fas fa-truck-moving"></i>
                                            {{ $todayCompltedSchedule->truck->plate }}</span>
                                        <p class="float-right"><span @class([
                                            'badge',
                                            'badge-light',
                                            'text-muted',
                                            // 'badge-light' => $todayCompltedSchedule->shift == 1,
                                            // 'badge-dark' => $todayCompltedSchedule->shift == 0,
                                        ])>
                                                @if ($todayCompltedSchedule->shift == 1)
                                                    <span>Ngày</span>
                                                @else
                                                    <span>Đêm</span>
                                                @endif
                                            </span> <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                            <span
                                                class="badge badge-light text-muted">{{ Carbon\Carbon::parse($todayCompltedSchedule->date)->format('d-m-Y') }}</span>
                                        </p>
                                    </h5>
                                </div>
                                <!-- /.col -->
                            </div>
                            <hr>
                            <dl>
                                <dt>Mô tả</dt>
                                @if ($todayCompltedSchedule->description)
                                    <p style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                        line-clamp: 1; 
                                -webkit-box-orient: vertical;">{!! $todayCompltedSchedule->description !!}</p>
                                @else
                                    Không có
                                @endif
                            </dl>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="badge badge-success">
                                    Đã hoàn thành</span>
                                <div><a href="#" class="btn btn-tool btn-link"><i
                                            class="fas fa-truck-loading fa-xs"></i>
                                        {{ $todayCompltedSchedule->schedule_details->count() }}</a>

                                    <a href="#" class="btn btn-tool btn-link"><i class="fas fa-dollar-sign fa-xs"></i>
                                        {{ $todayCompltedSchedule->cost_details->count() }}</a>

                                    <a href="#" class="btn btn-tool" data-toggle="modal"
                                        data-target="#completedexampleModal{{ $todayCompltedSchedule->id }}">
                                        <i class="fas fa-info"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body">

                    </div> --}}
                    </div>
                    <div class="modal fade scheduleInforModal"
                        id="completedexampleModal{{ $todayCompltedSchedule->id }}" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN LỊCH TRÌNH
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a @class(['nav-link', 'active' => !$activeCost]) id="custom-tabs-four-home-tab"
                                                            data-toggle="tab"
                                                            href="#custom-tabs-four-home{{ $todayCompltedSchedule->id }}"
                                                            role="tab"
                                                            aria-controls="custom-tabs-four-home{{ $todayCompltedSchedule->id }}"
                                                            aria-selected="true"
                                                            wire:click="changeTab">Chuyến({{ $todayCompltedSchedule->schedule_details->count() }})</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a @class(['nav-link', 'active' => $activeCost])
                                                            id="custom-tabs-four-profile-tab" data-toggle="tab"
                                                            href="#custom-tabs-four-profile{{ $todayCompltedSchedule->id }}"
                                                            role="tab" aria-controls="custom-tabs-four-profile"
                                                            aria-selected="false" wire:click="changeTab">Chí
                                                            phí({{ $todayCompltedSchedule->cost_details->count() }})</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div @class([
                                                        'tab-pane fade',
                                                        'show active' => !$activeCost,
                                                    ])
                                                        id="custom-tabs-four-home{{ $todayCompltedSchedule->id }}"
                                                        role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                        <div class="">
                                                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                                @if (Session::has('alert-' . $msg))
                                                                    <div
                                                                        class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="alert">&times;</button>
                                                                        {{ Session::get('alert-' . $msg) }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Danh sách chuyến</h3>
                                                            </div>
                                                            <!-- /.card-header -->
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
                                                                                aria-expanded="true">
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
                                                                                <td colspan="6">
                                                                                    <div>
                                                                                        <span
                                                                                            class="font-weight-bold">Ghi
                                                                                            chú</span>:@if ($schedule_detail->description) {{ $schedule_detail->description }} @else Không có @endif
                                                                                        <br>
                                                                                        <span
                                                                                            class="font-weight-bold">Đơn
                                                                                            hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
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
                                                            <!-- /.card-body -->
                                                            {{-- <div class="card-footer clearfix">
    
                                                                </div> --}}
                                                        </div>
                                                    </div>
                                                    <div @class(['tab-pane', 'show active' => $activeCost])
                                                        id="custom-tabs-four-profile{{ $todayCompltedSchedule->id }}"
                                                        role="tabpanel"
                                                        aria-labelledby="custom-tabs-four-profile-tab{{ $todayCompltedSchedule->id }}">
                                                        {{-- add form --}}

                                                        <div class="">
                                                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                                @if (Session::has('alert-' . $msg))
                                                                    <div
                                                                        class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="alert">&times;</button>
                                                                        {{ Session::get('alert-' . $msg) }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        {{-- end add form --}}
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Danh sách chi phí</h3>
                                                            </div>
                                                            <!-- /.card-header -->
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
                                                            {{-- <div class="card-footer clearfix">
                                                                    
                                                                </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row ">
                    <div class="col-12 d-flex align-items-center">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Không có công việc nào</span>
                                <span class="info-box-number text-center text-muted mb-0"><i
                                        class="fas fa-folder-open"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="card card-row card-secondary">
        <div class="card-header">
            <h3 class="card-title">
                Backlog
            </h3>
        </div>
        <div class="card-body">
            @if ($inQueueSchedules->count() > 0)
                @foreach ($inQueueSchedules as $inQueueSchedule)
                    @php
                        $isLate = $inQueueSchedule->date < Carbon\Carbon::today();
                    @endphp
                    <div @class([
                        'card',
                        'text-muted',
                        'card-outline',
                        'card-secondary' => !$isLate,
                        'card-info' => $isLate,
                    ])>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h5>
                                        <span class="badge badge-light text-muted"><i class="fas fa-truck-moving"></i>
                                            {{ $inQueueSchedule->truck->plate }}</span>
                                        <p class="float-right"><span @class([
                                            'badge',
                                            'badge-light',
                                            'text-muted',
                                            // 'badge-light' => $inQueueSchedule->shift == 1,
                                            // 'badge-dark' => $inQueueSchedule->shift == 0,
                                        ])>
                                                @if ($inQueueSchedule->shift == 1)
                                                    <span>Ngày</span>
                                                @else
                                                    <span>Đêm</span>
                                                @endif
                                            </span> <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                            <span
                                                class="badge badge-light text-muted">{{ Carbon\Carbon::parse($inQueueSchedule->date)->format('d-m-Y') }}</span>
                                        </p>
                                    </h5>
                                </div>
                                <!-- /.col -->
                            </div>
                            <hr>
                            <dl>
                                <dt>Mô tả</dt>
                                @if ($inQueueSchedule->description)
                                    <p style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                        line-clamp: 1; 
                                -webkit-box-orient: vertical;">{!! $inQueueSchedule->description !!}</p>
                                @else
                                    Không có
                                @endif
                            </dl>
                            <hr>
                            <div class=" d-flex justify-content-between">
                                @if ($inQueueSchedule->date < Carbon\Carbon::today())
                                    <div>
                                        <button type="submit" class="btn btn-info btn-xs"
                                            onclick='handleClick({{ $inQueueSchedule->id }});'>Hoàn thành</button>
                                    </div>
                                @else
                                    <span class="badge badge-secondary">
                                        Đang đợi</span>
                                @endif
                                <div><a href="#" class="btn btn-tool btn-link"><i
                                            class="fas fa-truck-loading fa-xs"></i>
                                        {{ $inQueueSchedule->schedule_details->count() }}</a>

                                    <a href="#" class="btn btn-tool btn-link"><i class="fas fa-dollar-sign fa-xs"></i>
                                        {{ $inQueueSchedule->cost_details->count() }}</a>
                                    <a href="#" class="btn btn-tool" data-toggle="modal"
                                        data-target="#inQueueExampleModal{{ $inQueueSchedule->id }}">
                                        @if ($isLate)
                                            <i class="fas fa-pen"></i>
                                        @else
                                            <i class="fas fa-info"></i>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body">

                    </div> --}}
                    </div>
                    <div class="modal fade closeInforModal" id="inQueueExampleModal{{ $inQueueSchedule->id }}"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN LỊCH TRÌNH
                                        {{-- {{ Carbon\Carbon::parse($inQueueSchedule->date)->format('d-m-Y') }} -
                                        {{ $inQueueSchedule->truck->plate }}</h5> --}}
                                        {{-- <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                </div>
                                <div class="modal-body">
                                    <div class="card card-primary card-outline card-outline-tabs">
                                        <div class="card-header p-0 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a @class(['nav-link', 'active' => !$activeCost]) id="custom-tabs-four-home-tab"
                                                        data-toggle="tab"
                                                        href="#custom-tabs-four-home{{ $inQueueSchedule->id }}"
                                                        role="tab"
                                                        aria-controls="custom-tabs-four-home{{ $inQueueSchedule->id }}"
                                                        aria-selected="true"
                                                        wire:click="changeTab">Chuyến({{ $inQueueSchedule->schedule_details->count() }})</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a @class(['nav-link', 'active' => $activeCost]) id="custom-tabs-four-profile-tab"
                                                        data-toggle="tab"
                                                        href="#custom-tabs-four-profile{{ $inQueueSchedule->id }}"
                                                        role="tab" aria-controls="custom-tabs-four-profile"
                                                        aria-selected="false" wire:click="changeTab">Chí
                                                        phí({{ $inQueueSchedule->cost_details->count() }})</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                                <div @class([
                                                    'tab-pane fade',
                                                    'show active' => !$activeCost,
                                                ])
                                                    id="custom-tabs-four-home{{ $inQueueSchedule->id }}"
                                                    role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                                    <div class="">
                                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                            @if (Session::has('alert-' . $msg))
                                                                <div
                                                                    class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">&times;</button>
                                                                    {{ Session::get('alert-' . $msg) }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    @if ($isLate)
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-light btn-sm collapsed"
                                                                        wire:click="toggleAddForm">
                                                                        Thêm chuyến
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseTwo{{ $inQueueSchedule->id }}"
                                                                @class(['d-none' => !$showAddForm])
                                                                aria-labelledby="headingTwo{{ $inQueueSchedule->id }}">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <div class="form-group mb-0" wire:ignore>
                                                                                <label>Mua:</label>
                                                                                <select class="select2 select2-seller"
                                                                                    style="width: 100%;" name="seller"
                                                                                    wire:model='seller'>
                                                                                    <option
                                                                                        {{ !$seller ? 'selected="selected"' : '' }}>
                                                                                    </option>
                                                                                    @foreach ($sellers as $seller)
                                                                                        <option
                                                                                            value="{{ $seller->id }}"
                                                                                            @if (old('seller') and old('seller') == $seller->id) selected = 'selected' @endif>
                                                                                            {{ $seller->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('seller')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group mb-0" wire:ignore>
                                                                                <label>Bán:</label>
                                                                                <select class="select2 select2-buyer"
                                                                                    style="width: 100%;" name="buyer"
                                                                                    wire:model='buyer'>
                                                                                    <option></option>
                                                                                    @foreach ($buyers as $buyer)
                                                                                        <option
                                                                                            value="{{ $buyer->id }}"
                                                                                            @if (old('buyer') and old('buyer') == $buyer->id) selected = 'selected' @endif>
                                                                                            {{ $buyer->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('buyer')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group mb-0" wire:ignore>
                                                                                <label>Đơn hàng:</label>
                                                                                <select class="select2 select2-order"
                                                                                    style="width: 100%;" name="order"
                                                                                    wire:model='order'>
                                                                                    <option></option>
                                                                                    <option value='none'> Không thuộc
                                                                                        đơn hàng nào</option>
                                                                                    @foreach ($orders as $order)
                                                                                        <option
                                                                                            value="{{ $order->id }}"
                                                                                            @if (old('order') and old('order') == $order->id) selected = 'selected' @endif>
                                                                                            {{ $order->summary }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('order')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group mb-0" wire:ignore>
                                                                                <label>Loại hàng:</label>
                                                                                <select
                                                                                    class="select2 select2-category"
                                                                                    style="width: 100%;" name="category"
                                                                                    wire:model='category'>
                                                                                    <option></option>
                                                                                    @foreach ($categories as $category)
                                                                                        <option
                                                                                            value="{{ $category->id }}"
                                                                                            @if (old('category') and old('category') == $category->id) selected = 'selected' @endif>
                                                                                            {{ $category->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('category')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Giá</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập giá ..."
                                                                                    name="price"
                                                                                    @if (old('price')) value="{{ old('price') }}" @else  @endif
                                                                                    wire:model='price'>
                                                                                @error('price')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Thực chi</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập tiền thực thu ..."
                                                                                    name="actual_price"
                                                                                    @if (old('actual_price')) value="{{ old('actual_price') }}" @else  @endif
                                                                                    wire:model='actual_price'>
                                                                                @error('actual_price')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Thu</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập doanh thu ..."
                                                                                    name="revenue"
                                                                                    @if (old('revenue')) value="{{ old('revenue') }}" @else  @endif
                                                                                    wire:model='revenue'>
                                                                                @error('revenue')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Thực thu</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập tiền thực thu ..."
                                                                                    name="actual_revenue"
                                                                                    @if (old('actual_revenue')) value="{{ old('actual_revenue') }}" @else  @endif
                                                                                    wire:model='actual_revenue'>
                                                                                @error('actual_revenue')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Khối lượng</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập khối lượng hàng ..."
                                                                                    name="quantity"
                                                                                    @if (old('quantity')) value="{{ old('quantity') }}" @else @endif
                                                                                    wire:model='quantity'>
                                                                                @error('quantity')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <div class="form-group">
                                                                                <label>Quãng đường</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    placeholder="Nhập quãng đường di chuyển ..."
                                                                                    name="distance"
                                                                                    @if (old('distance')) value="{{ old('distance') }}" @else @endif
                                                                                    wire:model='distance'>
                                                                                @error('distance')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="summernote">Mô tả chuyến vừa hoàn
                                                                            thành (không bắt buộc)</label>
                                                                        <textarea name="description"
                                                                            class="form-control summernoteAdd"
                                                                            wire:model='scheDetDescription'></textarea>
                                                                        @error('summernote')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="w-100">
                                                                        <button type="submit"
                                                                            class="btn btn-success btn-sm float-right"
                                                                            onclick='addScheduleDetail({{ $inQueueSchedule->id }})'>Thêm</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Danh sách chuyến</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Loại</th>
                                                                        <th>Mua</th>
                                                                        <th>Bán</th>
                                                                        <th>Lượng</th>
                                                                        @if ($isLate)<th>Hành động</th>@endif
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($inQueueSchedule->schedule_details as $schedule_detail)
                                                                        <tr data-widget="expandable-table"
                                                                            aria-expanded="true">
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
                                                                            @if ($isLate)
                                                                                <td class="text-right">
                                                                                    {{-- <a class="btn btn-primary btn-sm" href="#">
                                                                                    <i class="fas fa-folder">
                                                                                    </i>
                                                                                    View
                                                                                </a> --}}
                                                                                    <a class="btn btn-info btn-sm"
                                                                                        href="javascript:void(0)"
                                                                                        wire:click="editScheDeatail({{ $schedule_detail }})">
                                                                                        <i class="fas fa-pencil-alt">
                                                                                        </i>
                                                                                        Edit
                                                                                    </a>
                                                                                    <a class="btn btn-danger btn-sm btndelete"
                                                                                        href="javascript:void(0)"
                                                                                        onclick="handleDeleteScheDetail({{ $schedule_detail->id }});">
                                                                                        <i class="fas fa-trash">
                                                                                        </i>
                                                                                        Delete
                                                                                    </a>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                        <tr class="expandable-body">
                                                                            <td colspan="6">
                                                                                <div>
                                                                                    <span class="font-weight-bold">Ghi
                                                                                        chú</span>:@if ($schedule_detail->description) {{ $schedule_detail->description }} @else Không có @endif
                                                                                    <br>
                                                                                    <span class="font-weight-bold">Đơn
                                                                                        hàng</span>:@if ($schedule_detail->order) {{ $schedule_detail->order->summary }} @else Không có @endif
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
                                                        <!-- /.card-body -->
                                                        {{-- <div class="card-footer clearfix">

                                                            </div> --}}
                                                    </div>
                                                </div>
                                                <div @class(['tab-pane', 'show active' => $activeCost])
                                                    id="custom-tabs-four-profile{{ $inQueueSchedule->id }}"
                                                    role="tabpanel"
                                                    aria-labelledby="custom-tabs-four-profile-tab{{ $inQueueSchedule->id }}">
                                                    {{-- add form --}}
                                                    @if ($isLate)
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-light btn-sm collapsed"
                                                                        wire:click="toggleAddForm">
                                                                        Thêm chi phí
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="collapseTwo{{ $inQueueSchedule->id }}"
                                                                @class(['d-none' => !$showAddForm])
                                                                aria-labelledby="headingTwo{{ $inQueueSchedule->id }}">
                                                                @livewire('cost-detail-add-form',['todayDoingSchedule'=>
                                                                $inQueueSchedule],key($inQueueSchedule->id))
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="">
                                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                            @if (Session::has('alert-' . $msg))
                                                                <div
                                                                    class="alert alert-{{ $msg }} alert-dismissible fade show ">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert">&times;</button>
                                                                    {{ Session::get('alert-' . $msg) }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    {{-- end add form --}}
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Danh sách chi phí</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Loại</th>
                                                                        <th>Giá</th>
                                                                        <th>Thực chi</th>
                                                                        <th>Mô Tả</th>
                                                                        @if ($isLate)
                                                                            <th>Hành động</th>
                                                                        @endif
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
                                                                            @if ($isLate)
                                                                                <td class="text-right">
                                                                                    {{-- <a class="btn btn-primary btn-sm" href="#">
                                                                                    <i class="fas fa-folder">
                                                                                    </i>
                                                                                    View
                                                                                </a> --}}
                                                                                    <a class="btn btn-info btn-sm"
                                                                                        href="javascript:void(0)"
                                                                                        wire:click="editCostDeatail({{ $cost_detail }})">
                                                                                        <i class="fas fa-pencil-alt">
                                                                                        </i>
                                                                                        Edit
                                                                                    </a>
                                                                                    <a class="btn btn-danger btn-sm btndelete"
                                                                                        href="javascript:void(0)"
                                                                                        onclick="handleDeleteCostDetail({{ $cost_detail->id }});">
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
                                                        </div>
                                                        <!-- /.card-body -->
                                                        {{-- <div class="card-footer clearfix">
                                                                
                                                            </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    @if ($isLate)
                                        <button class="btn btn-success"
                                            onclick='handleClick({{ $inQueueSchedule->id }});'>Hoàn
                                            thành</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @livewire('schedule-edit-modal') --}}
                @endforeach
            @else
                <div class="row ">
                    <div class="col-12 d-flex align-items-center">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Không có công việc nào</span>
                                <span class="info-box-number text-center text-muted mb-0"><i
                                        class="fas fa-folder-open"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="scheEditExampleModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CHỈNH SỬA THÔNG TIN CHUYẾN</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                {{-- <button class="btn btn-info btn-sm collapsed" wire:click="toggleAddForm">
                                    Thêm chuyến
                                </button> --}}
                                Bảng thông tin
                            </h5>
                        </div>
                        <div @class([]) aria-labelledby="headingTwoEditScheModal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group mb-0" wire:ignore>
                                            <label>Mua:</label>
                                            <select class="select2 sche-edit-select2-seller" style="width: 100%;"
                                                name="seller_id" wire:model='editingScheDetail.seller_id'>
                                                <option {{ !$seller ? 'selected="selected"' : '' }}>
                                                </option>
                                                @foreach ($sellers as $seller)
                                                    <option value="{{ $seller->id }}" @if (old('seller') and old('seller') == $seller->id) selected = 'selected' @endif>
                                                        {{ $seller->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('seller')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0" wire:ignore>
                                            <label>Bán:</label>
                                            <select class="select2 sche-edit-select2-buyer" style="width: 100%;"
                                                name="buyer_id" wire:model='editingScheDetail.buyer_id'>
                                                <option></option>
                                                @foreach ($buyers as $buyer)
                                                    <option value="{{ $buyer->id }}" @if (old('buyer') and old('buyer') == $buyer->id) selected = 'selected' @endif>
                                                        {{ $buyer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('buyer')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0" wire:ignore>
                                            <label>Đơn hàng:</label>
                                            <select class="select2 sche-edit-select2-order" style="width: 100%;"
                                                name="order_id" wire:model='editingScheDetail.order_id'>
                                                <option></option>
                                                <option value='none'> Không thuộc
                                                    đơn hàng nào</option>
                                                @foreach ($orders as $order)
                                                    <option value="{{ $order->id }}" @if (old('order') and old('order') == $order->id) selected = 'selected' @endif>
                                                        {{ $order->summary }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0" wire:ignore>
                                            <label>Loại hàng:</label>
                                            <select class="select2 sche-edit-select2-category" style="width: 100%;"
                                                name="category_id" wire:model='editingScheDetail.category_id'>
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if (old('category') and old('category') == $category->id) selected = 'selected' @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="number" class="form-control" placeholder="Nhập giá ..."
                                                name="price" @if (old('price')) value="{{ old('price') }}" @else  @endif
                                                wire:model='editingScheDetail.price'>
                                            @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Thực chi</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập tiền thực thu ..." name="actual_price"
                                                @if (old('actual_price')) value="{{ old('actual_price') }}" @else  @endif wire:model='editingScheDetail.actual_price'>
                                            @error('actual_price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Thu</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập doanh thu ..." name="revenue"
                                                @if (old('revenue')) value="{{ old('revenue') }}" @else  @endif wire:model='editingScheDetail.revenue'>
                                            @error('revenue')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Thực thu</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập tiền thực thu ..." name="actual_revenue"
                                                @if (old('actual_revenue')) value="{{ old('actual_revenue') }}" @else  @endif wire:model='editingScheDetail.actual_revenue'>
                                            @error('actual_revenue')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Khối lượng</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập khối lượng hàng ..." name="quantity"
                                                @if (old('quantity')) value="{{ old('quantity') }}" @else @endif wire:model='editingScheDetail.quantity'>
                                            @error('quantity')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Quãng đường</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập quãng đường di chuyển ..." name="distance"
                                                @if (old('distance')) value="{{ old('distance') }}" @else @endif wire:model='editingScheDetail.distance'>
                                            @error('distance')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Mô tả chuyến vừa hoàn
                                        thành (không bắt buộc)</label>
                                    <textarea name="description" class="form-control summernoteAdd"
                                        wire:model='editingScheDetail.description'></textarea>
                                    @error('summernote')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="handleEditScheduleDetail()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="costEditExampleModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CHỈNH SỬA THÔNG TIN CHI PHÍ</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                {{-- <button class="btn btn-info btn-sm collapsed" wire:click="toggleAddForm">
                                    Thêm chuyến
                                </button> --}}
                                Bảng thông tin
                            </h5>
                        </div>
                        <div @class([]) aria-labelledby="headingTwoEditScheModal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group mb-0" wire:ignore>
                                            <label>Loại chi phí:</label>
                                            <select class="select2 cost-edit-select2-cost_group_id"
                                                style="width: 100%;" name="cost_group_id"
                                                wire:model='editingCostDetail.cost_group_id'>
                                                <option {{ !$seller ? 'selected="selected"' : '' }}>
                                                </option>
                                                @foreach ($costGroups as $costGroup)
                                                    <option value="{{ $costGroup->id }}" @if (old('cost_group_id') and old('cost_group_id') == $costGroup->id) selected = 'selected' @endif>
                                                        {{ $costGroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('cost_group_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Chi</label>
                                            <input type="number" class="form-control" placeholder="Nhập giá ..."
                                                name="cost" @if (old('cost')) value="{{ old('cost') }}" @else  @endif
                                                wire:model='editingCostDetail.cost'>
                                            @error('cost')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Thực chi</label>
                                            <input type="number" class="form-control"
                                                placeholder="Nhập tiền thực thu ..." name="actual_cost"
                                                @if (old('actual_cost')) value="{{ old('actual_cost') }}" @else  @endif wire:model='editingCostDetail.actual_cost'>
                                            @error('actual_cost')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả chi phí (không bắt buộc)</label>
                                    <textarea name="description" class="form-control summernoteAdd"
                                        wire:model='editingCostDetail.description'></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="handleEditCostDetail">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <input type="text" wire:model='tester'> --}}
</div>
@push('scripts')

@endpush
