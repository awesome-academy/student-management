@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.update_information') }}
@endsection
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('students.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('students.return_information') }}">
                        {{ __('lang.check_information') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.update_information') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content-margin">
        <h3 class="text-center">{{ __('lang.update_information') }}</h3>
        <br>
        <form action="{{ route('student.do_update_information') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($student))
                @if (!empty($student->avatar))
                    <img src="{{ config('social.student-img') . $student->avatar }}" alt="{{ __('lang.avatar') }}"
                    class="img-thumbnail avatar-size" id="avatar">
                @else
                    <img src="{{ config('social.student-default-img') }}" alt="{{ __('lang.avatar') }}"
                    class="img-thumbnail avatar-size" id="avatar">
                    <div class="alert alert-danger avatar-arlert-size">
                        {{ __('lang.non_avatar') }}
                    </div>
                @endif
                <div class="form-group max-width-400">
                    <label for="exampleFormControlFile1">{{ __('lang.change_avatar') }}</label>
                    <input type="file" class="form-control-file" onchange="previewFile()" name="avatar">
                </div>
                <div>
                    @if (count($errors)>0)
                            <div class="alert alert-danger text-center">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                    @if (session('notification'))
                        <div class="alert alert-danger text-center">
                            {{ session('notification') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label>{{ __('lang.full_name') }}</label>
                                <input type="text" class="form-control" name="full_name" value="{{ $student->full_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.birth') }}</label>
                                <input type="date" class="form-control" name="birth" value="{{ $student->birth }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.local_address') }}</label>
                                <input type="text" class="form-control" name="local_address"
                                value="{{ $student->local_address }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.generation') }}</label>
                                <input type="text" class="form-control" name="generation"
                                value="{{ $student->getGeneration->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label>{{ __('lang.id_card') }}</label>
                                <input type="text" class="form-control" name="id_card" value="{{ $student->id_card }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.phone') }}</label>
                                <input type="text" class="form-control" name="phone" value="{{ $student->phone }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.current_address') }}</label>
                                <input type="text" class="form-control" name="current_address"
                                value="{{ $student->current_address }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('lang.department') }}</label>
                                <input type="text" class="form-control" name="department"
                                value="{{ $student->getDepartment->name }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <br>
                    <input type="submit" name="update" id="update" value="{{ __('lang.update_information') }}"
                    class="btn btn-primary btn-user btn-update">
                </div>
            @endif
        </form>

    </div>
@endsection
