<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use App\Models\ItemInventory;
use App\Models\NetworkAssignment;
use App\Models\NetworkConnectionDevelopment;
use App\Models\NetworkTroubleshooting;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use App\Models\Role;
use App\Models\User;
use App\Models\WebApp;
use App\Models\WebAssignment;
use App\Models\WebDevelopmentRequest;
use App\Models\WebMaintenance;
use App\Models\WifiChecking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

      $userLog = Auth::user();
      $users = User::all()->count();
      $employees = User::where('role_id', 5)->get()->count();
      $lecturers = User::where('role_id', 6)->get()->count();

      $levels = Role::all()->count();
      $divisions = Division::all()->count();
      $inventory = ItemInventory::all()->count();

      $webApps = WebApp::all();
      
      return view('index', compact(
        'users', 'employees', 'lecturers',
        'webApps', 'levels', 'divisions', 'inventory'
      ));
    }
    
}
