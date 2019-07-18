@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.create_registration') }}
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.create_registration') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.create_registration') }}</div>
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
                <form action="{{ route('registration-management.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="card color-black width-70">
                            <div class="card-body">
                                
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-10">
                                        <h5 class="card-title color-blue">{{ __('lang.registration_name') . '*' }}</h5>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <h5 class="card-title color-blue col-md-10">{{ __('lang.time_begin') . '*' }}</h5>
                                </div>
                                <div class="row justify-content-center">
                                    
                                    <div class="col-md-5">
                                        
                                        <input type="time" class="form-control" name="time_begin" required>
                                    </div>
                                    <div class="col-md-5">  
                                        <input type="date" class="form-control" name="date_begin" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <h5 class="card-title color-blue col-md-10">{{ __('lang.time_finish') . '*' }}</h5>
                                </div>
                                <div class="row justify-content-center">
                                    
                                    <div class="col-md-5">
                                        
                                        <input type="time" class="form-control" name="time_finish" required>
                                    </div>
                                    <div class="col-md-5">  
                                        <input type="date" class="form-control" name="date_finish" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <h5 class="card-title color-blue">{{ __('lang.min_credit') . '*' }}</h5>
                                        <input type="number" class="form-control" name="min_credit" min="0" required>
                                    </div>
                                    <div class="col-md-5"> 
                                        <h5 class="card-title color-blue">{{ __('lang.max_credit') . '*' }}</h5>
                                        <input type="number" class="form-control" name="max_credit" min="0" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <h5 class="card-title color-blue">{{ __('lang.semester') }}</h5>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <button type="button" data-toggle="modal" data-target="#createSemesterModal">
                                                    <i class="fas fa-plus-circle color-blue"></i>
                                                </button>
                                            </div>
                                            <div class="col">
                                                <select class="custom-select" name="semester" id="semesterSelect">
                                                    @foreach ($semesters as $semester)
                                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                                          
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <h5 class="card-title color-blue">{{ __('lang.department') }}</h5>
                                        <select class="custom-select" name="department">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->description }}</option>
                                                  
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <h5 class="card-title color-blue">{{ __('lang.available_generation') . '*' }}</h5>
                                        
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="card col-md-10">
                                        <div class="card-body">
                                            <div class="row justify-content-center">
                                                @foreach ($generations as $generation)
                                                    <div class="col-md-3 d-flex justify-content-center">
                                                        <p class="card-text">
                                                            <input type="checkbox" value="{{ $generation->id }}"
                                                            name="generations[]">
                                                            {{ ' ' . $generation->name }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                            <div class="row justify-content-center">
                                                {{ $generations->links() }}
                                            </div>
                                        </div>
                                    </div>
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
                            @if (session('registration_id'))
                                <a href="{{ route('admins.registration-management.select-subjects',
                                    ['id' => session('registration_id')]) }}"class="btn btn-secondary submit-style">
                                    <i class="fas fa-forward"></i>
                                    {{ __('lang.select_subjects') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add semester --}}
    <div class="modal fade" id="createSemesterModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ __('lang.semester_create') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="alert-area">                       
                    </div>
                    <form method="POST" id="createSemesterForm">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">{{ __('lang.name') . '*' }}</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{ __('lang.begin_date') . '*' }}</label>
                            <input type="date" class="form-control" name="begin_date" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{ __('lang.finish_date') . '*' }}</label>
                            <input type="date" class="form-control" name="finish_date" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('lang.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('lang.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
