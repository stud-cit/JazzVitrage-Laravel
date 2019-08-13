<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('application');
    }
    public function store(Request $request)
    {
        // TO DO
    }
}
