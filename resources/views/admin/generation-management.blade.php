@extends('admin.layout.homelayout')
@section('title')
    {{ __('lang.student_generation_management') }}
@endsection
@section('link')
    <div class="margin-top-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb background-color-white">
                <li class="breadcrumb-item"><a href="{{ route('admins.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.student_generation_management') }}</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="content-page-size">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="admin-profile-title">{{ __('lang.student_generation_management') }}</div>
                <br><br><br>
                <div class="d-flex justify-content-center">
                    <div class="generation-table-size">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger text-center">
                                @foreach ($errors->all() as $err)
                                    {{ $err }}
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
                        <table id="generation-table">
                            <thead>
                                <tr>
                                    <th>{{ __('lang.ordinal_number') }}</th>
                                    <th>{{ __('lang.generation') }}</th>
                                    <th>{{ __('lang.begin_year') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                        <br><br>
                        <div class="d-flex justify-content-center">
                            <button class="btn" data-toggle="modal" data-target="#addModal">
                                <i class="fas fa-plus">{{ ' ' .  __('lang.add') }}</i>
                            </button>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="generationTableAjaxRoute" value="{{ route('admins.generation-table-ajax') }}">
    {{-- UpdateModal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('lang.generation_update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" id="updateForm">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('lang.generation') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{ __('lang.begin_year') }}</label>
                             <input type="number" min="1990" max="2100" class="form-control" id="begin_year"
                             name="begin_year" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('lang.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('lang.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- AddModal --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ __('lang.generation_update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="GET" id="addForm" action="{{ route('admins.add-generation') }}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ __('lang.generation') }}</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{ __('lang.begin_year') }}</label>
                             <input type="number" min="1990" max="2100" class="form-control" id="addBeginYear"
                             name="begin_year" required>
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
