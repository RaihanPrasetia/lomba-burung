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
                                <a class="card-title  btn btn-primary" data-toggle="modal" data-target="#perlombaanModal"
                                    onclick="resetForm()">+ Buat
                                    Perlombaan</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div id="successMessage" class="toastrDefaultSuccess" style="display: none;">
                                    {{ session('success') }}
                                </div>
                            @endif


                            @if (session('error'))
                                <div id="errorMessage" class="toastrDefaultError" style="display: none;">
                                    {{ session('error') }}
                                </div>
                            @endif
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
                                                <a class="btn btn-warning" data-toggle="modal"
                                                    data-target="#perlombaanModal"
                                                    onclick="editForm({{ json_encode($competition) }})">Edit</a>
                                                <button type="button" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#modalDelete" onclick="deleteForm({{ json_encode($competition) }})">
                                                    Hapus
                                                </button>
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
    @include('components.modals.perlombaanModal')
    @include('components.modals.deleteModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function resetForm() {
        document.getElementById('perlombaanForm').reset();
        document.getElementById('method').value = 'POST';
        document.getElementById('perlombaanForm').action = "{{ route('perlombaan.store') }}";
        document.getElementById('modalTitle').textContent = 'Tambah perlombaan';
        document.getElementById('title').textContent = 'Simpan perlombaan';
    }

    function editForm(perlombaan) {

        resetForm();
        // Isi nilai form dengan data juri
        document.getElementById('name').value = perlombaan.name;
        document.getElementById('date').value = perlombaan.date;
        document.getElementById('status').value = perlombaan.status; // Kosongkan password
        document.getElementById('pdf_link').value = perlombaan.pdf_link;


        // Set action form ke 'update' (PUT)
        const form = document.getElementById('perlombaanForm');
        form.action = `/perlombaan/${perlombaan.id}`; // Pastikan ID pengguna benar
        document.getElementById('method').value = 'PUT'; // Set method jadi PUT

        // Ubah judul modal
        document.getElementById('modalTitle').textContent = 'Edit Perlombaan';
        document.getElementById('title').textContent = 'Update Perlombaan';
    }

    function deleteForm(perlombaan) {
        document.getElementById('nameDel').textContent = perlombaan.name;
        document.getElementById('tittle').textContent = 'Hapus Perlombaan';
        document.getElementById('btnDetele').textContent = 'Hapus Perlombaan';

        const form = document.getElementById('deleteForm');
        form.action = `/perlombaan/${perlombaan.id}`;
    }

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

<script type="text/javascript">
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('.toastrDefaultSuccess');
        const errorMessage = document.querySelector('.toastrDefaultError');

        // Jika elemen ada, tampilkan Toast
        if (successMessage) {
            toastr.success(successMessage.textContent);
        } else if (errorMessage) {
            toastr.error(errorMessage.textContent);
        }

    });
</script>
