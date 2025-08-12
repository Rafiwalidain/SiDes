<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
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
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'unique:residents,nik'],
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
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'birth_place.required' => 'Tempat lahir wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'marital_status.required' => 'Status perkawinan wajib dipilih.',
            'status.required' => 'Status penduduk wajib dipilih.',
        ]);

        Resident::create($validated);

        return redirect('/resident')->with('success', 'Berhasil menambahkan data penduduk');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16'],
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
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', compact('resident'));
    }

    public function destroy($id)
    {
        // Logic to delete a resident
        $resident = Resident::findOrFail($id);
        $resident->delete();
        return redirect('/resident')->with('success', 'berhasil menghapus data penduduk');
    }
}
