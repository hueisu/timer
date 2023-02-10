<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TimerController extends Controller
{
    public function show() {
        return Inertia::render('Timer');
    }

    public function getTime() {
        return 'time';
    }
}
