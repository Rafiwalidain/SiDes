@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>

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
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="d-inline-block mr-2 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmReject-{{ $resident->id }}">
                                            Tolak
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmApprove-{{ $resident->id }}">
                                            Setuju
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.account-requests.confirm-approve')
                            @include('pages.account-requests.confirm-reject')
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