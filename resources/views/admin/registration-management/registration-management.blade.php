@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.registration_management') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.registration_management') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.registration_management') }}</div>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="registration-table-css">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger text-center">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('fail'))
                            <div class="alert alert-danger text-center">
                                {{ session('fail') }}
                            </div>
                        @endif
                        <input type="hidden" id="registrationTableAjaxRoute"
                        value="{{ route('admins.registration-management.ajax') }}">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('registration-management.create') }}" class="btn">
                                <i class="fas fa-plus">{{ ' ' .  __('lang.add') }}</i>
                            </a>
                        </div>
                        <table id="registration-table" class="color-black">
                            <thead>
                                <tr>
                                    <th class="col-width-5">{{ __('lang.ordinal_number') }}</th>
                                    <th class="col-width-10">{{ __('lang.name') }}</th>
                                    <th class="col-width-15">{{ __('lang.time_begin') }}</th>
                                    <th class="col-width-15">{{ __('lang.time_finish') }}</th>
                                    <th class="col-width-8">{{ __('lang.min_credit') }}</th>
                                    <th class="col-width-8">{{ __('lang.max_credit') }}</th>
                                    <th class="col-width-12">{{ __('lang.admin') }}</th>
                                    <th class="col-width-8">{{ __('lang.time_status') }}</th>
                                    <th class="col-width-5">{{ __('lang.status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
@endsection
