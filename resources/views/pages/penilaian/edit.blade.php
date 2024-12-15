@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penilaian.index') }}">Penilaian</a></li>
                    <li class="breadcrumb-item active">Nilai</li>
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
                        <h3 class="card-title">Beri Nilai</h3>
                    </div>
                    <!-- form start -->
                    <form action="{{ route('penilaian.update', $scores[0]->id) }}" method="POST">
                        @csrf
                        @method('PATCH') <!-- Untuk menggunakan metode PATCH -->

                        <div class="card-body">
                            <h3 class="text-center mt-4 text-bold">Peserta: {{ $scores[0]->participant->name }}</h3>
                            <p class="text-center">Nama Burung: {{ $scores[0]->participant->bird_name }}</p>

                            <!-- Menampilkan Nama Class di bawah Burung -->
                            <p class="text-center">Nama Class: {{ $scores[0]->class->name }}</p>

                            <!-- Tampilkan daftar penilaian untuk masing-masing criteria -->
                            @foreach ($scores as $score)
                                <div class="form-group">
                                    <label for="score_{{ $score->id }}">
                                        Nilai untuk {{ $score->criteria->name }}:
                                    </label>
                                    <input type="number" class="form-control" id="score_{{ $score->id }}" name="score"
                                        value="{{ $score->score }}" placeholder="Masukan nilai" required min="0"
                                        max="100">
                                </div>
                            @endforeach
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
