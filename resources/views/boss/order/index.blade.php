@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Danh mục đơn đặt hàng
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" /> --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                                    <th>Ngày tạo</th>
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
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
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
    <!-- DataTables  & Plugins -->
    <script src="{{ url('bossUI') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script> --}}
    <script>
        $(function() {
            $("#example1").DataTable({
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                select: true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
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
