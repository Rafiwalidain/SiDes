<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class residentController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display residents
        $residents = Resident::all();
        return view('pages.resident.index', [
            'residents' => $residents
        ]);
    }

    public function create()
    {
        // Logic to show the form for creating a new resident
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new resident
        $validated = $request->validate([
            'nik' => ['required', 'max:16', 'min:16'],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:255'],
            'religion' => ['nullable', 'max:255'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        Resident::create($validated);

        return redirect('/resident')->with('success', 'berhasil menambahkan data penduduk');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => ['required', 'max:16', 'min:16'],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:255'],
            'religion' => ['nullable', 'max:255'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        Resident::findOrFail($id)->update($validated);

        return redirect('/resident')->with('success', 'berhasil mengubah data penduduk');
    }


    public function edit($id)
    {
        // Logic to show the form for editing a resident
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', [
            'resident' => $resident
        ]);
    }

    public function destroy($id)
    {
        // Logic to delete a resident
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect('/resident')->with('success', 'berhasil menghapus data penduduk');
    }
}
