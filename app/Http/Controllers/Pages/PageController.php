<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index()
    {
        return view('home');
    }

    public function store()
    {
        return view('home');
    }
}
