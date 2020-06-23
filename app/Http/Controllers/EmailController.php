<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index() {
        try {
            return view('email.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
