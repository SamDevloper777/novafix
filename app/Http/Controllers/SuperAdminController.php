<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(){
        return view('superadmin.dashboard');
    }
    public function insertFranchises(){
        return view('superadmin.addFranchises');
    }public function manageFranchises(){
        return view('superadmin.manageFranchises');
    }
}
