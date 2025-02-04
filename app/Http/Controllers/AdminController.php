<?php

namespace App\Http\Controllers;
use App\Models\Franchises;
use App\Models\Staff;
use Hash;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class AdminController extends Controller
{
    public function dashboard()
    {
        $data['franchises'] = Franchises::all();
        return view('admin.dashboard', $data);
    }

    public function insertFranchises()
    {
        return view('admin.insertFranchises');
    }
    public function adminlogin(Request $req)
    {
        if ($req->method() == "POST") {
            $this->validate($req, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $req->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route("admin.panel");
            } else {
                return redirect()->back()->with("alert", "Invalid email or password.");
            }
        }

        return view('admin.adminLogin');
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
        return view('admin.manageFranchises', compact('franchises', 'search'));
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
            'branch_name' => 'required|string',
            'bank_name' => 'required|string',
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

        return redirect()->route('admin.manageFranchises')->with('success', 'Franchise created successfully.');
    }
    public function deleteFranchises($id)
    {
        $franchise = Franchises::find($id);
        if (!$franchise) {
            return redirect()->route('admin.manageFranchises')->with('error', 'Franchise not found.');
        }
        $franchise->delete();
        return redirect()->route('admin.manageFranchises')->with('success', 'Franchise deleted successfully.');
    }
    public function editFranchises($id)
    {
        $franchise = Franchises::findOrFail($id);
        return view('admin.editFranchises', compact('franchise'));
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
            'branch_name' => 'required|string',
            'bank_name' => 'required|string',
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

        return redirect()->route('admin.manageFranchises')
            ->with('success', 'franchise updated successfully');
    }


    public function viewFranchises($id)
    {
        $franchise = Franchises::findOrFail($id);
        return view('admin.viewFranchises', compact('franchise'));
    }

    public function manageStaffs(Request $request)
    {
        $search = $request->get('search');    
    
        $staffQuery = Staff::query();
    
        if ($search) {
            $staffQuery->where(function ($query) use ($search) {
                $query->where('staff.name', 'like', '%' . $search . '%')
                    ->orWhere('staff.email', 'like', '%' . $search . '%')
                    ->orWhere('staff.contact', 'like', '%' . $search . '%')
                    ->orWhereHas('franchise', function ($query) use ($search) {
                        $query->where('franchise_name', 'like', '%' . $search . '%');
                    });
            });
        }
    
        $data['staffs'] = $staffQuery->get();
    
        return view('admin.manageStaff', $data);
    }
    
}