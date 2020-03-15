<?php

namespace App\Http\Controllers;

use App\Stats;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    function getStats(){
        return Stats::orderBy('date_published', 'desc')->first();
    }
}
