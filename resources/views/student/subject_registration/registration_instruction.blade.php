@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.registration_instructions') }}
@endsection
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('students.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('students.return_subject_registration') }}">
                        {{ __('lang.subject_registration') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.registration_instructions') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content-margin">
        <h3 class="text-center">{{ __('lang.registration_instructions') }}</h3>
        <div>
            <span class="badge badge-pill badge-light font-size-14">
                <a href="{{ config('social.registration-instruction-document') }}" target="_blank">
                    {{ __('lang.instruction_document') }}
                </a>
            </span>
        </div>
        <hr>
        <div>
            <h6>{{ __('lang.instruction_video') }}</h6>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <iframe class="instruction-video-iframe" src="{{ config('social.registration-instruction-video') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <br>
    </div>
@endsection
