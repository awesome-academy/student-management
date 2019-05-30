@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.schedule') }}
@endsection
@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('students.return_home') }}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.schedule') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content-margin">
        <h3 class="text-center">{{ __('lang.schedule') }}</h3>
        <hr>   
    </div>
    @if (isset($fail))
        <div class="alert alert-danger text-center">
            {{ $fail }}
        </div>
    @else
        @if (isset($semester) && isset($weeks))
            <div class="d-flex justify-content-center">
                <h6 class="text-color-red"><u>{{ $semester->name }}</u></h6>
            </div>
            <form action="{{ route('students.return_schedule') }}" method="GET" id="week">
                <div class="d-flex justify-content-center">
                    <div class="input-group mb-3 width-40">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">
                                {{ __('lang.select_week') }}
                            </label>
                        </div>
                        <select class="custom-select" id="weekSelect" name="weekSelect"
                        onchange="document.getElementById('week').submit()">
                            @if (isset($now_week))
                                @foreach ($weeks as $week)
                                    @if ($week['id'] == $now_week)
                                        <option value="{{ $week['id'] }}" selected>
                                            {{ __('lang.week') . ' ' . $week['id'] . ' ' . __('lang.from') . ' ' . $week['begin_date'] . ' ' . __('lang.to') . ' ' . $week['finish_date'] }}
                                        </option>
                                    @else
                                        <option value="{{ $week['id'] }}">
                                            {{ __('lang.week') . ' ' . $week['id'] . ' ' . __('lang.from') . ' ' . $week['begin_date'] . ' ' . __('lang.to') . ' ' . $week['finish_date'] }}
                                        </option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($weeks as $week)
                                    <option value="{{ $week['id'] }}">
                                        {{ __('lang.week') . ' ' . $week['id'] . ' ' . __('lang.from') . ' ' . $week['begin_date'] . ' ' . __('lang.to') . ' ' . $week['finish_date'] }}
                                    </option>
                                @endforeach
                            @endif                        
                        </select>
                        
                    </div>
                </div>
            </form>
            <div class="d-flex justify-content-center">
                <table class="table table-bordered schedule-table-size" name="scheduleTable" id="scheduleTable">
                    <thead class="thead-red">
                        <tr>
                            <th></th>
                            @foreach ($days as $day)
                                <th scope="col">{{ $day->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                            
                    <tbody>
                        @foreach ($lessons as $lesson)
                            <tr class="schedule-row-height">
                                <th scope="row" class="row-title-color">{{ $lesson->name }}</th>
                                @foreach ($days as $day)
                                    <td id="{{ $day->id . $lesson->id }}" class="item-noData-display"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
    
@endsection
