@extends('layouts.master')

@section('title', 'Class')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                                    <a href="{{ route('class.create') }}" class="card-title  btn btn-primary">+ Buat
                                        Class</a>
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
                                                <a href="{{ route('class.edit', $class->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <button type="button" class="btn btn-danger delete-btn"
                                                    data-id="{{ $class->id }}" data-name="{{ $class->name }}">
                                                    Hapus
                                                </button>
                                                <form id="delete-form-{{ $class->id }}"
                                                    action="{{ route('class.destroy', $class->id) }}" method="POST"
                                                    style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
    </div>
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
