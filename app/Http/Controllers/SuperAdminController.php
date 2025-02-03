<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    
    public function dashboard(){
        return view('superadmin.dashboard');
    }

}
