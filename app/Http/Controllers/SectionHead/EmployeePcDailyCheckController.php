<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\EmployeePcDailyCheck;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePcDailyCheckController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeePcDailyCheck::select(DB::raw('YEAR(date) as year, MONTH(date) as month, division_id, COUNT(*) as count'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'), 'division_id')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(10);

        $data = $this->convertMonthToIndonesian($data);

        return view('section_head.employee_daily_check.index', compact('data'));
    }

    public function showByMonthAndDivision($year, $month, $division)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = EmployeePcDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('division_id', $division)
            ->orderBy('date', 'desc')
            ->paginate(10);
        $divisionName = Division::find($division)->name;

        return view('section_head.employee_daily_check.show_by_month_and_division', compact('data', 'year', 'month', 'divisionName'));
    }

    public function show(EmployeePcDailyCheck $id)
    {
        $employeePcDailyCheck = $id;
        return view('section_head.employee_daily_check.show', compact('employeePcDailyCheck'));
    }


    public function verify(Request $request, $year, $month, $division)
    {
        $monthResult = $this->getMonthNumber($month);

        $validated = $request->validate([
            'kabag_signature' => 'required',
        ]);
        $kabagSignature = $this->saveSignature($validated['kabag_signature']);

        $monthlyReport = EmployeePcDailyCheckMonthlyReport::updateOrCreate(
            ['division_id' => $division, 'year' => $year, 'month' => $monthResult],
            ['kabag_signature' => $kabagSignature]
        );

        return redirect()->back()->with('success', 'Laporan bulanan telah diverifikasi.');
    }

}
