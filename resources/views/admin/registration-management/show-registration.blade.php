@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.registration_detail') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('registration-management.index') }}">{{ __('lang.registration_management') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.registration_detail') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.registration_information') }}</div>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="card color-black width-70">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.name') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    
                                    <h5 class="card-title color-blue">{{ __('lang.status') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($registration->status == config('social.active'))
                                                
                                            <p class="card-text">
                                                <i class="fas fa-circle color-green"></i>
                                                {{ __('lang.activated') }}
                                            </p>
                                                
                                            @else
                                                
                                                <p class="card-text">
                                                    <i class="fas fa-circle color-red"></i>
                                                    {{ __('lang.disable') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.time_begin') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <em>
                                                    {{ $registration->time_begin . ' ' . $registration->date_begin }}
                                                </em>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    
                                    <h5 class="card-title color-blue">{{ __('lang.time_finish') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <em>
                                                    {{ $registration->time_finish . ' ' . $registration->date_finish }}
                                                </em> 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.min_credit') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->min_credits }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    
                                    <h5 class="card-title color-blue">{{ __('lang.max_credit') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->max_credits }}</p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.admin') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->getAdmin->full_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.department') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->getDepartment->description }}</p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.semester') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">{{ $registration->getSemester->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title color-blue">{{ __('lang.available_generation') }}</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-text">
                                                @foreach ($registration->getGeneration as $generation)
                                                    {{ $generation->name . ', ' }}
                                                @endforeach
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="card color-black width-70">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="input-group col-md-7">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text color-black" for="inputGroupSelect01">
                                            {{ __('lang.list_subjects') }}
                                        </label>
                                    </div>
                                    <select class="custom-select color-black" id="inputSubjectSelect">
                                        <option value="0" selected>{{ __('lang.select') }}</option>
                                        @foreach ($registration->getSubject as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <caption><h4>{{ __('lang.class_list') }}</h4></caption>
                                <table class="table color-black">
                                    <thead class="background-color-blue">
                                        <tr>
                                            <th scope="col">{{ __('lang.ordinal_number') }}</th>
                                            <th scope="col">{{ __('lang.subject') }}</th>
                                            <th scope="col">{{ __('lang.teacher') }}</th>
                                            <th scope="col">{{ __('lang.class_group') }}</th>
                                            <th scope="col">{{ __('lang.class_room') }}</th>
                                            <th scope="col">{{ __('lang.size') }}</th>
                                            <th scope="col">{{ __('lang.lesson') }}</th>
                                            <th scope="col">{{ __('lang.day') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="registrationClassTable">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <br>
                <div class="row justify-content-center">
                    <a href="{{ route('registration-management.index') }}"
                    class="btn btn-secondary submit-style">
                        <i class="fas fa-backward"></i>
                        {{ __('lang.back') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
    <br>
@endsection
