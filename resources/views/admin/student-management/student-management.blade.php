@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.student_management') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.student_management') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="student-managerment-content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.student_generation_management') }}</div>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="student-table-size">
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
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('student-management.create') }}" class="btn">
                                <i class="fas fa-plus">{{ ' ' .  __('lang.add') }}</i>
                            </a>
                        </div>
                        <table id="student-table">
                            <thead>
                                <tr>
                                    <th>{{ __('lang.ordinal_number') }}</th>
                                    <th>{{ __('lang.full_name') }}</th>
                                    <th>{{ __('lang.id_card') }}</th>
                                    <th>{{ __('lang.birth') }}</th>
                                    <th>{{ __('lang.phone') }}</th>
                                    <th>{{ __('lang.local_address') }}</th>
                                    <th>{{ __('lang.current_address') }}</th>
                                    <th>{{ __('lang.generation') }}</th>
                                    <th>{{ __('lang.department') }}</th>
                                    <th>{{ __('lang.avatar') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                        <br><br>
                        
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="studentTableAjaxRoute" value="{{ route('admins.student-management.ajax') }}">
    <!-- Modal -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('lang.confirm') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('lang.confirm_to_delete') }}
                </div>
                <div class="modal-footer">
                    <form id="confirmDeleteStudentForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('lang.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">{{ __('lang.save') }}</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
