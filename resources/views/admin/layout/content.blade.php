@extends('admin.components.main')
@section('dashboard-section')
    @include('admin.components.header')
    @include('admin.components.sidebar')
    <main id="main" class="main">
    @yield('content')
    </main>
    @include('admin.components.footer')
@endsection
