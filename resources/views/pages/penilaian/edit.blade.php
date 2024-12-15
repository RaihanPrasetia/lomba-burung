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
                    <form action="{{ route('penilaian.update', $scores->first()->id) }}" method="POST">
                        @csrf
                        @method('PATCH') <!-- Menggunakan metode PATCH untuk update data -->

                        <div class="card-body">
                            <h3 class="text-center mt-4 text-bold">Peserta: {{ $scores->first()->participant->name }}</h3>
                            <p class="text-center">Nama Burung: {{ $scores->first()->participant->bird_name }}</p>

                            <!-- Menampilkan Nama Class -->
                            <p class="text-center">Nama Class: {{ $scores->first()->class->name }}</p>

                            <!-- Form untuk setiap skor berdasarkan criteria -->
                            @foreach ($scores as $score)
                                <div class="form-group">
                                    <label for="score_{{ $score->id }}">
                                        Nilai untuk {{ $score->criteria->name }}:
                                    </label>
                                    <input type="number" class="form-control" id="score_{{ $score->id }}"
                                        name="score[{{ $score->id }}]" value="{{ $score->score }}"
                                        placeholder="Masukan nilai" required min="0" max="100">
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
