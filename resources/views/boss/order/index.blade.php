@extends('layouts.boss')
@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endsection
@section('title')
    <h1>Quản lý đơn hàng</h1>
@endsection
@section('content')
    <div class="">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible fade show ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
    </div>

    <div class="text-right mb-2">
        <a href="{{ route('boss.order.create') }}">
            <button class="btn btn-primary">
                Thêm mới
            </button>
        </a>
    </div>
    @if ($orders->count() == 0)
        <h2 class="text-center alert mt-5">Không tìm thấy dữ liệu</h2>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card col-12">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đối tác</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tóm tắt</th>
                                    <th>Mô tả</th>
                                    <th>Người đặt</th>
                                    <th>Độ ưu tiên</th>
                                    <th>Trạng thái</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->summary }}</td>
                                        <td>{!! $order->description !!}</td>
                                        <td>{{ $order->partner->name }}</td>
                                        <td>{{ $order->piority }}</td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="badge badge-success">Đang tiến hành</span>
                                            @else
                                                <span class="badge badge-danger">Hoàn thành</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {{-- <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a> --}}
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('boss.order.edit', $order->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm btndelete"
                                                href="{{ route('boss.order.destroy', $order->id) }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    @endif
    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                select: true
            });
        });
    </script>
    <script>
        $(".btndelete").click(function(ev) {
            ev.preventDefault();
            let _href = $(this).attr('href');
            $("form#formdelete").attr('action', _href);
            if (confirm('Bạn muốn xóa bản ghi này không?')) {
                $("form#formdelete").submit();
            }
        });
    </script>
@endsection
