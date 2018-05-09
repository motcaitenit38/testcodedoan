<?php

namespace App\Http\Controllers\Tuyendung;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/tuyendung/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('tuyendung.auth:tuyendung');
    }

    public function index() {
        return view('tuyendung.home');
    }

}