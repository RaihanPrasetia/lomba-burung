@extends('layouts.master')

@section('title', 'Hasil SAW')

@section('content')
<section class="content-header">
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header row">
                        <h3 class="card-title col-sm-6 d-flex align-items-center">Hasil Perlombaan</h3>
                        <div class="col-sm-6 d-flex justify-content-end" style="gap: 8px">

                            <form action="{{ route('score.index') }}" method="GET" id="filterForm" class="d-flex"
                                style="gap: 8px">

                                <select name="competition_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Kompetisi</option>
                                    @foreach ($competitions as $competition)
                                    <option value="{{ $competition->id }}"
                                        {{ request('competition_id') == $competition->id ? 'selected' : '' }}>
                                        {{ $competition->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @if (request('competition_id'))
                                <select name="class_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif

                                @if (request('class_id') && $judges->isNotEmpty())
                                <select name="judge_id" class="form-control" onchange="this.form.submit()">

                                    {{-- Periksa apakah user adalah juri --}}
                                    @if (Auth::check() && Auth::user()->role === 'juri')

                                    {{-- Jika juri, hanya tampilkan opsi "Semua Juri" dan dirinya sendiri --}}
                                    <option value="all" {{ request('judge_id') == 'all' ? 'selected' : '' }}>
                                        Semua Juri
                                    </option>
                                    <option value="{{ Auth::id() }}"
                                        {{ request('judge_id') == Auth::id() ? 'selected' : '' }}>
                                        {{ Auth::user()->name }} (Anda)
                                    </option>

                                    @else

                                    {{-- Jika bukan juri (misal: admin), tampilkan semua juri yang ada --}}
                                    <option value="all"
                                        {{ request('judge_id') == 'all' || !request('judge_id') ? 'selected' : '' }}>
                                        Semua Juri
                                    </option>
                                    @foreach ($judges as $judge)
                                    <option value="{{ $judge->id }}"
                                        {{ request('judge_id') == $judge->id ? 'selected' : '' }}>
                                        {{ $judge->name }}
                                    </option>
                                    @endforeach

                                    @endif

                                </select>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($results->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No Gantangan</th>
                                    @foreach ($criterias as $criteria)
                                    <th>{{ $criteria->name }} ({{ $criteria->weight }})</th>
                                    @endforeach
                                    <th>Total</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result['participant']->no_gantang }}</td>
                                    @foreach ($criterias as $criteria)
                                    <td>
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
