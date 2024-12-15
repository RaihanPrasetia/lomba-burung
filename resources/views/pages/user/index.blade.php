@extends('layouts.user')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex my-2 justify-content-end align-items-center">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Hasil SAW</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row">
                            <h3 class="card-title col-sm-6 d-flex align-items-center">Hasil Perlombaan</h3>
                            <div class="col-sm-6 d-flex justify-content-end" style="gap: 8px">
                                <!-- Dropdown Kompetisi -->
                                <form action="{{ route('home') }}" method="GET">
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
                                    <form action="{{ route('home') }}" method="GET">
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

                            @if ($criterias->isNotEmpty() && $results->isNotEmpty())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Peserta</th>
                                            @foreach ($criterias as $criteria)
                                                <th>{{ $criteria->name }}</th>
                                            @endforeach
                                            <th>Total</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $result)
                                            <tr>
                                                <td>{{ $result['participant']->name }}</td>
                                                @foreach ($criterias as $criteria)
                                                    <td>
                                                        {{-- Menampilkan skor ter-normalisasi dan berbobot --}}
                                                        {{ number_format($result['scores'][$criteria->id] ?? 0, 4) }}
                                                    </td>
                                                @endforeach
                                                <td>{{ number_format($result['total'], 4) }}</td>
                                                <td>#{{ $result['rank'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">Silakan pilih kompetisi dan kelas untuk melihat hasil.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
