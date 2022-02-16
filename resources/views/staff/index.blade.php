@extends('layouts.staff')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>

    </style>
@endsection
@section('title')
    Home
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
    </ol>
@endsection
@section('content')
    @livewire('staff-works')
    {{-- <livewire:schedule-edit-modal /> --}}
@endsection
@section('js')
    <script>
        // window.addEventListener('showScheDetailEditForm', event => {
        //     alert('oki');
        //         // $('.scheDetailEditForm').modal('show');
        // });
    </script>
    <script src="{{ url('bossUI') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        function showScheDetailEditForm() {
            $('.exampleModal').modal('show');
        }
    </script>
    <script>
        function addScheduleDetail(id) {
            Livewire.emit('addScheduleDetail', id);
        }
    </script>
    <script>
        function addCostDetail(id) {
            Livewire.emit('addCostDetail', id);
        }
    </script>
    <script>
        function handleClick(id) {
            if (confirm('Nếu tiếp tục bạn sẽ không có quyền chỉnh sử công việc này nữa, vẫn tiếp tục ?')) {
                Livewire.emit('completeWork', id);
            }
            // Livewire.emit('completeWork', id);
        }
    </script>
    <script>
        function toggleAddForm() {
            Livewire.emit('toggleAddForm', id);
            //alert('oki');
        }
    </script>
    {{-- sumernote --}}
    {{-- <script>
        $(function() {
            $('.summernoteAdd').summernote()
        })
    </script> --}}
    <script>
        window.addEventListener('reloadJs', event => {
            //$('.collapse').collapse()
            // $('.summernoteAdd').summernote('reset');

            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Chọn người đặt",
                    allowClear: true
                })
            });
            // $(document).ready(function() {
            //     $('.summernoteAdd').summernote()
            // });
            // $(function() {
            //     $('.summernoteAdd').summernote()
            // });
        });
    </script>
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Chọn người đặt",
                allowClear: true
            });
            $(document).on('hidden.bs.modal', function() {
                if ($('.modal:visible').length) {
                    $('body').addClass('modal-open');
                }
            });
        });
    </script>
    <script>
        $(document).on('change.select', '.select2-order', function(event) {
            Livewire.emit('changeOrder', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '.select2-buyer', function(event) {
            Livewire.emit('changeBuyer', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '.select2-seller', function(event) {
            Livewire.emit('changeSeller', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '.select2-category', function(event) {
            Livewire.emit('changeCategory', event.target.value);
        });
    </script>
    <script>
        $(document).on('change.select', '.select2-costGroup', function(event) {
            Livewire.emit('changeCostGroup', event.target.value);
        });
    </script>
    <script>
        function handleDeleteScheDetail(id) {
            //alert(id)
            if (confirm('Bạn muốn xóa bản ghi này?')) {
                Livewire.emit('deleteScheDetail', id);
            }
        }
    </script>
    <script>
        function handleDeleteCostDetail(id) {
            //alert(id)
            if (confirm('Bạn muốn xóa bản ghi này?')) {
                Livewire.emit('deleteCostDetail', id);
            }
        }
    </script>
    <script>
        function handleEditScheduleDetail() {
            //alert(id);
            if (confirm('Bạn muốn cập nhật bản ghi này?')) {
                Livewire.emit('editScheduleDetail');
            }
        }
    </script>
    <script>
        window.addEventListener('removeInputValue', event => {
            $(function() {
                //$('.select2').value() = null;
                $('.select2').prop('selectedIndex', 0);
            });
        });
    </script>
    <script>
        window.addEventListener('showScheDetailEditForm', event => {
            $(function() {
                //alert('OKI')
                $('#scheEditExampleModal').modal('show');
            });
        });
    </script>
    <script>
        window.addEventListener('showCostDetailEditForm', event => {
            $(function() {
                //alert('OKI')
                $('#costEditExampleModal').modal('show');
            });
        });
    </script>
    <script>
        window.addEventListener('closeEdititngModal', event => {
            $(function() {
                //alert('OKI')
                $('#scheEditExampleModal').modal('hide');
                $('#costEditExampleModal').modal('hide');
            });
        });
        $('#scheEditExampleModal').on('hidden.bs.modal', function(e) {
            Livewire.emit('cancelEdit');
        })
    </script>

    <script>
        $('.scheduleInforModal').on('hidden.bs.modal', function(e) {
            //alert('oki');
            Livewire.emit('closeInforModal');
        })
    </script>

    {{-- editing select onchange event --}}
    <script>
        $(document).on('change.select', '.sche-edit-select2-order', function(event) {
            Livewire.emit('updateSchedulesDetail', event.target.value, 'order_id');
        });
    </script>
    <script>
        $(document).on('change.select', '.sche-edit-select2-buyer', function(event) {
            Livewire.emit('updateSchedulesDetail', event.target.value, 'buyer_id');
        });
    </script>
    <script>
        $(document).on('change.select', '.sche-edit-select2-seller', function(event) {
            Livewire.emit('updateSchedulesDetail', event.target.value, 'seller_id');
        });
    </script>
    <script>
        $(document).on('change.select', '.sche-edit-select2-category', function(event) {
            Livewire.emit('updateSchedulesDetail', event.target.value, 'category_id');
        });
    </script>
    <script>
        $(document).on('change.select', '.cost-edit-select2-cost_group_id', function(event) {
            Livewire.emit('updateCostDetail', event.target.value, 'cost_group_id');
        });
    </script>
@endsection
