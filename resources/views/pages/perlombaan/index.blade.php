@extends('layouts.master')

@section('title', 'Perlombaan')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Perlombaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Perlombaan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row">
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Table Perlombaan</h3>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a href="{{ route('perlombaan.create') }}" class="card-title  btn btn-primary">+ Buat
                                    Perlombaan</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Perlombaan</th>
                                        <th>Tanggal Perlombaan</th>
                                        <th>Status</th>
                                        <th>Pdf Link</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($competitions as $competition)
                                        <tr>
                                            <td>{{ $competition->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($competition->date)->format('d-m-Y') }}</td>
                                            <td>{{ $competition->status }}</td>
                                            <td><a href="{{ $competition->pdf_link }}" target="_blank">Lihat PDF</a>
                                            </td>
                                            <td class="text-center">
                                                <!-- Action buttons, e.g. Edit, Delete -->
                                                <a href="{{ route('perlombaan.edit', $competition->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <button type="button" class="btn btn-danger delete-btn"
                                                    data-id="{{ $competition->id }}" data-name="{{ $competition->name }}">
                                                    Hapus
                                                </button>
                                                <form id="delete-form-{{ $competition->id }}"
                                                    action="{{ route('perlombaan.destroy', $competition->id) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        // Mengambil semua tombol dengan kelas delete-btn
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil ID dan nama kelas dari data-atribut
                const classId = this.getAttribute('data-id');
                const className = this.getAttribute('data-name');

                // Konfirmasi penghapusan
                if (confirm('Apakah Anda yakin ingin menghapus kelas "' + className + '"?')) {
                    // Kirimkan form penghapusan yang terkait
                    document.getElementById('delete-form-' + classId).submit();
                }
            });
        });
    </script>
@endsection
