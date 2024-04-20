<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeePcDailyCheckStoreRequest;
use App\Models\Division;
use App\Models\EmployeePcDailyCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeePcDailyCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmployeePcDailyCheck::query();
        $this->applySearchFilter($request, $query);

        $query->orderBy('date', 'desc');
        $divisions = Division::all();
        
        $employeePcDailyCheck = $query->paginate(10);
        $employeePcDailyCheck->appends(['search' => $request->search]);
        
        return view('technician.employee_daily_check.index', compact('employeePcDailyCheck', 'divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeePcDailyCheckStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $divisionId = $validatedData['division_id'];
            $division = Division::find($divisionId);
            $validatedData['monitor_inventory_code'] = "PU/A-011/" . $division->name;
            $validatedData['cpu_inventory_code'] = "PU/A-001/" . $division->name;

            $this->checkDuplicateRecord($validatedData['division_id'], $validatedData['date']);
            $this->setCheckboxValues($request, $validatedData);

            $validatedData['employee_signature'] = $this->saveSignature($validatedData['employee_signature']);
            $validatedData['technician_signature'] = $this->saveSignature($validatedData['technician_signature']);
            
            EmployeePcDailyCheck::create($validatedData);
        
            return redirect()->route('technician.employeepcdailychecks.index')->with('success', 'Laporan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException | \InvalidArgumentException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeePcDailyCheck $employeePcDailyCheck)
    {
        return view('technician.employee_daily_check.show', compact('employeePcDailyCheck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeePcDailyCheck $employeePcDailyCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeePcDailyCheck $employeePcDailyCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeePcDailyCheck $employeePcDailyCheck)
    {
        try {
            $employeePcDailyCheck->delete();
            if ($employeePcDailyCheck->employee_signature) {
                Storage::disk('public')->delete($employeePcDailyCheck->employee_signature);
            }
            if ($employeePcDailyCheck->technician_signature) {
                Storage::disk('public')->delete($employeePcDailyCheck->technician_signature);
            }
            return redirect()->route('technician.employeepcdailychecks.index')->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Laporan tidak dapat dihapus.');
        }
    }

    private function applySearchFilter(Request $request, $query)
    {
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        if ($request->filled('search_division')) {
            $query->where('division_id', $request->search_division);
        }
    }

    private function saveSignature($base64Signature)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Signature));
        $fileName = 'paraf_' . uniqid() . '.png';
        $directory = storage_path('app/public/signature');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        file_put_contents($directory . '/' . $fileName, $imageData);

        return 'signature/' . $fileName;
    }

    private function setCheckboxValues(EmployeePcDailyCheckStoreRequest $request, &$validatedData)
    {
        $checkboxes = [
            'keyboard_condition',
            'mouse_condition',
            'monitor_condition',
            'cpu_condition',
            'internet_condition',
            'printer_condition',
            'scanner_condition'
        ];

        foreach ($checkboxes as $checkbox) {
            $validatedData[$checkbox] = $request->has($checkbox) ? true : false;
        }
    }

    protected function checkDuplicateRecord($divisionId, $date)
    {
        $query = EmployeePcDailyCheck::where('division_id', $divisionId)->where('date', $date);
        if ($query->exists()) {
            throw new \InvalidArgumentException('Laporan dengan bagian dan tanggal yang sama telah tercatat sebelumnya.');
        }
    }
}
