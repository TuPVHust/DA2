@extends('layouts.boss')
@section('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin xe</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.truck.update', $truck->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card-body">
                <div class="form-group">
                    <label for="plate">Biển số</label>
                    <input type="text" class="form-control" id="plate" name="plate" @if (old('plate')) value="{{ old('plate') }}" @else value="{{ $truck->plate }}" @endif
                        placeholder="Nhập biển số xe...">
                    @error('plate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="figure">Loại xe</label>
                    <input type="text" class="form-control" id="figure" placeholder="Nhập loại xe" name="figure"
                        @if (old('figure')) value="{{ old('figure') }}" @else value="{{ $truck->figure }}" @endif>
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
                        @if (old('brand')) value="{{ old('brand') }}" @else value="{{ $truck->brand }}" @endif>
                    @error('brand')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="capacity">Thể tích thùng</label>
                    <input type="text" class="form-control" id="capacity" placeholder="Nhập thể tích thùng"
                        name="capacity" @if (old('capacity')) value="{{ old('capacity') }}" @else value="{{ $truck->capacity }}" @endif>
                    @error('capacity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Chủ xe</label>
                            <select class="form-control select2" style="width: 100%;" name="owner_id" id="select2">
                                <option value="{{ $truck->owner->id }}">{{ $truck->owner->name }}</option>
                                @foreach ($car_owners as $car_owner)
                                    @if ($car_owner->id != $truck->owner->id)
                                        <option value="{{ $car_owner->id }}">{{ $car_owner->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('owner_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" name="status" id="status">
                                <option value=1 @if (old('status') == 1) selected='selected' @elseif(old('status')== null and $truck->status == 1) selected='selected' @endif>Hoạt động</option>
                                <option value=0 @if (old('status') != null and old('status') == 0) selected='selected' @elseif(old('status')== null and $truck->status == 0) selected='selected'  @endif>Không hoạt động</option>
                            </select>
                        </div>
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
