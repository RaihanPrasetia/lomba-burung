@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-end">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('perlombaan.index') }}">Perlombaan</a></li>
                        <li class="breadcrumb-item active">Edit</a></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- left column -->
                <div>
                    <!-- general form elements -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Perlombaan </span>
                            </h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('perlombaan.update', $competition->id) }}" method="POST">
                            <h3 class="text-center mt-4 text-bold">{{ $competition->name }}</h3>
                            @csrf
                            @method('PATCH') <!-- Untuk mendukung HTTP PATCH -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Perlombaan</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $competition->name }}" placeholder="Masukan nama perlombaan" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="date"
                                            value="{{ $competition->date }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pdf_link">Link Pdf</label>
                                    <input type="url" class="form-control" id="pdf_link" name="pdf_link"
                                        value="{{ $competition->pdf_link }}" placeholder="Masukan link pdf" required>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="Akan Datang"
                                            {{ $competition->status == 'Akan Datang' ? 'selected' : '' }}>Akan Datang
                                        </option>
                                        <option value="Berlangsung"
                                            {{ $competition->status == 'Berlangsung' ? 'selected' : '' }}>Berlangsung
                                        </option>
                                        <option value="Selesai" {{ $competition->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
