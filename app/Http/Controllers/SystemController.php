<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getAll(Request $request)
    {
        return System::all();
    }
}
