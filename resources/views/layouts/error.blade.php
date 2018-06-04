@extends('layouts.master')

@section('body')
    <div class="container">
        <div class="portal-container">
            <div class="portal">
                @yield('content')
            </div>
        </div>
    </div>
@endsection