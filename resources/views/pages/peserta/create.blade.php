@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('peserta.index') }}">Peserta</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header ">
                            <h3 class="card-title">Buat Peserta</h3>
                        </div>
                        <div class="px-4 mt-3">
                            <form action="{{ route('peserta.create') }}" method="GET">
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
                        </div>


                        <form action="{{ route('peserta.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if (request('competition_id'))
                                    <div class="form-group">
                                        <label for="name">Nama Peserta</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan nama peserta" required>
                                    </div>

                                    <!-- Bird Name -->
                                    <div class="form-group">
                                        <label for="bird_name">Nama Burung</label>
                                        <input type="text" class="form-control" id="bird_name" name="bird_name"
                                            placeholder="Masukkan nama burung" required>
                                    </div>

                                    <!-- Gantang Number -->
                                    <div class="form-group">
                                        <label for="no_gantang">No Gantang</label>
                                        <input type="number" class="form-control" id="no_gantang" name="no_gantang"
                                            placeholder="Masukkan nomor gantang" required>
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="form-group">
                                        <label for="contact_info">Kontak</label>
                                        <input type="number" class="form-control" id="contact_info" name="contact_info"
                                            placeholder="Masukkan Nomor Telepon" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Pilih Kelas</label><br>
                                        @foreach ($classes as $class)
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox"
                                                    id="class_{{ $class->id }}" value="{{ $class->id }}"
                                                    name="class_id[]">
                                                <label for="class_{{ $class->id }}" class="custom-control-label">
                                                    {{ $class->name }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
