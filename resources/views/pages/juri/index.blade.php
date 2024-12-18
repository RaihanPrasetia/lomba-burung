@extends('layouts.master')

@section('content')
    <section>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Juri</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Juri</li>
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
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                {{-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div> --}}
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#juriModal" onclick="resetForm()">
                                        + Tambah Juri
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->jenis_kelamin }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td><a class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#juriModal"
                                                        onclick="editForm({{ json_encode($user) }})">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalDelete"
                                                        onclick="deleteForm({{ $user }})">
                                                        <i class="fas fa-trash"></i> Hapus
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </section>
    @include('components.modals.juriModal')
    @include('components.modals.deleteModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function resetForm() {
        document.getElementById('juriForm').reset();
        document.getElementById('method').value = 'POST';
        document.getElementById('juriForm').action = "{{ route('juri.store') }}";
        document.getElementById('modalTitle').textContent = 'Tambah Juri';
        document.getElementById('title').textContent = 'Simpan Juri';
    }

    function editForm(user) {

        resetForm();
        // Isi nilai form dengan data juri
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('password').value = ''; // Kosongkan password
        document.getElementById('jenis_kelamin').value = user.jenis_kelamin;
        document.getElementById('alamat').value = user.alamat;


        // Set action form ke 'update' (PUT)
        const form = document.getElementById('juriForm');
        form.action = `/juri/${user.id}`; // Pastikan ID pengguna benar
        document.getElementById('method').value = 'PUT'; // Set method jadi PUT

        // Ubah judul modal
        document.getElementById('modalTitle').textContent = 'Edit Juri';
        document.getElementById('title').textContent = 'Update Juri';

        // Password tidak wajib diisi saat edit
        document.getElementById('password').required = false;
    }

    function deleteForm(user) {
        document.getElementById('JuriName').textContent = user.name;
        document.getElementById('tittle').textContent = 'Hapus Juri';

        const form = document.getElementById('deleteForm');
        form.action = `/juri/${user.id}`;
    }
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
