<?php
use Yajra\Datatables\Datatables;

function registrationDatatable($registrations)
{
    return Datatables::of($registrations)
        ->addIndexColumn()
        ->addColumn('datetime_begin', '{{ $time_begin . " " . $date_begin }}')
        ->addColumn('datetime_finish', '{{ $time_finish . " " . $date_finish }}')
        ->addColumn('time_status', function($registrations){
            $time_status = checkDateRegistration($registrations);
            if ($time_status == config('social.waiting')) {

                return '<p class="color-blue">' . __('lang.waiting_time') . '</p>';
            } elseif ($time_status == config('social.in-time')) {

                return '<p class="color-green">' . __('lang.in_time') . '</p>';
            } else {

                return '<p class="color-red">' . __('lang.out_of_time') . '</p>';
            }
        })
        ->editColumn('status', function($registrations){
            if ($registrations->status == config('social.active')) {

                return '<p class="color-green">' . __('lang.active') . '</p>';
            } else {

                return '<p class="color-red">' . __('lang.disable') . '</p>';
            }
        })
        ->addColumn('manager', function($registrations){
            $str = '<div class="d-flex justify-content-center">';
            $str .= '<a href="' . route('registration-management.show', ['id' => $registrations->id]) . '" data-toggle="tooltip" data-placement="top" title="' . __('lang.view_detail') . '">
                        <button class="color-blue">
                            <i class="fas fa-eye"></i>
                        </button>
                    </a>';
            $time_status = checkDateRegistration($registrations);

            if ($time_status == 0) {
                $str .= '<a href="" data-toggle="tooltip" data-placement="top" title="'
                    . __('lang.update') . '">
                            <button class="color-blue">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>';
                $str .= '<a href="" data-toggle="tooltip" data-placement="top" title="'
                    . __('lang.delete') . '">
                            <button class="color-red">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </a>';
            } elseif ($time_status == 1) {
                $str .= '<a href="" data-toggle="tooltip" data-placement="top" title="'
                    . __('lang.update') . '">
                            <button class="color-blue">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>';   
            }
            $str .= '</div>';
            return $str;
        })
        ->rawColumns(['time_status', 'status', 'manager'])
        ->toJson();
}
