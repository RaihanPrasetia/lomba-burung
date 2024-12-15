@extends('layouts.master')

@section('title', 'Penilaian')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian Juri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Penilaian</li>
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
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Table Criteria</h3>
                            <div class="col-sm-6 d-flex justify-content-end" style="gap: 8px">
                                <!-- Competition Dropdown -->
                                <form action="{{ route('penilaian.index') }}" method="GET">
                                    <select name="competition_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih Competition</option>
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}"
                                                {{ request('competition_id') == $competition->id ? 'selected' : '' }}>
                                                {{ $competition->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                                <!-- Class Dropdown -->
                                @if (request('competition_id'))
                                    <form action="{{ route('penilaian.index') }}" method="GET">
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

                            @if ($groupedScores)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            <th>Nama Burung</th>
                                            <th>No Gantang</th>
                                            <th>Kontak</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($groupedScores)
                                            @foreach ($groupedScores as $participantId => $scores)
                                                @php
                                                    $participant = $scores->first()->participant; // Ambil data peserta
                                                    $judge = $scores->first()->judge; // Ambil data juri
                                                @endphp
                                                <!-- Baris Peserta -->
                                                <tr>
                                                    <td>{{ $participant->name }}</td>
                                                    <td>{{ $participant->bird_name }}</td>
                                                    <td>{{ $participant->no_gantang }}</td>
                                                    <td>{{ $participant->contact_info }}</td>
                                                    <td>{{ $participant->status }}</td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('penilaian.edit', ['penilaian' => $participant->id, 'class_id' => $scores->first()->class_id]) }}">
                                                            Beri Nilai
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <!-- Jika tidak ada data -->
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data peserta</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            @endif




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
