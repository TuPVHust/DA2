@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Thêm công việc
@endsection
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Thêm công việc</li>
    </ol>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tạo lệnh điều xe</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.schedule.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="summernote">Mô tả lịch trình (Không bắt buộc)</label>
                    <textarea id="summernote" name="description" class="form-control">@if (old('description')) {{ old('description') }}" @else  @endif</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="driver">Tài xế</label>
                            <select class="form-control select2" style="width: 100%;" name="driver" id="select2">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('driver')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="truck">Xe</label>
                            <select class="form-control select2" style="width: 100%;" name="truck" id="select3">
                                @foreach ($trucks as $truck)
                                    <option value="{{ $truck->id }}">{{ $truck->plate }}</option>
                                @endforeach
                            </select>
                            @error('truck')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="init_money">Tiền</label>
                            <input type="number" class="form-control" id="init_money"
                                placeholder="Mức độ ưu tiên của đơn hàng" name="init_money" @if (old('init_money')) value="{{ old('init_money') }}" @else value=0 @endif>
                            @error('init_money')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="shift">Ca</label>
                            <select class="form-control" name="shift" id="shift">
                                <option value=1 @if (old('shift') == 1) selected='selected' @elseif(old('shift') == null) selected='selected' @endif>Ngày</option>
                                <option value=0 @if (old('shift') != null and old('status') == 0) selected='selected' @elseif(old('shift') == null) selected='selected'  @endif>Đêm</option>
                            </select>
                            @error('shift')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ngày</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                            name="date" placeholder="dd-mm-yyyy" @if (old('date')) value="{{ old('date') }}" @else value="{{ Carbon\Carbon::now('Asia/Bangkok')->format('d-m-Y') }}" @endif />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div>
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // // CodeMirror
            // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            //     mode: "htmlmixed",
            //     theme: "monokai"
            // });
        })
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY',
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn người đặt",
                allowClear: true
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select3').select2({
                placeholder: "Chọn xe",
                allowClear: true
            })
        });
    </script>
@endsection
