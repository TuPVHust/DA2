@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Chỉnh sửa thông tin tài xế
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin tài xế</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.driver.update', $driver->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" @if (old('name')) value="{{ old('name') }}" @else value="{{ $driver->name }}" @endif
                        placeholder="Nhập tên tài xế...">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại..." name="phone"
                        @if (old('phone')) value="{{ old('phone') }}" @else value={{ $driver->phone }} @endif>
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value=1 @if (old('status') == 1) selected='selected' @elseif(old('status') == null and $driver->status == 1) selected='selected' @endif>Đang làm việc</option>
                        <option value=0 @if (old('status') != null and old('status') == 0) selected='selected' @elseif(old('status') == null and $driver->status == 0) selected='selected'  @endif>Đã nghỉ</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
        document.getElementById("NCC").value = document.getElementById("NCCText").value;
        document.getElementById("NM").value = document.getElementById("NMText").value;
        document.getElementById("car_owner").value = document.getElementById("car_ownerText").value

        document.getElementById("NCC").checked = document.getElementById("NCCText").value === "1";
        document.getElementById("NM").checked = document.getElementById("NMText").value === "1";
        document.getElementById("car_owner").checked = document.getElementById("car_ownerText").value === "1";
        // document.getElementById("NCC").add(document.getElementById("NCC").value == "1" ? "checked" : "default");
        // document.getElementById("NM").add(document.getElementById("NM").value == "1" ? "checked" : "default");
        // document.getElementById("car_owner").add(document.getElementById("car_owner").value == "1" ? "checked" : "default");

        document.getElementById("NCC").addEventListener("click", (e) => {
            if (e.target.value == 0) {
                e.target.value = 1;
            } else if (e.target.value == 1) {
                e.target.value = 0;
            } else {
                e.target.value = 0;
            }
            document.getElementById("NCCText").value = e.target.value;
        });
        document.getElementById("NM").addEventListener("click", (e) => {
            if (e.target.value == 0) {
                e.target.value = 1;
            } else if (e.target.value == 1) {
                e.target.value = 0;
            } else {
                e.target.value = 0;
            }
            document.getElementById("NMText").value = e.target.value;
        });
        document.getElementById("car_owner").addEventListener("click", (e) => {
            if (e.target.value == 0) {
                e.target.value = 1;
            } else if (e.target.value == 1) {
                e.target.value = 0;
            } else {
                e.target.value = 0;
            }
            document.getElementById("car_ownerText").value = e.target.value;
        });
    </script>
@endsection
