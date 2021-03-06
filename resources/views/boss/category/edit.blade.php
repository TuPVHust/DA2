@extends('layouts.boss')
@section('title')
    AdminLTE 3 | chỉnh sửa thông tin hàng hóa
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông hàng hóa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('boss.category.update', $category->id) }}" method="post">
            @csrf
            @method("put")
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" @if (old('name')) value="{{ old('name') }}" @else value="{{ $category->name }}" @endif
                        placeholder="Nhập tên hàng...">
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
