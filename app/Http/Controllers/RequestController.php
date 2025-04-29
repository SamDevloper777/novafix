<?php

namespace App\Http\Controllers;
use App\Models\Franchises;
use App\Models\Receptioner;
use App\Models\Request as RequestModel;
use App\Models\Staff;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Mail\RequestSend;
use PDF;


use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function requestForm(): View
    {
        $districts = Franchises::whereNotNull('district')
            ->distinct()
            ->pluck('district')
            ->sort();

        $types = Type::all();

        return view(' requestForm', compact('districts', 'types'));
    }
    public function getFranchisesByDistrict(Request $request)
    {
        if ($request->ajax() && $request->has('district')) {
            $district = $request->input('district');
            $franchises = Franchises::where('district', $district)
                ->select('id', 'franchise_name')
                ->get();

            if ($franchises->isNotEmpty()) {
                return response()->json([
                    'success' => true,
                    'franchises' => $franchises
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No franchises found for the selected district.'
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
    }

    public function getReceptionistsByFranchise(Request $request)
    {
        if ($request->ajax() && $request->has('franchise_id') && $request->has('type_id')) {
            $franchiseId = $request->input('franchise_id');


            $receptionists = Receptioner::where('franchise_id', $franchiseId)
                ->select('id', 'name')
                ->get();

            \Log::info('Receptionists found: ' . $receptionists->toJson());

            if ($receptionists->isNotEmpty()) {
                return response()->json([
                    'success' => true,
                    'receptionists' => $receptionists
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No receptionists found for the selected franchise and type.'
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
    }
    public function requestCreate(Request $request)
    {
        if ($request->ajax() && $request->has('contact')) {
            $contactNumber = $request->input('contact');

            $customer = RequestModel::where('contact', $contactNumber)->first();

            if ($customer) {
                return response()->json([
                    'success' => true,
                    'customer' => [
                        'owner_name' => $customer->owner_name,
                        'product_name' => $customer->product_name,
                        'email' => $customer->email,
                        'brand' => $customer->brand,
                        'serial_no' => $customer->serial_no,
                        'color' => $customer->color,
                        'MAC' => $customer->MAC,
                        'type_id' => $customer->type_id,
                    ]
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Customer not found. Please check the contact number.']);
            }
        }

        $service_code = Str::random(6);

        $data = $request->validate([
            'owner_name' => 'required',
            'product_name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'type_id' => 'required|exists:types,id',
            'brand' => 'required',
            'color' => 'required',
            'problem' => 'required',
            'district' => 'required',
            'franchise_id' => 'required|exists:franchises,id',
            'reciptionist_id' => 'required|exists:receptioners,id',
        ]);

        $data['service_code'] = $service_code;

        RequestModel::create($data);

        return view('flashMessage', $data);
    }

    public function receptionerRequestDeliver(Request $req, $id)
    {
        $user = Auth::guard('receptioner')->user();
        $request = RequestModel::where('reciptionist_id', $user->id)
            ->where('id', $id)
            ->where('status', 4)
            ->firstOrFail();

        $request->status = 5;
        $request->remark = 'Please provide feedback';
        $request->delivered_by = $user->name;
        $request->date_of_delivery = now();
        $request->save();

        return redirect()->back()->with('success', 'Request marked as Delivered.');
    }
    public function allRequests()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'All Requests';
        return view('staff.requests', $data);
    }

    public function newRequests()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'New Requests';
        return view('staff.requests', $data);
    }

    public function confirmRequest(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 1; // Confirmed
        $request->estimate_delivery = now()->addDays(7);
        $request->save();
        return redirect()->route('request.all')->with('success', 'Request confirmed successfully.');
    }

    public function workProgressRequest(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('status', 1) // Confirmed
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 2; // Work in Progress
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Work in Progress.');
    }

    public function deassemble(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('status', 2) // Work in Progress
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 2.1; // Disassembled
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Disassembled.');
    }

    public function repair(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('status', 2.1) // Disassembled
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 2.2; // Repaired
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Repaired.');
    }

    public function assemble(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('status', 2.2) // Repaired
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 2.3; // Assembled
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Assembled.');
    }

    public function rejected(Request $req, $id)
    {
        $req->validate([
            'remark' => 'required|string|max:255',
        ]);
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('id', $id)
            ->where('status', '!=', 5) // Not Delivered
            ->firstOrFail();
        $request->status = 3; // Rejected
        $request->remark = $req->remark;
        $request->save();
        return redirect()->back()->with('success', 'Request rejected successfully.');
    }

    public function pending(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('id', $id)
            ->where('status', '!=', 5) // Not Delivered
            ->firstOrFail();
        $request->status = 0; // Pending
        $request->technician_id = null;
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Pending.');
    }

    public function workDone(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();
        $request = RequestModel::where('technician_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();
        $request->status = 4; // Work Done
        $request->save();
        return redirect()->back()->with('success', 'Request marked as Work Done.');
    }

    public function requestDeliver(Request $req, $id)
    {
        $user = Auth::guard('staff')->user();

        // Find the request assigned to the same receptionist as the staff
        $request = RequestModel::where('id', $id)
            ->where('status', 4) // Work Done
            ->whereHas('receptionist', function ($query) use ($user) {
                $query->where('id', $user->receptionist_id);
            })
            ->firstOrFail();

        $request->status = 5; // Delivered
        $request->remark = 'Please provide feedback';
        $request->delivered_by = $user->name;
        $request->date_of_delivery = now();
        $request->save();

        return redirect()->back()->with('success', 'Request marked as Delivered.');
    }

    public function showDelivered()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->where('status', 5) // Delivered
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'Total Delivered Requests';
        $data['deliveredCount'] = $data['allRequests']->total();
        return view('staff.requests', $data);
    }

    public function pendingRequests()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->where('status', 0) // Pending
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'Total Pending Requests';
        return view('staff.requests', $data);
    }

    public function showWorkprogress()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->whereBetween('status', [2.0, 3.0])
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'Current Work Requests';
        return view('staff.requests', $data);
    }

    public function rejectedRequests()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->where('status', 3) // Rejected
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'Total Rejected Requests';
        $data['RejectedCount'] = $data['allRequests']->total();
        return view('staff.requests', $data);
    }

    public function workDoneRequests()
    {
        $user = Auth::guard('staff')->user();
        $query = RequestModel::where('technician_id', $user->id)
            ->where('status', 4) // Work Done
            ->orderBy('created_at', 'DESC');
        if (!is_null($user->receptionist_id)) {
            $query->where('reciptionist_id', $user->receptionist_id);
        }
        $data['allRequests'] = $query->paginate(8);
        $data['title'] = 'Total Work Done Requests';
        return view('staff.requests', $data);
    }
    public function requestEdit(Request $req, $id)
    {
        $data = RequestModel::where('id', $id)->first();
        return view("staff.requestEdit", compact('data'));
    }

    public function requestUpdate(Request $req)
    {
        $data = $req->validate([
            'remark' => 'required',
            'serial_no' => 'required',
            'MAC' => 'required',
            'status' => 'required',
        ]);

        $id = $req->id;
        RequestModel::where('id', $id)->update($data);
        return redirect()->route('request.all');
    }




    public function trackStatus(Request $req)
    {
        $data['searchStatus'] = "";
        $data['item'] = "";
        if ($req->method() == 'POST') {
            $req->validate([
                'search' => "required|min:6|max:6",
            ], [
                'search.required' => "Please Enter 6 Character Service Code",
                'search.min' => "Service Code must be at least 6 characters.",
                'search.max' => "Service Code must be at least 6 characters."
            ]);
            $data['searchStatus'] = $req->search;

            $searchStatus = $req->search;

            $item = RequestModel::where('service_code', 'LIKE', "%$searchStatus%")->first();

            if (!$item) {
                return redirect()->back()->with('msg', "Service Code is Not Found");
            }
            return view('userDashboard.trackRequest', compact('item', 'searchStatus'));
        }


        return view('userDashboard.trackRequest', $data);

    }

    public function dateFilter(Request $req)
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $req->End);
        $date->addDays();
        $formattedDate = $date->format('Y-m-d');
        $data['allRequests'] = RequestModel::select("*")->whereBetween('created_at', [$req->startAt, $formattedDate])->where('technician_id', NULL)
            ->paginate(8);
        $data['title'] = "Date between Request";
        return view('staff/requests', $data);
    }
    public function filterBySelect(Request $req)
    {
        // $date = \Carbon\Carbon::now();
        // $date->subDays(7);
        // $formattedDate = $date->format('Y-m-d');
        // dd($formattedDate);
        // last month code 
        // User::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get(['name','created_at']);
        $user = Auth::guard('staff')->user();
        $data['dateFilter'] = $req->dateFilter;


        switch ($req->dateFilter) {
            case 'today':
                $data['allRequests'] = RequestModel::whereDate('created_at', Carbon::today())->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "Today Request";

                break;
            case 'yesterday':
                $data['allRequests'] = RequestModel::whereDate('created_at', Carbon::yesterday())->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "yesterday Request";
                break;
            case 'this_week':
                $data['allRequests'] = RequestModel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "This Week Request";
                break;
            case 'this_month':
                $data['allRequests'] = RequestModel::whereMonth('created_at', Carbon::now()->month)->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "This Month Request";
                break;
            case 'last_month':
                $data['allRequests'] = RequestModel::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "Last Month Request";
                break;
            case 'this_year':
                $data['allRequests'] = RequestModel::whereYear('created_at', Carbon::now()->year)->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "This Year Request";
                break;
            case 'last_year':
                $data['allRequests'] = RequestModel::whereYear('created_at', Carbon::now()->subYear()->year)->where('technician_id', $user->id)->where('type_id', $user->type_id)->paginate(8);
                $data['title'] = "Last Year Request";
                break;

            default:
                $data['allRequests'] = RequestModel::where('technician_id', $user->id)->paginate(8);
                $data['title'] = "All New Request";

                break;

        }
        return view('staff/requests', $data);

    }
    public function filterByInput(Request $req)
    {
        $user = Auth::guard('staff')->user();

        // dd($req->search);
        $data['search_value'] = $req->search;
        $data['allRequests'] = RequestModel::where("technician_id", $user->id)->where('owner_name', "LIKE", "%" . $req->search . "%")->paginate(8);
        $data['title'] = 'Search Record';
        $data['dateFilter'] = 'All';
        return view('staff/requests', $data);
    }


    public function globalSearch(Request $req)
    {
        $data['search_value'] = "";
        $data['allRequests'] = RequestModel::where('service_code', "LIKE", "%" . $req->search . "%")
            ->orWhere('contact', 'like', '%' . $req->search . '%')
            ->orWhere('owner_name', 'like', '%' . $req->search . '%')->paginate(8);
        $data['title'] = 'Search Record';
        $data['dateFilter'] = 'All';
        return view('receptioner/requests', $data);
    }

}