@extends('layouts.master')

@section('title', 'Peserta')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Daftar Peserta</h3>
                            <div class="col-sm-6 d-flex justify-content-end" style="gap: 8px">
                                <div class="col-sm-6 d-flex justify-content-end">
                                    {{-- <a href="{{ route('peserta.create') }}" class="card-title  btn btn-primary">+
                                        Peserta</a> --}}
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
                                            data-target="#pesertaModal" onclick="resetForm()">
                                            + Tambah Peserta
                                        </button>
                                    </div>
                                </div>
                                <!-- Dropdown Kompetisi -->
                                <form action="{{ route('peserta.index') }}" method="GET">
                                    <select name="competition_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih Kompetisi</option>
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}"
                                                {{ request('competition_id') == $competition->id ? 'selected' : '' }}>
                                                {{ $competition->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                                <!-- Dropdown Kelas -->
                                @if (request('competition_id'))
                                    <form action="{{ route('peserta.index') }}" method="GET">
                                        <input type="hidden" name="competition_id" value="{{ request('competition_id') }}">
                                        <select name="class_id" class="form-control" onchange="this.form.submit()">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
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

                                @if (isset($classPesertas) && $classPesertas->isNotEmpty())
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Nama Burung</th>
                                                <th>No Gantang</th>
                                                <th>Kontak</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classPesertas as $classPeserta)
                                                <tr>
                                                    <td>{{ $classPeserta->participant->name }}</td>
                                                    <td>{{ $classPeserta->participant->bird_name }}</td>
                                                    <td>{{ $classPeserta->participant->no_gantang }}</td>
                                                    <td>{{ $classPeserta->participant->contact_info }}</td>
                                                    <td>{{ $classPeserta->participant->status }}</td>
                                                    <td class="text-center">
                                                        <!-- Action buttons, e.g. Edit, Delete -->
                                                        {{-- href="{{ route('peserta.edit', $classPeserta->participant->id) }}" --}}
                                                        <a class="btn btn-warning" data-toggle="modal"
                                                            data-target="#pesertaModal"
                                                            onclick="editForm({{ json_encode($classPeserta->participant) }})">Edit</a>
                                                        <button type="button" class="btn btn-danger delete-btn"
                                                            data-toggle="modal" data-target="#modalDelete"
                                                            onclick="deleteForm({{ json_encode($classPeserta->participant) }})">
                                                            Hapus
                                                        </button>
                                                        {{-- <form id="delete-form-{{ $classPeserta->participant->id }}"
                                                            action="{{ route('peserta.destroy', $classPeserta->participant->id) }}"
                                                            method="POST" style="display:none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center">Pilih kompetisi dan kelas untuk melihat daftar peserta.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @include('components.modals.pesertaModal')
    @include('components.modals.deleteModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function resetForm() {
        document.getElementById('competitionForm').reset();
        document.getElementById('pesertaForm').reset();
        document.getElementById('method').value = 'POST';
        document.getElementById('pesertaForm').action = "{{ route('peserta.store') }}";
        document.getElementById('modalTitle').textContent = 'Tambah Peserta';
        document.getElementById('title').textContent = 'Simpan Peserta';
        competitionForm.style.display = 'block';

        const competitionDropdown = document.getElementById('competition_id');
        const options = Array.from(competitionDropdown.options);

        options.forEach(option => {
            if (option.getAttribute('data-status') !== 'Akan Datang' && option.value !== "") {
                option.style.display = 'none'; // Sembunyikan opsi yang tidak sesuai
            } else {
                option.style.display = 'block'; // Tampilkan opsi yang sesuai
            }
        });
    }

    function filterClasses() {
        const competitionId = document.getElementById('competition_id').value;

        if (competitionId) {
            fetch(`/get-classes?competition_id=${competitionId}`)
                .then(response => response.json())
                .then(data => {
                    let classOptions = '';

                    // Jika kelas ada, tampilkan checkbox
                    if (data.classes.length > 0) {
                        data.classes.forEach(classItem => {
                            classOptions += `
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="class_${classItem.id}" name="class_id[]" value="${classItem.id}">
                                <label for="class_${classItem.id}" class="custom-control-label">${classItem.name}</label>
                            </div>
                        `;
                        });
                    } else {
                        classOptions = '<p>Tidak ada kelas untuk kompetisi ini.</p>';
                    }

                    // Update tampilan kelas
                    document.getElementById('classOptions').innerHTML = classOptions;
                });
        } else {
            // Kosongkan kelas jika kompetisi tidak dipilih
            document.getElementById('classOptions').innerHTML = '';
        }
    }

    function editForm(peserta) {
        resetForm();
        competitionForm.style.display = 'none';
        // Isi nilai form dengan data juri
        document.getElementById('name').value = peserta.name;
        document.getElementById('bird_name').value = peserta.bird_name;
        document.getElementById('no_gantang').value = peserta.no_gantang; // Kosongkan password
        document.getElementById('contact_info').value = peserta.contact_info;

        // Ubah judul modal
        document.getElementById('modalTitle').textContent = 'Edit Peserta';
        document.getElementById('title').textContent = 'Update Peserta';


        // Set action form ke 'update' (PUT)
        const form = document.getElementById('pesertaForm');
        form.action = `/peserta/${peserta.id}`; // Pastikan ID pengguna benar
        document.getElementById('method').value = 'PUT'; // Set method jadi PUT

        $('#pesertaModal').modal('close');
    }

    function deleteForm(participant) {
        document.getElementById('nameDel').textContent = participant.name;
        document.getElementById('tittle').textContent = 'Hapus Peserta';
        document.getElementById('btnDetele').textContent = 'Hapus Peserta';

        const form = document.getElementById('deleteForm');
        form.action = `/peserta/${participant.id}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            $('#pesertaModal').modal('show');
            setTimeout(() => {
                filterClasses();
            }, 200);
            document.getElementById('method').value = 'POST';
            document.getElementById('pesertaForm').action = "{{ route('peserta.store') }}";
            document.getElementById('modalTitle').textContent = 'Tambah Peserta';
            document.getElementById('title').textContent = 'Simpan Peserta';
        @endif
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
