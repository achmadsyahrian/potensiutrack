<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\EmployeePcDailyCheck;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePcDailyCheckReportController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeePcDailyCheck::select(DB::raw('YEAR(date) as year, MONTH(date) as month, division_id, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'division_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('technician.employee_daily_check.report.index', compact('data'));
    }

    public function showByMonthAndDivision($year, $month, $division)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = EmployeePcDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('division_id', $division)
            ->orderBy('date', 'desc')
            ->paginate(10);
        $divisionName = Division::find($division)->pluck('name')->first();

        return view('technician.employee_daily_check.report.show_by_month_and_division', compact('data', 'year', 'month', 'divisionName'));
    }

    public function show(EmployeePcDailyCheck $id)
    {
        $employeePcDailyCheck = $id;
        return view('technician.employee_daily_check.report.show', compact('employeePcDailyCheck'));
    }


    public function verify(Request $request, $year, $month, $division)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'teknisi_signature' => 'required',
        ]);
        $teknisiSignature = $this->saveSignature($validated['teknisi_signature']);

        $monthlyReport = EmployeePcDailyCheckMonthlyReport::updateOrCreate(
            ['division_id' => $division, 'year' => $year, 'month' => $monthResult],
            ['teknisi_signature' => $teknisiSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
