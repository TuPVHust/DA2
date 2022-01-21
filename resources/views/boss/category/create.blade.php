@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Thêm mới danh mục hàng hóa
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm loại hàng hóa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.category.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Nhập loại chi phí...">
                    @error('name')
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
@endsection
