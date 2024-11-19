@extends('layouts.base')

@section('body')
    @include('partials.alert')

    @include('partials.sidebar')

    @yield('content')
    
    @isset($slot)
        {{ $slot }}
    @endisset

    @include('partials.footer')
@endsection
