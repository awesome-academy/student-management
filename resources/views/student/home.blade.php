@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.home') }}
@endsection
@section('content')
    <div class="container-fluid p-0 home-background-img">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md text-color">
                    @if (isset($student))
                        {{ __('lang.welcome') . ': ' . $student->full_name }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
