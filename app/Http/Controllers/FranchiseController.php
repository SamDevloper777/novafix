<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Franchises;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FranchiseController extends Controller
{
    public function index()
    {
        $franchises = Franchises::all();
        return view('superadmin.insertFranchise', compact('franchises'));
    }
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'franchise_name' => 'required|string|max:255',
            'contact_no' => 'required|string|unique:franchises|max:15',
            'email' => 'required|email|unique:franchises|max:255',
            'password' => 'required|string|min:8',
            'aadhaar_no' => 'required|string|unique:franchises|max:20',
            'pan_no' => 'required|string|unique:franchises|max:20',
            'ifsc_code' => 'required|string|max:20',
            'account_no' => 'required|string|max:20',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'doc' => 'required|date',
            'status' => 'required|in:Active,Inactive',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        // dd($validatedData);
        Franchises::create($validatedData);

        return redirect()->route('superadmin.manageFranchises')->with('success', 'Franchise created successfully.');
    }


}