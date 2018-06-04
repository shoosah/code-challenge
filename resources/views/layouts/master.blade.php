<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.head')
<body>
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.footer')
</body>