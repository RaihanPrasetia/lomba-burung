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
                        <div class="card-header row">
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Daftar Peserta</h3>
                            <div class="col-sm-6 d-flex justify-content-end" style="gap: 8px">
                                <div class="col-sm-6 d-flex justify-content-end">
                                    <a href="{{ route('peserta.create') }}" class="card-title  btn btn-primary">+
                                        Peserta</a>
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
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
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
@endsection
