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
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#kriteriaModal" onclick="resetForm()">
                                    + Tambah Kriteria
                                </button>
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
                                                <a data-toggle="modal" data-target="#kriteriaModal"
                                                    onclick="editForm({{ json_encode($criteria) }})"
                                                    class="btn btn-warning">Edit</a>

                                                <button type="button" class="btn btn-danger delete-btn" data-toggle="modal"
                                                    data-target="#modalDelete"
                                                    onclick="deleteForm({{ json_encode($criteria) }})">
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
    @include('components.modals.kriteriaModal')
    @include('components.modals.deleteModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
    function resetForm() {
        document.getElementById('kriteriaForm').reset();
        document.getElementById('method').value = 'POST';
        document.getElementById('kriteriaForm').action = "{{ route('criteria.store') }}";
        document.getElementById('modalTitle').textContent = 'Tambah Kriteria';
        document.getElementById('title').textContent = 'Simpan Kriteria';
    }

    function editForm(criteria) {

        resetForm();
        // Isi nilai form dengan data juri
        document.getElementById('name').value = criteria.name;
        document.getElementById('weight').value = criteria.weight;
        document.getElementById('type').value = criteria.type;


        // Set action form ke 'update' (PUT)
        const form = document.getElementById('kriteriaForm');
        form.action = `/criteria/${criteria.id}`; // Pastikan ID pengguna benar
        document.getElementById('method').value = 'PUT'; // Set method jadi PUT

        // Ubah judul modal
        document.getElementById('modalTitle').textContent = 'Edit Kriteria';
        document.getElementById('title').textContent = 'Update Kriteria';
    }

    function deleteForm(criteria) {
        document.getElementById('nameDel').textContent = criteria.name;
        document.getElementById('tittle').textContent = 'Hapus Kriteria';
        document.getElementById('btnDetele').textContent = 'Hapus Kriteria';

        const form = document.getElementById('deleteForm');
        form.action = `/criteria/${criteria.id}`;
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
