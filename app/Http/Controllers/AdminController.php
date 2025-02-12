<?php

namespace App\Http\Controllers;
use App\Mail\FranchiseCreated;
use App\Models\Franchises;
use App\Models\Receptioner;
use App\Models\Staff;
use App\Services\FranchiseService;
use DB;
use Hash;
use App\Models\Request as RequestModel;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mail;
class AdminController extends Controller
{
    protected $franchiseService;

    public function dashboard()
    {
        $counts = DB::select("
            SELECT 
                (SELECT COUNT(*) FROM franchises) AS franchiseCount,
                (SELECT COUNT(*) FROM staff) AS staffCount,
                (SELECT COUNT(*) FROM receptioners) AS receptionerCount
        ");

        $data['franchises'] = Franchises::paginate(10);
        $data['counts'] = (object) $counts[0];

        return view('admin.dashboard', $data);
    }

    public function __construct(FranchiseService $franchiseService)
    {
        $this->franchiseService = $franchiseService;
    }

    public function toggleStatus($id)
    {
        $newStatus = $this->franchiseService->toggleStatus($id);

        return redirect()->route('admin.panel')->with('success', "Status updated to $newStatus.");
    }



    public function adminlogin(Request $req)
    {
        // Check if the user is already logged in as an admin
        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin.panel"); // Redirect to dashboard if already logged in
        }

        if ($req->method() == "POST") {
            $this->validate($req, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $req->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route("admin.panel"); // Redirect to dashboard if login successful
            } else {
                return redirect()->back()->with("alert", "Invalid email or password.");
            }
        }

        return view('admin.adminLogin');
    }
    public function insertFranchises()
    {
        return view('admin.insertFranchises');
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
        $franchises = $franchises->paginate(10);
        return view('admin.manageFranchises', compact('franchises', 'search'));
    }

    public function managetoggleStatus($id, FranchiseService $franchiseService)
    {
        $newStatus = $franchiseService->toggleStatus($id);

        return redirect()->route('admin.manageFranchises')->with('success', "Status updated to $newStatus.");
    }

    public function storeFranchises(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'franchise_name' => 'required|string|max:255',
            'contact_no' => 'required|string|unique:franchises|max:15',
            'email' => 'required|email|unique:franchises|max:255|regex:/^[\w\.]+@[\w]+\.[a-z]{2,3}$/',
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

        // Handling the pincode to get location details
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

        // Handling IFSC to get bank details
        $ifsc = $validatedData['ifsc_code'];
        $response = Http::get("https://ifsc.razorpay.com/{$ifsc}");

        if ($response->successful()) {
            $branchData = $response->json();
            $validatedData['branch_name'] = $branchData['BRANCH'] ?? 'NULL';
            $validatedData['bank_name'] = $branchData['BANK'] ?? 'NULL';
        } else {
            return back()->withErrors(['ifsc_code' => 'Invalid IFSC Code']);
        }

        // Inside the controller method
        $validatedData['password'] = Hash::make($validatedData['password']);

        $franchise = Franchises::create($validatedData);

        Mail::to($franchise->email)->send(new FranchiseCreated($franchise));


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
        $franchise_id = $request->get('franchise_id');

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
        if ($franchise_id) {
            $staffQuery->where('franchise_id', $franchise_id);
        }
        $data['staffs'] = $staffQuery->paginate(10);
        $data['franchises'] = Franchises::all();

        return view('admin.manageStaff', $data);
    }
    public function manageRequest(Request $request)
    {
        $search = $request->get('search');
        $receptionist_id = $request->get('receptionist_id');
        $franchise_id = $request->get('franchise_id');

        $requests = RequestModel::query()
            ->where(function ($query) use ($search) {
                $query->where('technician_id', '<>', null)
                    ->where('owner_name', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('receptionist', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });

        if ($franchise_id) {
            $requests->whereHas('receptionist', function ($query) use ($franchise_id) {
                $query->where('franchise_id', $franchise_id);
            });
        }

        if ($receptionist_id) {
            $requests->where('receptionist_id', $receptionist_id);
        }

        $requests = $requests->paginate(10);

        $staffs = Staff::all();
        $franchises = Franchises::all();

        return view('admin.manageRequest', compact('requests', 'staffs', 'search', 'franchises', 'franchise_id', 'receptionist_id'));
    }




    public function manageReceptioners(Request $request)
    {

        $search = $request->get('search');
        $franchise_id = $request->get('franchise_id');

        $receptionerQuery = Receptioner::query();
        if ($search) {
            $receptionerQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('contact', 'like', '%' . $search . '%')
                    ->orWhereHas('franchise', function ($query) use ($search) {
                        $query->where('franchise_name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($franchise_id) {
            $receptionerQuery->where('franchise_id', $franchise_id);
        }
        $receptioners = $receptionerQuery->paginate(10);
        $franchises = Franchises::all();
        return view('admin.manageReceptioner', compact('receptioners', 'search', 'franchise_id', 'franchises'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

}