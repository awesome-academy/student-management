@extends('student.layout.loginlayout')
@section('title')
    {{ trans('lang.student_login_title') }}
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block login-background">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ trans('lang.login') }}</h1>
                                </div>
                    
                                <form class="user" method="POST" action="{{ route('students.do_login') }}">
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
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name='email' id="email"placeholder="{{ trans('lang.email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                        placeholder="{{ trans('lang.password') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" name ="remember" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">
                                                {{ trans('lang.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <input type="submit" name="login" id="login" value="Đăng nhập" class="btn btn-primary btn-user btn-block">
                                </form>
                    
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('students.return_register') }}">
                                        {{ trans('lang.create_account') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
                
@endsection
