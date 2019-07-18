@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.select_subjects') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('registration-management.index') }}">
                        {{ __('lang.registration_management') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.select_subjects') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.select_subjects') }}</div>
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $err)
                            {{ $err }}
                            <br>
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
                <form action="{{ route('admins.registration-management.select-subjects.store',
                    ['id' => $registration->id]) }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="card color-black width-70">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    @foreach ($subjects as $subject)
                                        @if ($regisSubjects->find($subject->id))
                                            <div class="col-md-3 d-flex justify-content-center">
                                                <p class="card-text">
                                                    <input type="checkbox" value="{{ $subject->id }}"
                                                    name="subjects[]" checked>
                                                    {{ ' ' . $subject->name }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="col-md-3 d-flex justify-content-center">
                                                <p class="card-text">
                                                    <input type="checkbox" value="{{ $subject->id }}"
                                                    name="subjects[]">
                                                    {{ ' ' . $subject->name }}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    {{ $subjects->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div>
                            <a href=""class="btn btn-secondary submit-style">
                                <i class="fas fa-backward"></i>
                                {{ __('lang.back') }}
                            </a>
                            <button class="btn btn-primary submit-style">
                                <i class="fas fa-save"></i>
                                {{ __('lang.save') }}
                            </button>
                            <a href=""class="btn btn-secondary submit-style">
                                <i class="fas fa-forward"></i>
                                {{ __('lang.classes') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
