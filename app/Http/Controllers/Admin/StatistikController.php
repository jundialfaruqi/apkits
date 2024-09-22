<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $title = "Statistik";
        return view('admin.statistik.index', compact('title'));
    }
}
