<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FranchiseController extends Controller
{
    public function index()
    {
        return view('superadmin.insertFranchise');
    }
}
