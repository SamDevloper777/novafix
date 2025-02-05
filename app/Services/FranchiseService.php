<?php
namespace App\Services;

use App\Models\Franchises;

class FranchiseService
{
    public function toggleStatus($id)
    {
        $franchise = Franchises::findOrFail($id);

        $newStatus = $franchise->status === 'Active' ? 'Inactive' : 'Active';

        $franchise->update(['status' => $newStatus]);

        return $newStatus;
    }
}
