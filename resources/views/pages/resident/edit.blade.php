@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Penduduk</h1>
</div>

<div class="row">
    <div class="col">
        <form action="/resident/{{ $resident->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nik">NIK <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nik" name="nik"
                            placeholder="Masukkan NIK"
                            minlength="16" maxlength="16" pattern="\d{16}"
                            required value="{{ old('nik', $resident->nik) }}">
                        <small class="form-text text-muted">NIK harus tepat 16 digit angka.</small>
                        @error('nik') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan Nama Lengkap"
                            required value="{{ old('name', $resident->name) }}">
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">-- Pilih --</option>
                            <option value="male" {{ old('gender', $resident->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender', $resident->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="birth_place">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="birth_place" name="birth_place"
                            placeholder="Masukkan Tempat Lahir"
                            required value="{{ old('birth_place', $resident->birth_place) }}">
                        @error('birth_place') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date"
                            required value="{{ old('birth_date', $resident->birth_date) }}">
                        @error('birth_date') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address"
                            placeholder="Masukkan Alamat"
                            required>{{ old('address', $resident->address) }}</textarea>
                        @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="religion">Agama <small class="text-muted">(Opsional)</small></label>
                        <input type="text" class="form-control" id="religion" name="religion"
                            placeholder="Masukkan Agama" value="{{ old('religion', $resident->religion) }}">
                        @error('religion') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="marital_status">Status Perkawinan <span class="text-danger">*</span></label>
                        <select class="form-control" id="marital_status" name="marital_status" required>
                            <option value="">-- Pilih --</option>
                            <option value="single" {{ old('marital_status', $resident->marital_status) == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="married" {{ old('marital_status', $resident->marital_status) == 'married' ? 'selected' : '' }}>Menikah</option>
                            <option value="divorced" {{ old('marital_status', $resident->marital_status) == 'divorced' ? 'selected' : '' }}>Cerai</option>
                            <option value="widowed" {{ old('marital_status', $resident->marital_status) == 'widowed' ? 'selected' : '' }}>Duda/Janda</option>
                        </select>
                        @error('marital_status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="occupation">Pekerjaan <small class="text-muted">(Opsional)</small></label>
                        <input type="text" class="form-control" id="occupation" name="occupation"
                            placeholder="Masukkan Pekerjaan" value="{{ old('occupation', $resident->occupation) }}">
                        @error('occupation') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Telepon <small class="text-muted">(Opsional)</small></label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Masukkan Nomor Telepon" value="{{ old('phone', $resident->phone) }}">
                        @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status Penduduk <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">-- Pilih --</option>
                            <option value="active" {{ old('status', $resident->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="moved" {{ old('status', $resident->status) == 'moved' ? 'selected' : '' }}>Pindah</option>
                            <option value="deceased" {{ old('status', $resident->status) == 'deceased' ? 'selected' : '' }}>Meninggal</option>
                        </select>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        <a href="/resident" class="btn btn-secondary">Batal</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection