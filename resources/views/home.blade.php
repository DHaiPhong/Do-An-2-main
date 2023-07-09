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
                        Tên tài khoản: {{ Auth::user()->name }}
                        <br>
                        Role:
                        @php
                            $role = '';
                            
                            switch (Auth::user()->role) {
                                case 0:
                                    $role = 'Người Dùng';
                                    break;
                                case 1:
                                    $role = 'Editor';
                                    break;
                                case 2:
                                    $role = 'Admin';
                                    break;
                                default:
                                    $role = 'Không xác định';
                                    break;
                            }
                        @endphp
                        {{ $role }}
                        <br>
                        {{ $error }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
