<?php

namespace App\Http\Controllers;

use App\Models\Franchises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;


class FranchiseController extends Controller
{   
    
   
    public function franchiseLogin(Request $req){
        if($req->method() == "POST"){
           $data = $req->only(["email","password"]);
           
           if(Auth::guard("franchise")->attempt($data)){
                $franchise =  Auth::guard('franchise')->user();
                if($franchise->status){
                    return redirect()->route("superadmin.panel");
                }
                else{
                    return redirect()->back()->with("alert","your account is disabled");
                }
           }
           else{
                return redirect()->route("franchise.login")->with("alert","Please enter valid email or password");;
           }
        }
        return view('franchises.loginFranchises');
    }
    public function insertFranchises()
    {
        return view('franchises.insertFranchises');
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
        return view('franchises.manageFranchises', compact('franchises', 'search'));
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
            'branch_name'=>'required|string',
            'bank_name'=>'required|string',
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
        $pincode = $validatedData['pincode'];
    $pinResponse = Http::get("https://api.postalpincode.in/pincode/{$pincode}");

    if ($pinResponse->successful() && isset($pinResponse->json()[0]['PostOffice'][0])) {
        $pinData = $pinResponse->json()[0]['PostOffice'][0];
        $validatedData['city'] = $pinData['City'] ?? 'NULL';
        $validatedData['state'] = $pinData['State'] ?? 'NULL';
        $validatedData['country'] = $pinData['Country'] ?? 'NULL';
        $validatedData['district'] = $pinData['District'] ?? 'NULL';
    } else {
        return back()->withErrors(['pincode' => 'Invalid Pincode']);
    }

    $ifsc = $validatedData['ifsc_code'];
    $response = Http::get("https://ifsc.razorpay.com/{$ifsc}");

    if ($response->successful()) {
        $branchData = $response->json();
        $validatedData['branch_name'] = $branchData['BRANCH'] ?? 'NULL';
        $validatedData['bank_name'] = $branchData['BANK'] ?? 'NULL';
    } else {
        return back()->withErrors(['ifsc_code' => 'Invalid IFSC Code']);
    }

        $validatedData['password'] = Hash::make($validatedData['password']);
        // dd($validatedData);
        Franchises::create($validatedData);

        return redirect()->route('franchises.manageFranchises')->with('success', 'Franchise created successfully.');
    }




    public function deleteFranchises($id)
    {
        // Retrieve a single franchise by ID
        $franchise = Franchises::find($id);

        // Check if the franchise exists
        if (!$franchise) {
            return redirect()->route('franchises.manageFranchises')->with('error', 'Franchise not found.');
        }

        // Delete the franchise
        $franchise->delete();

        return redirect()->route('franchises.manageFranchises')->with('success', 'Franchise deleted successfully.');
    }
    public function editFranchises($id)
    {
        $franchise = Franchises::findOrFail($id);
        return view('franchises.editFranchises', compact('franchise'));
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
            'branch_name'=>'required|string',
            'bank_name'=>'required|string',
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

        $pincode = $validatedData['pincode'];
        $pinResponse = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
    
        if ($pinResponse->successful() && isset($pinResponse->json()[0]['PostOffice'][0])) {
            $pinData = $pinResponse->json()[0]['PostOffice'][0];
            $validatedData['city'] = $pinData['City'] ?? 'NULL';
            $validatedData['state'] = $pinData['State'] ?? 'NULL';
            $validatedData['country'] = $pinData['Country'] ?? 'NULL';
            $validatedData['district'] = $pinData['District'] ?? 'NULL';
        } else {
            return back()->withErrors(['pincode' => 'Invalid Pincode']);
        }
    
        $ifsc = $validatedData['ifsc_code'];
        $response = Http::get("https://ifsc.razorpay.com/{$ifsc}");
    
        if ($response->successful()) {
            $branchData = $response->json();
            $validatedData['branch_name'] = $branchData['BRANCH'] ?? 'NULL';
            $validatedData['bank_name'] = $branchData['BANK'] ?? 'NULL';
        } else {
            return back()->withErrors(['ifsc_code' => 'Invalid IFSC Code']);
        }

        // Hash password only if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $franchise->update($validatedData);

        return redirect()->route('franchises.manageFranchises')
            ->with('success', 'franchise updated successfully');
    }


    public function viewFranchises($id)
    {
        $franchise = Franchises::findOrFail($id);
        return view('franchises.viewFranchises', compact('franchise'));
    }

    
}
