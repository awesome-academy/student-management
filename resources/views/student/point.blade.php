@extends('student.layout.homelayout')
@section('title')
    {{ __('lang.check_point') }}
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
        <h3 class="text-center">{{ __('lang.point_table') }}</h3>
        <hr>   
    </div>
    @if (isset($fail))
        <div class="alert alert-danger text-center">
            {{ $fail }}
        </div>
    @else
        @if (isset($data))
            @foreach ($data as $dt)
                <div class="d-flex justify-content-center">
                    <table class="table table-style schedule-table-size">
                        <caption>{{ $dt['semester']->name }}</caption>
                        <thead class="thead-red">
                            <tr>
                                <th id="ordinal_number">{{ __('lang.ordinal_number') }}</th>
                                <th id="subject">{{ __('lang.subject') }}</th>
                                <th>{{ __('lang.credit') }}</th>
                                <th>{{ __('lang.CC_percent') }}</th>
                                <th>{{ __('lang.KT_percent') }}</th>
                                <th>{{ __('lang.T_percent') }}</th>
                                <th>{{ __('lang.attendence_point') }}</th>
                                <th>{{ __('lang.test_point') }}</th>
                                <th>{{ __('lang.final_exam_point') }}</th>
                                <th>{{ __('lang.final_point') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                        </thead>
                                
                        <tbody>
                            @foreach ($dt['classes'] as $class)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @foreach ($class->getSubject()->get() as $subject)
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->credits }}</td>
                                    @endforeach
                                    @foreach ($class->getSubject()->first()->getRatePoint()->get() as $rate_point)
                                        <td>{{ $rate_point->attendance }}%</td>
                                        <td>{{ $rate_point->test }}%</td>
                                        <td>{{ $rate_point->final_exam }}%</td>
                                    @endforeach
                                    @if ($class->getTranscript()->count() > 0)
                                        @foreach ($class->getTranscript()->get() as $transcript)
                                            @if ($transcript->getStudent()->first()->id == $student->id)
                                                <td>{{ $transcript->attendance_point }}</td>
                                                <td>{{ $transcript->test_point }}</td>
                                                <td>{{ $transcript->final_exam_point }}</td>
                                                <td>{{ $transcript->final_point }}</td>
                                                @if ($transcript->final_point >= 4)
                                                    <td>{{ __('lang.pass_subject') }}</td>
                                                @else
                                                    <td>{{ __('lang.fail_subject') }}</td>
                                                @endif
                                                @break
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ __('lang.none') }}</td>
                                        <td>{{ __('lang.none') }}</td>
                                        <td>{{ __('lang.none') }}</td>
                                        <td>{{ __('lang.none') }}</td>
                                        <td>{{ __('lang.in_progress') }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach     
        @endif
    @endif 
@endsection
