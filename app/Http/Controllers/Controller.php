<?php

namespace App\Http\Controllers;

use App\Models\AppChecking;
use App\Models\AppChekingReport;
use App\Models\EmployeePcDailyCheck;
use App\Models\EmployeePcDailyCheckMonthlyReport;
use App\Models\LabDailyCheck;
use App\Models\LabDailyCheckMonthlyReport;
use App\Models\LabRequest;
use App\Models\LabRequestMonthlyReport;
use App\Models\LabUsage;
use App\Models\LabUsageMonthlyReport;
use App\Models\NetworkAssignment;
use App\Models\NetworkAssignmentReport;
use App\Models\NetworkConnectionDevelopment;
use App\Models\NetworkDevelopmentReport;
use App\Models\NetworkTroubleshooting;
use App\Models\NetworkTroubleshootingMonthlyReport;
use App\Models\RepairRequest;
use App\Models\RepairRequestReport;
use App\Models\WebAssignment;
use App\Models\WebAssignmentReport;
use App\Models\WebDevelopmentMonthlyReport;
use App\Models\WebDevelopmentRequest;
use App\Models\WebMaintenance;
use App\Models\WebMaintenanceReport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function saveSignature($base64Signature)
    {
        // Mengubah base64 menjadi data biner gambar
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Signature));

        // Membuat nama file baru dengan ekstensi yang sesuai
        $fileName = 'paraf_' . uniqid() . '.png';

        // Mendapatkan path lengkap ke folder storage/public/signature
        $directory = storage_path('app/public/signature');

        // Membuat folder jika belum ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Menyimpan file gambar ke dalam folder storage/public/signature
        file_put_contents($directory . '/' . $fileName, $imageData);

        // Mengembalikan path lengkap file yang disimpan
        return 'signature/' . $fileName;
    }
    
    protected function getMonthNumber($month)
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
    
    protected function convertMonthToIndonesian($data)
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
    
    protected function getLabCheckingCount($field)
    {
        $data = LabDailyCheck::selectRaw('lab_id, MONTH(date) as month, YEAR(date) as year')->groupBy('lab_id', 'month', 'year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = LabDailyCheckMonthlyReport::where('lab_id', $check->lab_id)->where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getLabRequestCount($field)
    {
        $data = LabRequest::selectRaw('lab_id, MONTH(date) as month, YEAR(date) as year')->groupBy('lab_id', 'month', 'year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = LabRequestMonthlyReport::where('lab_id', $check->lab_id)->where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getLabUsageCount($field)
    {
        $data = LabUsage::selectRaw('lab_id, MONTH(date) as month, YEAR(date) as year')->groupBy('lab_id', 'month', 'year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = LabUsageMonthlyReport::where('lab_id', $check->lab_id)->where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getNetworkDevCount($field)
    {
        $data = NetworkConnectionDevelopment::selectRaw('YEAR(date) as year')->where('status', 3)->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = NetworkDevelopmentReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getNetworkTroCount($field)
    {
        $data = NetworkTroubleshooting::selectRaw('YEAR(date) as year')->where('status', 3)->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = NetworkTroubleshootingMonthlyReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getNetworkAssCount($field)
    {
        $data = NetworkAssignment::selectRaw('YEAR(date) as year')->whereNotNull('finish_date')->whereNotNull('engineer_signature')->whereNotNull('kabag_signature')->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = NetworkAssignmentReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getWebDevCount($field)
    {
        $data = WebDevelopmentRequest::selectRaw('YEAR(date) as year')->where('status', 3)->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = WebDevelopmentMonthlyReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getWebChekingCount($field)
    {
        $data = AppChecking::selectRaw('month, year')->groupBy('year', 'month')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = AppChekingReport::where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getWebMaintenanceCount($field)
    {
        $data = WebMaintenance::selectRaw('YEAR(date) as year')->where('status', 3)->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = WebMaintenanceReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getWebAssCount($field)
    {
        $data = WebAssignment::selectRaw('YEAR(date) as year')->whereNotNull('finish_date')->whereNotNull('programmer_signature')->whereNotNull('kabag_signature')->groupBy('year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = WebAssignmentReport::where('year', $check->year)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getRepairRequestReportCount($field)
    {
        $data = RepairRequest::selectRaw('MONTH(date) as month, YEAR(date) as year')->where('status', 4)->groupBy('year')->groupBy('month')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = RepairRequestReport::where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }

    protected function getEmployeePcCheckingCount($field)
    {
        $data = EmployeePcDailyCheck::selectRaw('division_id, MONTH(date) as month, YEAR(date) as year')->groupBy('division_id', 'month', 'year')->get();

        $count = 0;

        foreach ($data as $check) {
            $report = EmployeePcDailyCheckMonthlyReport::where('division_id', $check->division_id)->where('year', $check->year)->where('month', $check->month)->first();

            if ($report) {
                if (is_null($report->$field)) { $count++; }
            } else { $count++; }
        }

        return $count;
    }
    
}
