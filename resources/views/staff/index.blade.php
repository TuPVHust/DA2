@extends('layouts.staff')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    
    </style>
@endsection
@section('title')
    Home
@endsection
@section('content')
    {{-- <button type="button" x-data="{}" x-on:click="window.livewire.emitTo('schedule-edit-modal', 'show')"
        class="inline-flex content-end px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
        </span>Click to Open Modal
    </button> --}}
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
      </button> --}}
    {{-- <button onclick="showScheDetailEditForm()"></button> --}}
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
            $(document).on('hidden.bs.modal', function () {
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
        window.addEventListener('removeInputValue', event => {
            $(function() {
                //$('.select2').value() = null;
                $('.select2').prop('selectedIndex',0);
            });
        });
    </script>
    <script>
        window.addEventListener('showScheDetailEditForm', event => {
            $(function() {
                //alert('OKI')
                $('#exampleModal').modal('show');
            });
        });
    </script>
@endsection
