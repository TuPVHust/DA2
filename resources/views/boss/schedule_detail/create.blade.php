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
        <li class="breadcrumb-item active">Thêm chuyến</li>
    </ol>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm chuyến</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.schedule_detail.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Mua:</label>
                            <select class="select2" style="width: 100%;" name="seller">
                                <option></option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}" @if (old('seller') and old('seller') == $seller->id) selected = 'selected' @endif>
                                        {{ $seller->name }}</option>
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
                                <option></option>
                                @foreach ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}" @if (old('buyer') and old('buyer') == $buyer->id) selected = 'selected' @endif> {{ $buyer->name }}
                                    </option>
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
                                <option></option>
                                <option value='none'> Không thuộc đơn hàng nào</option>
                                @foreach ($orders as $order)
                                    <option value="{{ $order->id }}" @if (old('order') and old('order') == $order->id) selected = 'selected' @endif> {{ $order->summary }}
                                    </option>
                                @endforeach
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
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category') and old('category') == $category->id) selected = 'selected' @endif>
                                        {{ $category->name }}
                                    </option>
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
                                @if (old('price')) value="{{ old('price') }}" @else  @endif>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thực chi</label>
                            <input type="number" class="form-control" placeholder="Nhập tiền thực thu ..."
                                name="actual_price" @if (old('actual_price')) value="{{ old('actual_price') }}" @else  @endif>
                            @error('actual_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thu</label>
                            <input type="number" class="form-control" placeholder="Nhập doanh thu ..." name="revenue"
                                @if (old('revenue')) value="{{ old('revenue') }}" @else  @endif>
                            @error('revenue')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Thực thu</label>
                            <input type="number" class="form-control" placeholder="Nhập tiền thực thu ..."
                                name="actual_revenue" @if (old('actual_revenue')) value="{{ old('actual_revenue') }}" @else  @endif>
                            @error('actual_revenue')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>Khối lượng</label>
                            <input type="number" class="form-control" placeholder="Nhập khối lượng hàng ..."
                                name="quantity" @if (old('quantity')) value="{{ old('quantity') }}" @else @endif>
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Quãng đường</label>
                            <input type="number" class="form-control" placeholder="Nhập quãng đường di chuyển ..."
                                name="distance" @if (old('distance')) value="{{ old('distance') }}" @else @endif>
                            @error('distance')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Lịch trình:</label>
                            <select class="select2" style="width: 100%;" name="schedule">
                                <option></option>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" @if (old('schedule') and old('schedule') == $schedule->id) selected = 'selected' @endif>
                                        {{ Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }} |
                                        {{ $schedule->truck->plate }}| {{ $schedule->driver->name }} | @if ($schedule->shift == 1)
                                            <span>Ngày</span>
                                        @else
                                            <span>Đêm</span>
                                        @endif
                                        ({{ $schedule->schedule_details->count() }})
                                    </option>
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
                    <textarea id="summernote" name="description" class="form-control">@if (old('description')) {{ old('description') }} @else  @endif</textarea>
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
