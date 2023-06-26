@extends('users.masterUser')
@section('content')
    <a type="button" class="btn" href="{{ route('users.add') }} ">
        Add to Cart <i class="fas fa-shopping-cart"></i>
    </a>

@stop
