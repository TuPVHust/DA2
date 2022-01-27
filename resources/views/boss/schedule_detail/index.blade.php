@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Chuyến
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- select2 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('title')
    <h1>Chuyến</h1>
@endsection
@section('content')
 @livewire('all-schedule-detail')
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
    <script src="{{ url('bossUI') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                searching: false,
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                select: true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
    {{-- select2 --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn để lọc",
                allowClear: true,
            })
            $('.select2bs4').select2({
                allowClear: true,
            })
        });
        //Initialize Select2 Elements
    </script>
    <script>
        $("#hiden_Colums").on("select2:select select2:unselect", function (e) {
        //this returns all the selected item
        var items= $(this).val();       
        //Gets the last selected item
        var lastSelectedItem = e.params.data.id;
        alert(items);
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.select2_no_delete').select2({
                placeholder: "Chọn để lọc",
            })
        });
    </script>
    <script>
        $('#timeRangeFilter').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
                separator: " - ",
            }
        })
    </script>
    <script>
        function handleChangeTiemRange(src) {
            Livewire.emit('ChangeTimeRange', src.value);
        }
    </script>
    <script>
        $(document).on('change.select', '#orderBy', function(event) {
            Livewire.emit('changeOrderBy', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '#order', function(event) {
            Livewire.emit('changeOrder', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '#driverFilter', function(event) {
            Livewire.emit('changeDriver', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '#truckFilter', function(event) {
            Livewire.emit('changeTruck', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '#carOwnerFilter', function(event) {
            Livewire.emit('changeCarOwner', event.target.value);
        });
    </script>
@endsection