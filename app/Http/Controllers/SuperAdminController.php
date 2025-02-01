<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.dashboard');
    }

    public function insertFranchises()
    {
        return view('superadmin.insertFranchises');
    }

    public function manageFranchises(Request $request)
    {
        $search = $request->get('search');

        $franchises = Franchises::query();

        if ($search) {
            $franchises->where(function ($query) use ($search) {
                $query->where('franchise_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('contact_no', 'like', '%' . $search . '%')
                    ->orWhere('state', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }
        $franchises = $franchises->get();
        return view('superadmin.manageFranchises', compact('franchises', 'search'));
    }



}
