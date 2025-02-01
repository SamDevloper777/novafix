<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Franchises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function dashboard(){
        return view('superadmin.dashboard');
    }

    public function insertFranchises()
    {
        return view('superadmin.Franchises.insertFranchises');
    }

    public function storeFranchises(Request $request)
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

        return redirect()->route('franchises.manageFranchises')->with('success', 'Franchise created successfully.');
    }

    public function manageFranchises(){
        $franchises = Franchises::all();
        return view('superadmin.Franchises.manageFranchises', compact('franchises'));
    }


    public function deleteFranchises($id)
    {
        // Retrieve a single franchise by ID
        $franchise = Franchises::find($id);
    
        // Check if the franchise exists
        if (!$franchise) {
            return redirect()->route('superadmin.manageFranchises')->with('error', 'Franchise not found.');
        }
    
        // Delete the franchise
        $franchise->delete();
    
        return redirect()->route('superadmin.manageFranchises')->with('success', 'Franchise deleted successfully.');
    }
    public function editFranchises($id)
    {
        $franchise = Franchises::findOrFail($id);
        return view('superadmin.Franchises.editFranchises', compact('franchise'));
    }
    
    public function updateFranchises(Request $request, $id)
    {
        $franchise = Franchises::findOrFail($id);
    
        $validatedData = $request->validate([
            'franchise_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15|unique:franchises,contact_no,' . $franchise->id,
            'email' => 'required|email|max:255|unique:franchises,email,' . $franchise->id,
            'password' => 'nullable|string|min:8',
            'aadhaar_no' => 'required|string|max:20|unique:franchises,aadhaar_no,' . $franchise->id,
            'pan_no' => 'required|string|max:20|unique:franchises,pan_no,' . $franchise->id,
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
    
        // Hash password only if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }
    
        $franchise->update($validatedData);
    
        return redirect()->route('franchises.manageFranchises')
            ->with('success', 'Franchise updated successfully');
    }
    
    
}
