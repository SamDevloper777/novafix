<?php

namespace App\Http\Controllers;

use App\Models\Franchises;
use App\Models\Receptioner;
use Illuminate\Http\RedirectResponse;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\touch_with_us;
use App\Models\Type;
use Carbon\Carbon;
use App\Models\Request as RequestModel; 
use Illuminate\View\View;




class FranchiseController extends Controller
{   
    public function index(){
        return view('franchises.dashboard');
    }
    
   
    public function franchiseLogin(Request $req){
        if($req->method() == "POST"){
           $data = $req->only(["email","password"]);
           
           if(Auth::guard("franchise")->attempt($data)){
                $franchise =  Auth::guard('franchise')->user();
                if($franchise->status){
                return redirect()->route("franchise.panel");
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

    public function franchiselogout(Request $req)
    {
        Auth::guard("franchise")->logout();
        return redirect()->back();
    }

    public function staffUpload(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:App\Models\Staff,email|email',
            'contact' => 'required|integer|unique:App\Models\Staff,contact|digits:10',
            'salary' => 'required',
            'type_id' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ]);
        $data['status'] = 1;
        $data['franchise_id']=Auth::guard("franchise")->id();
        if ($request->image != null) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $data['image'] = $imageName;
        }
        Staff::create($data);
        return redirect()->route('franchise.staff.manage');

    }

    public function delete($id): RedirectResponse
    {
        Staff::where('id', $id)->delete();
        return redirect()->route('franchise.staff.manage');
    }
    public function crmDelete($id): RedirectResponse
    {
        Receptioner::where('id', $id)->delete();
        return redirect()->route('receptioner.showAllreceptioner');
    }

    public function deleteRequest($id): RedirectResponse
    {
        RequestModel::where('id', $id)->delete();
        return redirect()->route('franchise.newRequest.manage');
    }

    public function manageStaff(Request $req)
    {
        $data['staffs'] = Staff::where('franchise_id',Auth::id())->get();
        return view('franchises/manageStaff', $data);
    }

    public function insertStaff(Request $req)
    {
        $data['Types'] = Type::all();
        return view("franchises.insertStaff", $data);
    }

    public function editStaff($id)
    {
        $data = Staff::where('id', $id)->first();
        return view("franchises.editStaff", compact('data'));
    }

    public function viewStaff($id)
    {
        $data = Staff::where('id', $id)->first();
        return view("franchises.viewStaff", compact('data'));
    }


    public function update(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'salary' => 'required',
            'type_id' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'address' => 'required',

        ]);
        $data['status'] = ($req->status) ? 1 : 0;
        $id = $req->id;
        Staff::where('id', $id)->update($data);
        return redirect()->route('franchise.staff.manage');
    }


    public function search(Request $req): View
    {
        $search = $req->search;
        $data = Staff::where('name', 'LIKE', "%$search%")->paginate(8);
        return view('franchises/manageStaff', ['staffs' => $data]);
    }

    public function searchRequest(Request $req): View
    {
        $search = $req->search;
        $data = RequestModel::where('name', 'LIKE', "%$search%")->paginate(8);
        return view('franchises.newRequest.manage', ['new' => $data]);
    }



    public function status(Request $req, Staff $staff)
    {
        $staff->status = !$staff->status;
        $staff->save();

        return redirect()->back();

    }

    public function allnewRequest(Request $req)
    {
        $data['new'] = RequestModel::where('technician_id', NULL)->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "All New Request";
        $data['dateFilter'] = "all";
        return view('franchises/allnewRequest', $data);
    }
    public function manageRequest()
    {

        return view('franchises.manageRequest');
    }
    public function filterRequest(Request $req)
    {
        if ($req->search == "all") {

            $data['totalRequest'] = RequestModel::where('technician_id', '<>', null)->paginate(8);
        } else {
            $data['totalRequest'] = RequestModel::where('technician_id', $req->search)->paginate(8);

        }
        $data['staffs'] = Staff::all();
        // dd($req->search);

        return view('franchises.manageRequest', $data);

    }

    public function dateFilter(Request $req)
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $req->End);
        $date->addDays();
        $formattedDate = $date->format('Y-m-d');
        $data['new'] = RequestModel::select("*")->whereBetween('created_at', [$req->startAt, $formattedDate])
            ->paginate(8);
        $data['title'] = "Date between Request";
        return view('franchises/allnewRequest', $data);
    }
    public function filterBySelect(Request $req)
    {
        // $date = \Carbon\Carbon::now();
        // $date->subDays(7);
        // $formattedDate = $date->format('Y-m-d');
        // dd($formattedDate);
        // last month code 
        // User::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get(['name','created_at']);

        $data['dateFilter'] = $req->dateFilter;


        switch ($req->dateFilter) {
            case 'today':
                $data['new'] = RequestModel::whereDate('created_at', Carbon::today())->paginate(8);
                $data['title'] = "Today Request";

                break;
            case 'yesterday':
                $data['new'] = RequestModel::whereDate('created_at', Carbon::yesterday())->paginate(8);
                $data['title'] = "yesterday Request";
                break;
            case 'this_week':
                $data['new'] = RequestModel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(8);
                $data['title'] = "This Week Request";
                break;
            case 'this_month':
                $data['new'] = RequestModel::whereMonth('created_at', Carbon::now()->month)->paginate(8);
                $data['title'] = "This Month Request";
                break;
            case 'last_month':
                $data['new'] = RequestModel::whereMonth('created_at', Carbon::now()->subMonth()->month)->paginate(8);
                $data['title'] = "Last Month Request";
                break;
            case 'this_year':
                $data['new'] = RequestModel::whereYear('created_at', Carbon::now()->year)->paginate(8);
                $data['title'] = "This Year Request";
                break;
            case 'last_year':
                $data['new'] = RequestModel::whereYear('created_at', Carbon::now()->subYear()->year)->paginate(8);
                $data['title'] = "Last Year Request";
                break;

            default:
                $data['new'] = RequestModel::all();
                $data['title'] = "All New Request";

                break;

        }
        return view('franchises/allnewRequest', $data);

    }
    public function filterByInput(Request $req)
    {

        $data['search_value'] = $req->search;
        $data['new'] = RequestModel::where('owner_name', "LIKE", "%" . $req->search . "%")->paginate(8);
        $data['title'] = 'Search Record';
        $data['dateFilter'] = 'All';
        return view('franchises/allnewRequest', $data);
    }

    // show datas 
    public function confirmedRequest(Request $req)
    {

        $data['new'] = RequestModel::where('status', 1)
            ->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "Confirm Requests";
        return view("franchises.requests", $data);
    }
    public function rejectedRequest(Request $req)
    {

        $data['new'] = RequestModel::where('status', 3)
            ->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "rejected Requests";
        return view("franchises.requests", $data);
    }
    public function pendingRequest(Request $req)
    {

        $data['new'] = RequestModel::where('status', 0)
            ->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "pending Requests";
        return view("franchises.requests", $data);
    }
    public function deliveredRequest(Request $req)
    {

        $data['new'] = RequestModel::where('status', 5)
            ->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "Delivered Requests";
        return view("franchises.requests", $data);
    }

    // show Work Done Request
    public function workDoneRequests()
    {

        $data['new'] = RequestModel::where('status', 4)->orderBy('created_at', 'DESC')->paginate(8);
        $data['title'] = "Total WorkDoneRequests";
        return view("franchises.requests", $data);

    }
    public function globalSearch(Request $req)
    {
        $data['search_value'] = "";
        $data['new'] = RequestModel::where('service_code', "LIKE", "%" . $req->search . "%")
            ->orWhere('contact', 'like', '%' . $req->search . '%')
            ->orWhere('owner_name', 'like', '%' . $req->search . '%')->paginate(8);
        $data['title'] = 'Search Record';
        $data['dateFilter'] = 'All';
        return view('franchises/requests', $data);
    }

    public function messages()
    {
        $data['touch_with_us'] = touch_with_us::paginate(10);
        return view('franchises.messages', $data);
    }
    public function messagesRead($id)
    {
        $item = touch_with_us::where('id', $id)->first();
        $item->isRead = 1;
        $item->save();
        return view('franchises.messagesView', compact("item"));

    }


    
}
