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
        // return response()->json($franchises);
        return view('superadmin.insertFranchise');
    }

    public function store(Request $request)
    {
        $request->validate([
            'franchise_name' => 'required|string|max:255',
            'contact_no' => 'required|digits:10|unique:franchises',
            'email' => 'required|email|unique:franchises',
            'password' => 'required|min:6',
            'aadhaar_no' => 'required|digits:12|unique:franchises',
            'pan_no' => 'required|string|size:10|unique:franchises',
            'ifsc_code' => 'required|string|max:10',
            'account_no' => 'required|string|max:12',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'doc' => 'required|date',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $franchise = Franchises::create([
            'franchise_name' => $request->franchise_name,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'aadhaar_no' => $request->aadhaar_no,
            'pan_no' => $request->pan_no,
            'ifsc_code' => $request->ifsc_code,
            'account_no' => $request->account_no,
            'street' => $request->street,
            'city' => $request->city,
            'district' => $request->district,
            'pincode' => $request->pincode,
            'state' => $request->state,
            'country' => $request->country,
            'doc' => $request->doc,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Franchise added successfully', 'data' => $franchise]);
    }

    public function show($id)
    {
        $franchise = Franchises::findOrFail($id);
        return response()->json($franchise);
    }

    public function update(Request $request, $id)
    {
        $franchise = Franchises::findOrFail($id);

        $request->validate([
            'franchise_name' => 'sometimes|string|max:255',
            'contact_no' => 'sometimes|digits:10|unique:franchises,contact_no,' . $id,
            'email' => 'sometimes|email|unique:franchises,email,' . $id,
            'aadhaar_no' => 'sometimes|digits:12|unique:franchises,aadhaar_no,' . $id,
            'pan_no' => 'sometimes|string|size:10|unique:franchises,pan_no,' . $id,
            'ifsc_code' => 'sometimes|string|max:10',
            'account_no' => 'sometimes|string|max:12',
            'street' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:100',
            'district' => 'sometimes|string|max:100',
            'pincode' => 'sometimes|digits:6',
            'state' => 'sometimes|string|max:100',
            'country' => 'sometimes|string|max:100',
            'doc' => 'sometimes|date',
            'status' => ['sometimes', Rule::in(['Active', 'Inactive'])],
        ]);

        $franchise->update($request->all());

        return response()->json(['message' => 'Franchise updated successfully', 'data' => $franchise]);
    }

    public function destroy($id)
    {
        $franchise = Franchises::findOrFail($id);
        $franchise->delete();

        return response()->json(['message' => 'Franchise deleted successfully']);
    }
}
