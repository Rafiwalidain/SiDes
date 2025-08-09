@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>


<!-- table -->
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Data Penduduk</h5>
            </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1234567890123456</td>
                                <td>Andi Setiawan</td>
                                <td>Laki-laki</td>
                                <td>Bandung, 10 Jan 1990</td>
                                <td>Jl. Merdeka No. 1</td>
                                <td>Islam</td>
                                <td>Menikah</td>
                                <td>Programmer</td>
                                <td>081234567890</td>
                                <td>Aktif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection