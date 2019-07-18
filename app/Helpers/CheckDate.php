<?php

function checkDateRegistration($registration)
{
    $now = date('Y-m-d h:i:sa');
    $time_begin = $registration->time_begin;
    $date_begin = $registration->date_begin;
    $time_finish = $registration->time_finish;
    $date_finish = $registration->date_finish;
    $d = strtotime($time_begin . ' ' . $date_begin);
    $begin = date('Y-m-d h:i:sa', $d);
    $dd = strtotime($time_finish . ' ' . $date_finish);
    $finish = date('Y-m-d h:i:sa', $dd);

    $time_status = config('social.waiting');
    if ($begin <= $now && $now <= $finish) {
        $time_status = config('social.in-time');
    } elseif ($now > $finish) {
        $time_status = config('social.out-of-time');
    }

    return $time_status;
}
