@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.subject_registration') }}
@endsection
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('students.return_home') }}">{{ __('lang.home') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.subject_registration') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content-margin">
        <h3 class="text-center">{{ __('lang.subject_registration') }}</h3>
        <br>
        <span class="badge badge-pill badge-light font-size-14"><a href="">{{ __('lang.registration_instructions') }}</a></span>
        <span class="badge badge-pill badge-light font-size-14"><a href="">{{ __('lang.feed_back') }}</a></span>
        <hr>
        @if (!isset($registration))
            <div class="alert alert-danger text-center">
                {{ $notification }}
            </div>
        @else
            <div class="d-flex justify-content-center">
                <div class="input-group mb-3 width-40">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">{{ __('lang.choose_subject') }}</label>
                    </div>
                    <select class="custom-select" id="subjectSelect">
                        <option value="" selected>{{ __('lang.select') }}</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <br>
                <form action="{{ route('students.do_subject_registration') }}" method="POST">
                    @csrf
                    <table class="table table-style" id="classTable">
                        <caption>{{ __('lang.class_list') }}</caption>
                        <thead class="thead-red">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ __('lang.subject') }}</th>
                                <th scope="col">{{ __('lang.class_group') }}</th>
                                <th scope="col">{{ __('lang.teacher') }}</th>
                                <th scope="col">{{ __('lang.class_room') }}</th>
                                <th scope="col">{{ __('lang.size') }}</th>
                                <th scope="col">{{ __('lang.lesson') }}</th>
                                <th scope="col">{{ __('lang.day') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                                    
                        </tbody>                    
                    </table>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary background-red ">
                            {{ __('lang.register') }}
                        </button>
                    </div>
                </form>

            </div>

            <div class="d-flex justify-content-center">
                
            </div>
        @endif
    </div>

@endsection
