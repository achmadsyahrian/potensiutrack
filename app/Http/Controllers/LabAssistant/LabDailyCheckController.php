<?php

namespace App\Http\Controllers\LabAssistant;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabDailyCheckStoreRequest;
use App\Http\Requests\LabDailyCheckUpdateRequest;
use App\Models\Computer;
use App\Models\Lab;
use App\Models\LabDailyCheck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabDailyCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LabDailyCheck::query();

        $this->applySearchFilters($query, $request);

        $query->orderBy('date', 'desc');
        
        $labDailyChecks = $query->paginate(10);
        $labDailyChecks->appends(request()->query());

        $lab_assistants = User::where('role_id', 3)->get();
        $labs = Lab::all();

        return view('lab_assistant.dailychecks.index', compact('labDailyChecks', 'lab_assistants', 'labs'));
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
    public function store(LabDailyCheckStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if (isset($validatedData['optional_user_id'])) {
                $this->checkUserIds($validatedData['mandatory_user_id'], $validatedData['optional_user_id']);
            }

            $this->checkDuplicateRecord($validatedData['lab_id'], $validatedData['date']);
            $validatedData['results'] = json_encode($validatedData['results']);
            $validatedData['descriptions'] = json_encode($validatedData['descriptions']);

            LabDailyCheck::create($validatedData);

            // Respon dengan pesan sukses
            return redirect()->route('labassistant.labdailychecks.index')->with('success', 'Laporan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException | \InvalidArgumentException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(LabDailyCheck $labDailyCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $labDailyCheck = LabDailyCheck::find($id);
        $lab_assistants = User::where('role_id', 3)->get();
        $labs = Lab::all();
        return view('lab_assistant.dailychecks.edit', compact('labDailyCheck', 'labs', 'lab_assistants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabDailyCheckUpdateRequest $request, $id)
    {
        try {
            $labDailyCheck = LabDailyCheck::find($id);

            $validatedData = $request->validated();
            
            if (isset($validatedData['optional_user_id'])) {
                $this->checkUserIds($validatedData['mandatory_user_id'], $validatedData['optional_user_id']);
            }
            
            $labDailyCheck->update($validatedData);

            return redirect()->route('labassistant.labdailychecks.index')->with('success', 'Laporan berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $labDailyCheck = LabDailyCheck::find($id);
        $labDailyCheck->delete();

        return redirect()->route('labassistant.labdailychecks.index')->with('success', 'Laporan berhasil dihapus!');
    }

    public function pilihLab($labId) {
        $computers = DB::table('computers')->where('lab_id', $labId)->get();
        return response()->json($computers);
    }
    
    // Cek Kesamaan Ass Lab 1 dan 2
    protected function checkUserIds($mandatoryUserId, $optionalUserId)
    {
        if ($mandatoryUserId === $optionalUserId) {
            throw new \InvalidArgumentException('Asisten Lab 1 dan Lab 2 tidak boleh sama.');
        }
    }

    protected function checkDuplicateRecord($labId, $date)
    {
        $query = LabDailyCheck::where('lab_id', $labId)->where('date', $date);
        if ($query->exists()) {
            throw new \InvalidArgumentException('Laporan dengan lab dan tanggal yang sama telah tercatat sebelumnya.');
        }
    }

    private function applySearchFilters($query, $request)
    {
        // Filter berdasarkan tanggal
        if ($request->filled('search_date')) {
            $query->whereDate('date', $request->search_date);
        }

        // Filter berdasarkan lab
        if ($request->filled('search_lab')) {
            $query->where('lab_id', $request->search_lab);
        }

        // Filter berdasarkan user mandatory atau optional
        if ($request->filled('search_mandatory_user_id')) {
            $query->where('mandatory_user_id', $request->search_mandatory_user_id)
                ->orWhere('optional_user_id', $request->search_mandatory_user_id);
        }
    }

    
}
