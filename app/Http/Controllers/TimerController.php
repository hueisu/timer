<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimerController extends Controller
{
    public function show() {
        return view('timer');
    }

    public function getTime() {
        return 'time';
    }
}
