@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Tracking
@endsection
@section('css')
    {{-- datatables --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Tracking</li>
    </ol>
@endsection
@section('content')
@endsection

@section('js')
@endsection
