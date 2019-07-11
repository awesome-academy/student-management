@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.add_student') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('student-management.index') }}">{{ __('lang.student_management') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.add_student') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.add_student') }}</div>
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $err)
                            {{ $err }}
                        @endforeach
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger text-center">
                        {{ session('fail') }}
                    </div>
                @endif
                <div class="d-flex justify-content-center">
                    <form class="update-form-style" method="POST"
                    action="{{ route('student-management.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.full_name') . '(*)' }}</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.id_card') . '(*)' }}</label>
                                <input type="text" class="form-control" name="id_card" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.birth') . '(*)' }}</label>
                                <input type="date" class="form-control" name="birth" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.phone') }}</label>
                                <input type="number" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.local_address') . '(*)' }}</label>
                                <input type="text" class="form-control" name="local_address" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('lang.current_address') }}</label>
                                <input type="text" class="form-control" name="current_address">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState">{{ __('lang.generation') . '(*)' }}</label>
                                <select class="form-control" name="generation" required>
                                    @foreach($generations as $generation)
                                        <option value="{{ $generation->id }}">{{ $generation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">{{ __('lang.department') . '(*)' }}</label>
                                <select class="form-control" name="department" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div>
                                <a href="{{ route('student-management.index') }}"
                                class="btn btn-secondary submit-style">
                                <i class="fas fa-backward"></i>
                                    {{ __('lang.back') }}
                                </a>
                                <button class="btn btn-primary submit-style" type="submit">
                                    <i class="fas fa-save"></i>
                                    {{ __('lang.save') }}
                                </button>
                            </div>
                        </div>
                      
                    </form>
                </div>
                 
            </div>
        </div>
    </div>
@endsection
