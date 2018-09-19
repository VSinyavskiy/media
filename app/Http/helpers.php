<?php

use Carbon\Carbon;

/**
 * Creates JSON params for html
 */
function makeJsonParams($params)
{
    $params = collect($params)->map(function($i) {
        return str_replace("'", '’', $i);
    })->toArray();

    return json_encode($params);
}

/**
 * Boolean lists helpers (for datatables or other)
 */
function getBooleanSearchList()
{
    return [
        true  => __('admin_layout.global.yes'),
        false => __('admin_layout.global.no'),
    ];
}

function getBooleanText($var)
{
    $list = getBooleanSearchList();

    return isset($list[$var]) ? $list[$var] : null;
}

function getBooleanSearchJson()
{
    return makeJsonParams(getBooleanSearchList());
}

function isUserAuthorize()
{
    return auth()->guard('web')->user() && auth()->guard('web')->user()->role == \App\Models\User::ROLE_USER;
}

function pluralize($n, $form1, $form2, $form5)
{
    $n = abs($n) % 100;
    $n1 = $n % 10;
    if ($n > 10 && $n < 20) return $form5;
    else if ($n1 > 1 && $n1 < 5) return $form2;
    else if ($n1 == 1) return $form1;

    return $form5;
}

function getNowTimestamp()
{
    return Carbon::now(config('app.timezone'));
}

function getTimestampFromDateTime($dateTime) // \DateTime
{
    return Carbon::parse($dateTime, config('app.timezone'));
}
