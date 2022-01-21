@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Thêm mới đơn hàng
@endsection
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm đơn hàng</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.order.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="plate">Tóm tắt</label>
                    <input type="text" class="form-control" id="summary" name="summary" value="{{ old('summary') }}"
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
                    <textarea id="summernote" name="description" class="form-control">@if (old('description')) {{ old('description') }} @else  @endif</textarea>
                    @error('summernote')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="piority">Độ ưu tiên</label>
                    <input type="number" class="form-control" id="piority" placeholder="Mức độ ưu tiên của đơn hàng"
                        name="piority" @if (old('piority')) value="{{ old('piority') }}" @else value=0 @endif>
                    @error('piority')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
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
                    {{-- <div class="form-group">
                        <label>Chủ xe</label>
                        <select class="select2" multiple="multiple" data-placeholder="Chọn chủ xe"
                            style="width: 100%;">
                            @foreach ($car_owners as $car_owner)
                                <option value="{{ $car_owner->id }}">{{ $car_owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <!-- /.form-group -->
                </div>
                {{-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
