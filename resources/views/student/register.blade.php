@extends('student.layout.loginlayout')
@section('title')
    {{ trans('lang.student_register_title') }}
@endsection
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 register-background"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">{{ trans('lang.create_account') }}</h1>
                    </div>

                    <form class="user" action="{{ route('students.do_register') }}" method="POST">
                        @csrf
                        @if (count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif
                        @if (session('notification'))
                            <div class="alert alert-danger">
                                {{ session('notification') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="student_id"
                            placeholder="{{ trans('lang.student_id_card') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email"
                            placeholder="{{ trans('lang.email') }}" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" name="password"
                                placeholder="{{ trans('lang.password') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" name="rePassword"
                                placeholder="{{ trans('lang.confirm_password') }}" required>
                            </div>
                            <br> 
                        </div>
                        <input type="submit" name="register" value="{{ trans('lang.register') }}"
                        class="btn btn-primary btn-user btn-block">
                    </form>
                    
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('students.return_login') }}">{{ trans('lang.return_login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
