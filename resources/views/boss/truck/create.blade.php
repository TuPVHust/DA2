@extends('layouts.boss')
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm xe</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.truck.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="plate">Biển số</label>
                    <input type="text" class="form-control" id="plate" name="plate" value="{{ old('plate') }}"
                        placeholder="Nhập biển số xe...">
                    @error('plate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="figure">Loại xe</label>
                    <input type="text" class="form-control" id="figure" placeholder="Nhập loại xe" name="figure"
                        value="{{ old('figure') }}">
                    @error('figure')
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
                    <label for="brand">Thương hiệu</label>
                    <input type="text" class="form-control" id="brand" placeholder="Nhập thương hiệu của xe" name="brand"
                        value="{{ old('brand') }}">
                    @error('brand')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="capacity">Thể tích thùng</label>
                    <input type="text" class="form-control" id="capacity" placeholder="Nhập thể tích thùng"
                        name="capacity" value="{{ old('capacity') }}">
                    @error('capacity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Chủ xe</label>
                        <select class="form-control select2" style="width: 100%;" name="owner_id" id="select2">
                            @foreach ($car_owners as $car_owner)
                                <option value="{{ $car_owner->id }}">{{ $car_owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id')
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn chủ xe",
                allowClear: true
            })
        });
    </script>
@endsection
