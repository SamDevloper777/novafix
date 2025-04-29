<?php

namespace App\Services;

use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Auth;

class RequestService
{
    /**
     * Get all requests based on their status.
     *
     * @param  int  $status
     * @param  string  $title
     * @return array
     */
    public function getRequestsByStatus($status, $title)
{
    $receptionerId = Auth::guard('receptioner')->id();
    $data['allRequests'] = RequestModel::where('reciptionist_id', $receptionerId)
        ->where('status', $status)
        ->orderBy('created_at', 'DESC')
        ->paginate(8);
    $data['title'] = $title;
    
    return $data;
}
}
