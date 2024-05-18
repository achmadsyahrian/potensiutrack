<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\EmployeePcDailyCheck;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use App\Models\HeadLabAssistant;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function print($year, $month, $division)
    {
        $monthInNumber = $this->getMonthNumber($month);

        $data = EmployeePcDailyCheck::whereYear('date', $year)
            ->whereMonth('date', $monthInNumber)
            ->where('division_id', $division)
            ->orderBy('date', 'desc')
            ->get();

        $divisionName = Division::where('id', $division)->pluck('name')->first();

        $dataReport = EmployeePcDailyCheckMonthlyReport::where('division_id', $division)
            ->where('year', $year)
            ->where('month', $monthInNumber)
            ->first();

        $chunkedData = $data->chunk(10);

        $html = view('technician.employee_daily_check.report.print', [
            'chunkedData' => $chunkedData,
            'divisionName' => $divisionName,
            'dataReport' => $dataReport,
            'year' => $year,
            'month' => $month,
            'pageCount' => 0,
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pageCount = $dompdf->getCanvas()->get_page_count();

        session(['pageCount' => $pageCount]);

        $output = $dompdf->output();

        return response()->stream(
            function () use ($output) {
                print($output);
            },
            200,
            [
                "Content-Type" => "application/pdf",
                "Content-Disposition" => "inline; filename=document.pdf",
            ]
        );
    }

}
