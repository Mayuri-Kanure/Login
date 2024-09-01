<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // This method will show dashboard page for admin
    public function index(){
        return view('admin.dashboard');
    }
}
