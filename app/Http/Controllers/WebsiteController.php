<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Function for displaying View for Index page
     */
    public function index(){
        return view('welcome');
    }
}
