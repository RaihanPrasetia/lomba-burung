@extends('layouts.master')

@section('title', 'Criteria')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Criteria</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Criteria</li>
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
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Table Criteria</h3>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a href="{{ route('criteria.create') }}" class="card-title  btn btn-primary">+ Buat
                                    Criteria</a>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="mb-2 p-2 bg-success text-white border border-success rounded-lg shadow-sm">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="mb-2 p-2 bg-danger text-white border border-danger rounded-lg shadow-sm">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Criteria</th>
                                        <th>Bobot</th>
                                        <th>Type</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criterias as $criteria)
                                        <tr>
                                            <!-- Mengakses nama kelas -->
                                            <td>{{ $criteria->name }}</td>

                                            <!-- Mengakses juri yang terkait dengan kelas -->
                                            <td>
                                                {{ $criteria->weight }}
                                            </td>

                                            <!-- Mengakses nama kompetisi -->
                                            <td>{{ $criteria->type }}</td>

                                            <td class="text-center">
                                                <!-- Tombol Aksi -->
                                                <a href="{{ route('criteria.edit', $criteria->id) }}"
                                                    class="btn btn-warning">Edit</a>

                                                <button type="button" class="btn btn-danger delete-btn"
                                                    data-id="{{ $criteria->id }}" data-name="{{ $criteria->name }}">
                                                    Hapus
                                                </button>

                                                <form id="delete-form-{{ $criteria->id }}"
                                                    action="{{ route('criteria.destroy', $criteria->id) }}" method="POST"
                                                    style="display:none;">
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
