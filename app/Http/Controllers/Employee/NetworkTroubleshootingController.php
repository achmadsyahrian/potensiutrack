<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\NetworkTroubleshooting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkTroubleshootingController extends Controller
{
    public function index(Request $request)
    {
        $logUserId = Auth::id();
        $networkTroubleshootings = NetworkTroubleshooting::where('reported_by_id', $logUserId)->paginate(10);

        return view('employee.network_troubleshooting.index', compact('networkTroubleshootings'));
    }

}
