<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // This page will show dashboard page for customer
    public function index(){
        return view('dashboard');
    }
}
