<?php

namespace App\Http\Controllers;

use App\Services\Traits\ImageHelpers;
use App\Services\Traits\OrderTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ImageHelpers;
    const TAKE_ALL = 500;
    const TAKE = 100;
    const TAKE_MID = 24;
    const TAKE_MIN = 12;
    const TAKE_LESS = 10;
    const TAKE_LEAST = 5;
    const TAKE_TINY= 2;
}
