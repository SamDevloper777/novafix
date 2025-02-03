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
    public function index()
    {
        return view('franchises.dashboard');
    }


    public function franchiseLogin(Request $req)
    {
        if ($req->method() == "POST") {
            $data = $req->only(["email", "password"]);

            if (Auth::guard("franchise")->attempt($data)) {
                $franchise = Auth::guard('franchise')->user();
                if ($franchise->status) {
                    return redirect()->route("franchise.panel");
                } else {
                    return redirect()->back()->with("alert", "your account is disabled");
                }
            } else {
                return redirect()->route("franchise.login")->with("alert", "Please enter valid email or password");
                ;
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
        $data['franchise_id'] = Auth::guard("franchise")->id();
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
        $data['staffs'] = Staff::where('franchise_id', Auth::guard('franchise')->id())->get();
        return view('franchises/manageStaff', $data);
    }

    public function insertStaff(Request $req)
    {
        $data['Types'] = Type::all();
        return view("franchises.insertStaff", $data);
    }

    public function editStaff($id)
    {
        $data = Staff::where('id', $id)->where('franchise_id', Auth::guard('franchise')->id())->first();
        if (!$data) {
            return redirect()->route('franchise.staff.manage')->with('alert', 'You not have proper Right to Edit!');

        }
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
        $receptionerId = Auth::guard('receptioner')->id();
        $data['new'] = RequestModel::where('reciptionist_id', $receptionerId)
            ->whereNull('technician_id')
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        // Additional data for the view
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

    private function getRequestsByStatus($status, $title)
    {
        $receptionerId = Auth::guard('receptioner')->id();

        $data['new'] = RequestModel::where('reciptionist_id', $receptionerId)
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        $data['title'] = $title;

        return view("franchises.requests", $data);
    }

    public function confirmedRequest(Request $req)
    {
        return $this->getRequestsByStatus(1, "Confirm Requests");
    }

    public function rejectedRequest(Request $req)
    {
        return $this->getRequestsByStatus(3, "Rejected Requests");
    }

    public function pendingRequest(Request $req)
    {
        return $this->getRequestsByStatus(0, "Pending Requests");
    }

    public function deliveredRequest(Request $req)
    {
        return $this->getRequestsByStatus(5, "Delivered Requests");
    }

    public function workDoneRequests(Request $req)
    {
        return $this->getRequestsByStatus(4, "Work Done Requests");
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
