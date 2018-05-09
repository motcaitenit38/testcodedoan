<?php

namespace App\Http\Controllers\Timviec;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/timviec/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('timviec.auth:timviec');
    }

    public function index() {
        return view('timviec.home');
    }

}