@extends('layouts.boss')
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin đơn hàng</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.order.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="plate">Tóm tắt</label>
                    <input type="text" class="form-control" id="summary" name="summary" @if (old('summary')) value="{{ old('summary') }}" @else value= "{{ $order->summary }}" @endif
                        placeholder="Nhập tóm tắt nội dung đơn hàng...">
                    @error('summary')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div> --}}
                <div class="form-group">
                    <label for="summernote">Mô tả chi tiết đơn hàng (không bắt buộc)</label>
                    <textarea id="summernote" name="description" class="form-control">@if (old('description')) {{ old('description') }} @else {{ $order->description }} @endif</textarea>
                    @error('summernote')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="piority">Độ ưu tiên</label>
                    <input type="number" class="form-control" id="piority" placeholder="Mức độ ưu tiên của đơn hàng"
                        name="piority" @if (old('piority')) value="{{ old('piority') }}" @else value={{ $order->piority }} @endif>
                    @error('piority')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="partner_id">Người đặt</label>
                            <select class="form-control select2" style="width: 100%;" name="partner_id" id="select2">
                                <option value="{{ $order->partner->id }}">{{ $order->partner->name }}</option>
                                @foreach ($partners as $partner)
                                    @if ($partner->id != $order->partner->id)
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('partner_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" name="status" id="status">
                                <option value=1 @if (old('status') == 1) selected='selected' @elseif(old('status')== null and $order->status == 1) selected='selected' @endif>Đang tiến hành</option>
                                <option value=0 @if (old('status') != null and old('status') == 0) selected='selected' @elseif(old('status')== null and $order->status == 0) selected='selected'  @endif>Đã hoàn thành</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"
                            name="date" placeholder="dd-mm-yyyy" @if (old('date')) value="{{ old('date') }}" @else value="{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}" @endif />
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
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        $(function() {
            // Summernote
            $('#summernote').summernote()
            // CodeMirror
            // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            //     mode: "htmlmixed",
            //     theme: "monokai"
            // });
        })
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
@endsection
