@extends('suplair.components.main')
@section('dashboard-section')
    @include('suplair.components.header')
    @include('suplair.components.sidebar')
    <main id="main" class="main">
    @yield('content')
    </main>
    @include('suplair.components.footer')
@endsection
