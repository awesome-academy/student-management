@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.home') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item active">
                    {{ __('lang.home') }}
                </li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container-fluid p-0 background-img">
        <div class="d-flex justify-content-center">
            <div class="content">
                <div class="title m-b-md welcome-text">
                    {{ __('lang.welcome') . ': ' . $admin->full_name }}
                </div>
            </div>
        </div>
    </div>
@endsection
