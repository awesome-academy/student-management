@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.home') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.check_information') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-xl-8">
            <div class="card shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.check_information') }}</div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-6">
                           <div class="card border-left-primary">
                                <div class="card-body" style="color: black;">
                                    <p>{{ __('lang.full_name') . ': ' . $admin->full_name }}</p>
                                    <p>{{ __('lang.birth') . ': ' . $admin->birth }}</p>    
                                    <p>{{ __('lang.local_address') . ': ' . $admin->local_address }}</p>
                                    <p>{{ __('lang.current_address') . ': ' . $admin->current_address }}</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-3 margin-left-200">
                            <a class="navbar-brand js-scroll-trigger" href="#">
                                @if (isset($admin))
                                    @if (!empty($admin->avatar))
                                        <img class="img-fluid img-profile rounded-circle mx-auto mb-3"
                                        src="{{ config('social.admin-img') . $admin->avatar }}" alt="avatar">
                                    @else
                                        <img class="img-fluid img-profile rounded-circle mx-auto mb-3"
                                        src="{{ config('social.student-default-img') }}" alt="avatar">
                                    @endif
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center margin-bottom-10">
                    <a href="#" class="myButton">{{ __('lang.update_information') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
