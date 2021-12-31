@extends('layouts.boss')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin đối tác</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.partner.update', $partner->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" @if (old('name')) value="{{ old('name') }}" @else value="{{ $partner->name }}" @endif
                        placeholder="Nhập tên đối tác...">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại" name="phone"
                        @if (old('phone')) value="{{ old('phone') }}" @else value={{ $partner->phone }} @endif>
                    @error('phone')
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
                </div> --}}
                <div class="">
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input" type="checkbox" id="NCC" value="0">
                        <input type="text" style="display: none" id="NCCText" name="NCC" @if (old('NCC')) value="{{ old('NCC') }}" @else value={{ $partner->NCC }} @endif>
                        <label for="NCC" class="custom-control-label">Nhà cung cấp(người bán)</label>
                        @error('NCC')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input" type="checkbox" id="NM" value="0">
                        <input type="text" style="display: none" id="NMText" name="NM" @if (old('NM')) value="{{ old('NM') }}" @else value={{ $partner->NM }} @endif>
                        <label for="NM" class="custom-control-label">Người mua</label>
                        @error('NM')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input" type="checkbox" id="car_owner" value="0">
                        <input type="text" style="display: none" id="car_ownerText" name="car_owner"
                            @if (old('car_owner')) value="{{ old('car_owner') }}" @else value={{ $partner->car_owner }} @endif>
                        <label for="car_owner" class="custom-control-label">Chủ xe</label>
                        @error('car_owner')
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
