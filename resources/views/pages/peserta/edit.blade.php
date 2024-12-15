@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Peserta</a></li>
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
                        <h3 class="card-title">Edit Peserta </span>
                        </h3>
                    </div>
                    <!-- form start -->
                    <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                        <h3 class="text-center mt-4 text-bold">{{ $peserta->name }}</h3>
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Peserta</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $peserta->name }}" placeholder="Masukan nama perlombaan" required>
                            </div>
                            <div class="form-group">
                                <label for="bird_name">Nama Burung</label>
                                <input type="text" class="form-control" id="bird_name" name="bird_name"
                                    placeholder="Masukkan nama burung" value="{{ $peserta->bird_name }}" required>
                            </div>

                            <!-- Gantang Number -->
                            <div class="form-group">
                                <label for="no_gantang">No Gantang</label>
                                <input type="number" class="form-control" id="no_gantang" name="no_gantang"
                                    placeholder="Masukkan nomor gantang" value="{{ $peserta->no_gantang }}" required>
                            </div>

                            <!-- Contact Info -->
                            <div class="form-group">
                                <label for="contact_info">Kontak</label>
                                <input type="number" class="form-control" id="contact_info" name="contact_info"
                                    placeholder="Masukkan Nomor Telepon" value="{{ $peserta->contact_info }}" required>
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
@endsection
