<?php

namespace App\Http\Controllers\SectionHead;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\EmployeePcDailyCheck;
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
        $divisionName = Division::find($division)->pluck('name')->first();

        return view('section_head.employee_daily_check.show_by_month_and_division', compact('data', 'year', 'month', 'divisionName'));
    }

    public function show(EmployeePcDailyCheck $id)
    {
        $employeePcDailyCheck = $id;
        return view('section_head.employee_daily_check.show', compact('employeePcDailyCheck'));
    }
    
    private function getMonthNumber($month)
    {
        $bulanToAngka = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        return $bulanToAngka[$month];
    }

    private function convertMonthToIndonesian($data)
    {
        $monthsInIndonesian = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        foreach ($data as $item) {
            $item->month = $monthsInIndonesian[$item->month];
        }

        return $data;
    }

}
