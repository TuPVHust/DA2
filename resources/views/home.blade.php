@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    <div class="text-right mb-2 col-12">
                        <a href="{{ route('boss.schedule.index') }}">
                            <button class="btn btn-info">
                                Đến trang boss
                            </button>
                        </a>
                        <a href="/staff">
                            <button class="btn btn-info">
                                Đến trang staff
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('bossUI') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
