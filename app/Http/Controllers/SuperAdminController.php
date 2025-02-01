<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(){
        return view('superadmin.dashboard');
    }

    public function insertFranchises()
    {
        return view('superadmin.insertFranchises');
    }
    public function manageFranchises(){
        $franchises = Franchises::all();
        return view('superadmin.manageFranchises', compact('franchises'));
    }
}
