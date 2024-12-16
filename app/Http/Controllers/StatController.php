<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class StatController extends Controller
{
    // Get the stats
    public function index()
    {
        $stats = Stat::first(); // Retrieves the single stats record
        return Helper::result('Stats retrieved successfully', 200, $stats);
    }

    // Update the stats
    public function update(Request $request)
    {
        $validated = $request->validate([
            'projects_delivered' => 'required|integer',
            'supported_countries' => 'required|integer',
            'active_clients' => 'required|integer',
        ]);

        $stat = Stat::first(); // Retrieve the single stats record
        $stat->update($validated);

        return Helper::result('Stats updated successfully', 200, $stat);
    }
}
