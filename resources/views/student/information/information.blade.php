@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.check_information') }}
@endsection
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('students.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.check_information') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content-margin">
        <h3 class="text-center">{{ __('lang.check_information') }}</h3>
        <br>
        <div>
            @if (isset($student))
                @if (!empty($student->avatar))
                    <img src="{{ config('social.student-img') . $student->avatar }}" alt="" class="img-thumbnail avatar-size">
                @else
                    <img src="{{ config('social.student-default-img') }}" alt="" class="img-thumbnail avatar-size">
                    <div class="alert alert-danger avatar-arlert-size">
                        {{ __('lang.non_avatar') }}
                    </div>
                @endif
                <div class="font-size-18">
                    <hr>
                    <label for="name">{{ __('lang.full_name') . ': ' . $student->full_name }}</label><br>
                    <label for="birth">{{ __('lang.birth') . ': ' . $student->birth }}</label><br>
                    <label for="id_card">{{ __('lang.id_card') . ': ' . $student->id_card }}</label><br>
                    <label for="phone">{{ __('lang.phone') . ': ' . $student->phone }}</label><br>
                    <label for="local_address">{{ __('lang.local_address') . ': ' . $student->local_address }}</label>
                    <br>
                    <label for="current_address">{{ __('lang.current_address') . ': ' . $student->current_address }}
                    </label><br>
                    <label for="generation">{{ __('lang.generation') . ': ' . $student->getGeneration->name }}</label>
                    <br>
                    <label for="department">{{ __('lang.department') . ': ' . $student->getDepartment->name }}</label>
                    <br>
                </div>
                <div>
                    
                    <a href="{{ route('students.return_update_information') }}" class="btn btn-primary">
                        {{ __('lang.update_information') }}
                    </a>
                </div>
            @endif
        </div>
        
    </div>
@endsection
