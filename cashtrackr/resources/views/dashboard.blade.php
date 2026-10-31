@extends("layouts.auth")

@section('title')
    Administra tus presupuestos
@endsection


@section('auth-contents')

    @if (session('success'))
        <x-alert type="success" :message="session('success')"/>
    @endif

@endsection
