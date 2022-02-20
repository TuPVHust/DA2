@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Thêm mới chuyến (thử nghiệm)
@endsection
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Update chuyến</li>
    </ol>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm chuyến</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.schedule_detail.update', $scheduleDetail->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Mua:</label>
                            <select class="select2" style="width: 100%;" name="seller">
                                <option value="{{ $scheduleDetail->seller->id }}" @if (old('seller') and old('seller') == $scheduleDetail->seller->id) selected = 'selected' @endif>
                                    {{ $scheduleDetail->seller->name }}
                                </option>
                                @foreach ($sellers as $seller)
                                    @if ($seller->id != $scheduleDetail->seller->id)
                                        <option value="{{ $seller->id }}" @if (old('seller') and old('seller') == $seller->id) selected = 'selected' @endif>
                                            {{ $seller->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('seller')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Bán:</label>
                            <select class="select2" style="width: 100%;" name="buyer">
                                <option value="{{ $scheduleDetail->buyer->id }}" @if (old('buyer') and old('buyer') == $scheduleDetail->buyer->id) selected = 'selected' @endif>
                                    {{ $scheduleDetail->buyer->name }}
                                </option>
                                @foreach ($buyers as $buyer)
                                    @if ($buyer->id != $scheduleDetail->buyer->id)
                                        <option value="{{ $buyer->id }}" @if (old('buyer') and old('buyer') == $buyer->id) selected = 'selected' @endif> {{ $buyer->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('buyer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Đơn hàng:</label>
                            <select class="select2" style="width: 100%;" name="order">
                                @if ($scheduleDetail->order)
                                    <option value="{{ $scheduleDetail->order->id }}" @if (old('order') and old('order') == $scheduleDetail->order->id) selected = 'selected' @endif>
                                        {{ $scheduleDetail->order->summary }}
                                    </option>
                                    <option value='none'> Không thuộc đơn hàng nào</option>
                                    @foreach ($orders as $order)
                                        @if ($order->id != $scheduleDetail->order->id)
                                            <option value="{{ $order->id }}" @if (old('order') and old('order') == $order->id) selected = 'selected' @endif>
                                                {{ $order->summary }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value='none'> Không thuộc đơn hàng nào</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}" @if (old('order') and old('order') == $order->id) selected = 'selected' @endif>
                                            {{ $order->summary }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('order')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Loại hàng:</label>
                            <select class="select2" style="width: 100%;" name="category">
                                <option value="{{ $scheduleDetail->category->id }}" @if (old('category') and old('category') == $scheduleDetail->category->id) selected = 'selected' @endif>
                                    {{ $scheduleDetail->category->name }}
                                </option>
                                @foreach ($categories as $category)
                                    @if ($category->id != $scheduleDetail->category->id)
                                        <option value="{{ $category->id }}" @if (old('category') and old('category') == $category->id) selected = 'selected' @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="number" class="form-control" placeholder="Nhập giá ..." name="price"
                                @if (old('price')) value="{{ old('price') }}" @else value={{ $scheduleDetail->price }} @endif>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thực chi</label>
                            <input type="number" class="form-control" placeholder="Nhập tiền thực thu ..."
                                name="actual_price" @if (old('actual_price')) value="{{ old('actual_price') }}" @else value={{ $scheduleDetail->actual_price }} @endif>
                            @error('actual_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thu</label>
                            <input type="number" class="form-control" placeholder="Nhập doanh thu ..." name="revenue"
                                @if (old('revenue')) value="{{ old('revenue') }}" @else value={{ $scheduleDetail->revenue }} @endif>
                            @error('revenue')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thực thu</label>
                            <input type="number" class="form-control" placeholder="Nhập tiền thực thu ..."
                                name="actual_revenue" @if (old('actual_revenue')) value="{{ old('actual_revenue') }}" @else value={{ $scheduleDetail->actual_revenue }} @endif>
                            @error('actual_revenue')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>Khối lượng</label>
                            <input type="number" class="form-control" placeholder="Nhập khối lượng hàng ..."
                                name="quantity" @if (old('quantity')) value="{{ old('quantity') }}" @else value={{ $scheduleDetail->quantity }} @endif>
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Quãng đường</label>
                            <input type="number" class="form-control" placeholder="Nhập quãng đường di chuyển ..."
                                name="distance" @if (old('distance')) value="{{ old('distance') }}" @else value={{ $scheduleDetail->distance }} @endif>
                            @error('distance')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Lịch trình:</label>
                            <select class="select2" style="width: 100%;" name="schedule">
                                <option value="{{ $scheduleDetail->schedule->id }}" @if (old('schedule') and old('schedule') == $scheduleDetail->schedule->id) selected = 'selected' @endif>
                                    {{ Carbon\Carbon::parse($scheduleDetail->schedule->date)->format('d-m-Y') }} |
                                    {{ $scheduleDetail->schedule->truck->plate }}|
                                    {{ $scheduleDetail->schedule->driver->name }} |
                                    @if ($scheduleDetail->schedule->shift == 1)
                                        <span>Ngày</span>
                                    @else
                                        <span>Đêm</span>
                                    @endif
                                    ({{ $scheduleDetail->schedule->schedule_details->count() }})
                                </option>
                                @foreach ($schedules as $schedule)
                                    @if ($schedule->id != $scheduleDetail->schedule->id)
                                        <option value="{{ $schedule->id }}" @if (old('schedule') and old('schedule') == $schedule->id) selected = 'selected' @endif>
                                            {{ Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }} |
                                            {{ $schedule->truck->plate }}| {{ $schedule->driver->name }} |
                                            @if ($schedule->shift == 1)
                                                <span>Ngày</span>
                                            @else
                                                <span>Đêm</span>
                                            @endif
                                            ({{ $schedule->schedule_details->count() }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('schedule')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summernote">Mô tả chuyến vừa hoàn thánh (không bắt buộc)</label>
                    <textarea id="summernote" name="description" class="form-control">@if (old('description')) {{ old('description') }} @else {{ $scheduleDetail->description }} @endif</textarea>
                    @error('summernote')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="partner_id">Người đặt</label>
                        <select class="form-control select2" style="width: 100%;" name="partner_id" id="select2">
                            @foreach ($partners as $partners)
                                <option value="{{ $partners->id }}">{{ $partners->name }}</option>
                            @endforeach
                        </select>
                        @error('partner_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div> --}}
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    {{-- sumernote --}}
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn người đặt",
                allowClear: true
            })
        });
    </script>
@endsection
