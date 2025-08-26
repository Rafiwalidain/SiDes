@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>

</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif


<!-- table -->
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if ($users->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="11" class="text-center">Tidak ada data penduduk</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($users as $resident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resident->name }}</td>
                                <td>{{ $resident->email }}</td>
                                <td>
                                    @if ($resident->status == 'approved')
                                    <span class="badge badge-success text-white">Aktif</span>
                                    @elseif ($resident->status == 'rejected')
                                    <span class="badge badge-danger text-white">Tidak Aktif</span>
                                    @else
                                    <span class="badge badge-secondary text-white">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if ($resident->status == 'approved')
                                        <button type="button" class="d-inline-block mr-2 btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmReject-{{ $resident->id }}">
                                            Non-aktif Akun
                                        </button>
                                        @elseif ($resident->status == 'rejected')
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmApprove-{{ $resident->id }}">
                                            Aktifkan Akun
                                        </button>
                                        @endif


                                    </div>
                                </td>
                            </tr>
                            @include('pages.account-list.confirm-approve')
                            @include('pages.account-list.confirm-reject')
                            @endforeach

                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection