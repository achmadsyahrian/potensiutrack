<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loggedInUserId = Auth::id();
        
        $query = User::whereNotIn('id', [$loggedInUserId])
                        ->where('role_id', 1);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('nip', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10);

        $users->appends(['search' => $request->search]);

        // Other
        $title = "administrator";
        $name = "administrator";
        $route = "accounts.administrator";
        
        return view('administrator.accounts.index', compact('users', 'title', 'name', 'route'));
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
    public function store(UserStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt('potensiutama');
            $validatedData['role_id'] = 1;
            
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoPath = $photo->store('photos', 'public');
                $validatedData['photo'] = $photoPath;
            }

            User::create($validatedData);
        
            return redirect()->route('accounts.administrator.index')->with('success', 'Administrator berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $administrator)
    {
        $user = $administrator;
        $title = "Administrator";
        $name = "administrator";
        $route = "accounts.administrator";
        return view('administrator.accounts.edit', compact('user', 'title', 'route', 'name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $administrator)
    {
        try {
            $validatedData = $request->validated();
            $user = $administrator;

            if (empty($validatedData['password'])) {
                unset($validatedData['password']);
            } else {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            if ($request->hasFile('photo')) {
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                $photo = $request->file('photo');
                $photoPath = $photo->store('photos', 'public');
                $validatedData['photo'] = $photoPath;
            }

            $user->update($validatedData);
        
            return redirect()->route('accounts.administrator.index')->with('success', 'Administrator berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data tidak dapat disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $administrator)
    {
        $user = $administrator;

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();
        return redirect()->route('accounts.administrator.index')->with('success', 'Administrator berhasil dihapus!');
    }
}
