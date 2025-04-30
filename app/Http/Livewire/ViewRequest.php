<?php

namespace App\Http\Livewire;

use App\Models\Staff;
use Auth;
use Livewire\Component;
use App\Models\Request As RequestModel;

class ViewRequest extends Component
{
    public $search = '';
    public $filter ='';
    public function render()
    {
        return view('livewire.view-request',[
            $recepts = Auth::guard('franchise')->user(),            
            'requests' => RequestModel::where('franchise_id',$recepts->id)->where('technician_id', '<>', null)->where('owner_name',"LIKE","%".$this->search."%")->paginate(8),
            "staffs" => Staff::all(),
        ]);
    }
}
