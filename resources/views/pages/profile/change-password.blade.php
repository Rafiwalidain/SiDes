@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<div class="row">
    <div class="col">
        <form action="/change-password/{{ auth()->user()->id }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <!-- Password Lama -->
                    <div class="form-group mb-3">
                        <label for="old_password">Password Lama <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="old_password" name="old_password">
                        @error('old_password') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group mb-3">
                        <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="form-group mb-3">
                        <label for="new_password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="/dashboard" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection