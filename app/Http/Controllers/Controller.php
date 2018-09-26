<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	cookie('locale', LaravelLocalization::getCurrentLocale());
    	cookie('query', $_SERVER['QUERY_STRING']);

        // session([
        //     'locale' => LaravelLocalization::getCurrentLocale(),
        //     'query'  => $_SERVER['QUERY_STRING'],
        // ]);
    }
}
