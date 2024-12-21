@extends('layouts.master')

@section('title', 'Class')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Classes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Class</li>
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
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Table Class</h3>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a class="card-title  btn btn-primary" data-toggle="modal" data-target="#kelasModal"
                                    onclick="resetForm()">+ Buat
                                    Class</a>
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
                                        <th>Nama Class</th>
                                        <th>Nama Perlombaan</th>
                                        <th>Nama Juri</th>
                                        <th>Daftar Criteria</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedClasses as $class_id => $classGroup)
                                        @foreach ($classGroup as $class)
                                            <tr>
                                                <!-- Mengakses nama kelas -->
                                                <td>{{ $class->name }}</td>

                                                <!-- Mengakses nama kompetisi -->
                                                <td>{{ $class->competition->name }}</td>

                                                <!-- Mengakses nama juri -->
                                                <td>
                                                    <ul class="pl-4 mb-0">
                                                        @foreach ($class->class_participants as $participant)
                                                            <li> {{ $participant->judge->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>

                                                <!-- Mengakses kriteria -->
                                                <td>
                                                    <ul class="pl-4 mb-0">
                                                        @if ($class->class_criterias->isNotEmpty())
                                                            @foreach ($class->class_criterias as $class_criteria)
                                                                <li>
                                                                    {{ $class_criteria->criteria->name }}
                                                                    ({{ $class_criteria->criteria->weight }})
                                                                </li>
                                                            @endforeach
                                                        @else
                                                    </ul>
                                                    <span class="text-muted">Tidak ada kriteria</span>
                                        @endif
                                        </td>

                                        <!-- Tombol Aksi -->
                                        <td class="text-center">
                                            <a class="btn btn-warning" data-toggle="modal" data-target="#kelasModal"
                                                onclick="editForm({{ $class->id }})">Edit</a>
                                            <button type="button" class="btn btn-danger delete-btn" data-toggle="modal"
                                                data-target="#modalDelete"
                                                onclick="formDelete({ id: {{ $class->id }}, name: '{{ $class->name }}' })">
                                                Hapus
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
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
    @include('components.modals.kelasModal')
    @include('components.modals.deleteModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('#successMessage');
        const errorMessage = document.querySelector('#errorMessage');

        // Jika elemen ada, tampilkan Toast
        if (successMessage) {
            toastr.success(successMessage.textContent);
        } else if (errorMessage) {
            toastr.error(errorMessage.textContent);
        }

    });
</script>

<script type="text/javascript">
    function resetForm() {
        document.getElementById('kelasForm').reset();
        document.getElementById('method').value = 'POST';
        document.getElementById('class_id').value = ''; // Reset ID
        document.getElementById('modalTitle').innerText = "Tambah Kelas";
        document.getElementById('submitBtn').innerText = "Simpan Kelas";

        // Ambil data untuk competition, judges, dan criteria melalui AJAX
        fetch('/class/create')
            .then(response => response.json())
            .then(data => {
                // Mengisi data kompetisi
                let competitionSelect = document.getElementById('competition_id');
                competitionSelect.innerHTML = ''; // Clear previous options
                data.competitions.forEach(comp => {
                    let option = document.createElement('option');
                    option.value = comp.id;
                    option.textContent = comp.name;
                    competitionSelect.appendChild(option);
                });

                // Mengisi data juri
                let judgesDiv = document.getElementById('judgesList');
                judgesDiv.innerHTML = ''; // Clear previous checkboxes
                data.judges.forEach(judge => {
                    let checkbox = `<div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="judge_${judge.id}"
                                        value="${judge.id}" name="judge_id[]">
                                        <label for="judge_${judge.id}" class="custom-control-label">${judge.name}</label>
                                      </div>`;
                    judgesDiv.innerHTML += checkbox;
                });

                // Mengisi data kriteria
                let criteriaDiv = document.getElementById('criteriaList');
                criteriaDiv.innerHTML = ''; // Clear previous checkboxes
                data.criterias.forEach(criteria => {
                    let checkbox = `<div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="criteria_${criteria.id}"
                                        value="${criteria.id}" name="criteria_id[]">
                                        <label for="criteria_${criteria.id}" class="custom-control-label">${criteria.name} - <span>${criteria.weight}</span></label>
                                      </div>`;
                    criteriaDiv.innerHTML += checkbox;
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function editForm(classId) {
        // Reset form sebelum mengisi data
        document.getElementById('kelasForm').reset();
        document.getElementById('method').value = 'PUT';
        document.getElementById('class_id').value = classId;

        // Ambil data kelas menggunakan AJAX (ambil data sesuai ID)
        fetch(`/class/${classId}/edit`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Isi data modal dengan data kelas yang sudah ada
                document.getElementById('modalTitle').innerText = "Edit Class";
                document.getElementById('name').value = data.class.name;
                document.querySelector(`select[name="competition_id"]`).value = data.class.competition_id;

                let competitionOptions = data.competitions.map(competition =>
                    `<option value="${competition.id}" ${competition.id === data.class.competition_id ? 'selected' : ''}>${competition.name}</option>`
                ).join('');
                document.querySelector('select[name="competition_id"]').innerHTML = competitionOptions;

                // Isi data juri (judges)
                $('#judgesList').html(''); // Kosongkan list juri lama
                data.judges.forEach(function(judge) {
                    let isChecked = data.class.class_participants.some(participant => participant
                        .judge_id === judge.id) ? 'checked' : '';
                    $('#judgesList').append(`
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="judge_${judge.id}" value="${judge.id}" name="judge_id[]" ${isChecked}>
                        <label for="judge_${judge.id}" class="custom-control-label">${judge.name}</label>
                    </div>
                `);
                });

                // Isi data kriteria (criterias)
                $('#criteriaList').html(''); // Kosongkan list kriteria lama
                data.criterias.forEach(function(criteria) {
                    let isChecked = data.class.class_criterias.some(classCriteria => classCriteria
                        .criteria_id === criteria.id) ? 'checked' : '';
                    $('#criteriaList').append(`
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="criteria_${criteria.id}" value="${criteria.id}" name="criteria_id[]" ${isChecked}>
                        <label for="criteria_${criteria.id}" class="custom-control-label">${criteria.name} - <span>${criteria.weight}</span></label>
                    </div>
                `);
                });

                // Ganti button menjadi update
                document.getElementById('submitBtn').innerText = "Update Kelas";
            })
            .catch(error => console.error('Error:', error));
    }

    function formDelete(classData) {
        console.log('Data yang diterima:', classData);
        document.getElementById('nameDel').textContent = classData.name;
        document.getElementById('tittle').textContent = 'Hapus Kelas';
        document.getElementById('btnDetele').textContent = 'Hapus Kelas';

        const form = document.getElementById('deleteForm');
        if (form) {
            form.action = `/class/${classData.id}`; // Set action ke URL yang sesuai
        } else {
            console.error('Form dengan ID "deleteForm" tidak ditemukan.');
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenMeta) {
            console.error('CSRF token meta tag not found!');
            return; // Exit early if CSRF token is not found
        }

        // Get the CSRF token from the meta tag
        const csrfToken = csrfTokenMeta.content;

        // Set the CSRF token value to the hidden input field
        const tokenInput = document.querySelector('input[name="_token"]');
        if (tokenInput) {
            tokenInput.value = csrfToken;
        } else {
            console.error('CSRF token input field not found!');
        }

        const form = document.getElementById('kelasForm');
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const classId = document.getElementById('class_id').value;
                const formData = new FormData(this);

                try {
                    const response = await fetch(`/class/${classId}`, {
                        method: 'POST', // Laravel will read '_method' for PUT
                        headers: {
                            'X-CSRF-TOKEN': csrfToken, // Use the CSRF token here
                        },
                        body: formData,
                    });

                    // Check if the response is JSON
                    const result = await response.json().catch(error => {
                        console.error('Failed to parse JSON:', error);
                        return null;
                    });

                    if (result && result.success) {
                        location.reload();
                    } else {
                        alert('Gagal memperbarui data: ' + (result?.message || ''));
                    }
                } catch (error) {
                    console.error(error.message);
                    alert('Terjadi kesalahan saat memperbarui data.');
                }
            });
        } else {
            console.error("Form dengan ID 'kelasForm' tidak ditemukan.");
        }
    });
</script>
