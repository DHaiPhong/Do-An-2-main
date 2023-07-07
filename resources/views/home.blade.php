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
                        Tên: {{ Auth::user()->name }}
                        <br>
                        Role: @if (Auth::user()->role == 0)
                            Người Dùng
                        @elseif (Auth::user()->role == 1)
                            Editor
                        @elseif (Auth::user()->role == 2)
                            Admin
                        @endif
                        <br>
                        {{ $error }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
