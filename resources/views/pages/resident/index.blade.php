@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
    <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
</div>


<!-- table -->
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Perkawinan</th>
                                <th>Pekerjaan</th>
                                <th>Telepon</th>
                                <th>Status Penduduk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @if ($residents->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="11" class="text-center">Tidak ada data penduduk</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($residents as $resident)
                            <tr>
                                <td>{{ $resident->nik }}</td>
                                <td>{{ $resident->name }}</td>
                                <td>{{ $resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $resident->birth_place }}, {{ \Carbon\Carbon::parse($resident->birth_date)->translatedFormat('d F Y') }}</td>
                                <td>{{ $resident->address }}</td>
                                <td>{{ $resident->religion ?? '-' }}</td>
                                <td>
                                    @switch($resident->marital_status)
                                    @case('single') Lajang @break
                                    @case('married') Menikah @break
                                    @case('divorced') Duda/Janda Cerai @break
                                    @case('widowed') Duda/Janda Meninggal @break
                                    @default {{ ucfirst($resident->marital_status) }}
                                    @endswitch
                                </td>
                                <td>{{ $resident->occupation ?? '-' }}</td>
                                <td>{{ $resident->phone ?? '-' }}</td>
                                <td>
                                    @switch($resident->status)
                                    @case('active') Aktif @break
                                    @case('moved') Pindah @break
                                    @case('deceased') Meninggal @break
                                    @default {{ ucfirst($resident->status) }}
                                    @endswitch
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="/resident/{{ $resident->id }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="/resident/{{ $resident->id }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-eraser"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
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