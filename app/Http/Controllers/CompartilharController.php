<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompartilharController extends Controller
{
    public function index()
    {
        return view('compartilhar.index');
    }
}
