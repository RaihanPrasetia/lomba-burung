@extends('layouts.master')

@section('title', 'Penilaian')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

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
                                <div id="successMessage" class="toastrDefaultSuccess" style="display: none;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            

                            @if (session('error'))
                                <div id="errorMessage" class="toastrDefaultError" style="display: none;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($groupedScores)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        @if (Auth::user()->role === 'admin')
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Nama Burung</th>
                                                <th>No Gantang</th>
                                                <th>Kontak</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        @elseif(Auth::user()->role === 'juri')
                                            <tr>
                                                <th>No Gantang</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->role === 'admin')
                                            @foreach ($groupedScores as $judgeId => $groupByJudge)
                                                @php
                                                    $judge = \App\Models\User::find($judgeId);
                                                @endphp
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <strong>Juri: {{ $judge->name }}</strong>
                                                    </td>
                                                </tr>

                                                @foreach ($groupByJudge as $participantId => $scores)
                                                    @php
                                                        $participant = $scores->first()->participant; // Ambil data peserta
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $participant->name }}</td>
                                                        <td>{{ $participant->bird_name }}</td>
                                                        <td>{{ $participant->no_gantang }}</td>
                                                        <td>{{ $participant->contact_info }}</td>
                                                        <td>{{ $participant->status }}</td>
                                                        <td class="text-center">
                                                            {{-- <a
                                                                href="{{ route('penilaian.edit', ['penilaian' => $participant->id, 'class_id' => $scores->first()->class_id]) }}">
                                                                Beri Nilai
                                                            </a> --}}
                                                            <a class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#penilaianModal" onclick="editModal(event)"
                                                                data-json='{{ json_encode([
                                                                    'participant_id' => $participant->id,
                                                                    'class_id' => $scores->first()->class_id,
                                                                    'participant_name' => $participant->name,
                                                                    'bird_name' => $participant->bird_name,
                                                                    'no_gantang' => $participant->no_gantang,
                                                                    'class_name' => $scores->first()->class->name,
                                                                    'scores' => $scores->map(function ($score) {
                                                                        return [
                                                                            'criteria_id' => $score->criteria->id,
                                                                            'criteria_name' => $score->criteria->name,
                                                                            'value' => $score->score,
                                                                        ];
                                                                    }),
                                                                ]) }}'>
                                                                <i class="fas fa-pencil-alt"></i>
                                                                Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @elseif(Auth::user()->role === 'juri')
                                            @foreach ($groupedScores as $participantId => $scores)
                                                @php
                                                    $participant = $scores->first()->participant; // Ambil data peserta
                                                @endphp
                                                <tr>
                                                    <td>{{ $participant->bird_name }}</td>
                                                    <td>{{ $participant->status }}</td>
                                                    <td class="text-center">
                                                        {{-- <a
                                                            href="{{ route('penilaian.edit', ['penilaian' => $participant->id, 'class_id' => $scores->first()->class_id]) }}">
                                                            Beri Nilai
                                                        </a> --}}
                                                        <a class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#penilaianModal" onclick="editModal(event)"
                                                            data-json='{{ json_encode([
                                                                'participant_id' => $participant->id,
                                                                'class_id' => $scores->first()->class_id,
                                                                'participant_name' => $participant->name,
                                                                'bird_name' => $participant->bird_name,
                                                                'no_gantang' => $participant->no_gantang,
                                                                'class_name' => $scores->first()->class->name,
                                                                'scores' => $scores->map(function ($score) {
                                                                    return [
                                                                        'criteria_id' => $score->criteria->id,
                                                                        'criteria_name' => $score->criteria->name,
                                                                        'value' => $score->score,
                                                                    ];
                                                                }),
                                                            ]) }}'>
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data peserta</td>
                                </tr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.modals.penilaianModal')
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function editModal(event) {
        const button = event.currentTarget;
        const data = JSON.parse(button.getAttribute('data-json'));

        const participantId = data.participant_id;
        const classId = data.class_id;
        const participantName = data.participant_name;
        const birdName = data.bird_name;
        const noGantang = data.no_gantang;
        const className = data.class_name;
        const scores = data.scores;

        const form = document.getElementById('penilaianForm');
        form.action = `/penilaian/${participantId}`;

        document.getElementById('participantName').innerText = participantName;
        document.getElementById('birdName').innerText = birdName;
        document.getElementById('noGantang').innerText = noGantang;
        document.getElementById('className').innerText = className;
        document.getElementById('participantId').value = participantId;
        document.getElementById('classId').value = classId;

        const scoreInputsContainer = document.getElementById('scoreInputs');
        scoreInputsContainer.innerHTML = '';

        // Isi nilai skor
        scores.forEach(score => {
            const html = `
            <div class="form-group">
                <label for="score_${score.criteria_id}">
                    Nilai untuk ${score.criteria_name}:
                </label>
                <input type="number" class="form-control" id="score_${score.criteria_id}"
                    name="score[${score.criteria_id}]" value="${score.value}"
                    placeholder="Masukkan nilai" required min="0" max="100">
            </div>
        `;
            scoreInputsContainer.innerHTML += html;
        });
    }
</script>
<script type="text/javascript">
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('.toastrDefaultSuccess');
        const errorMessage = document.querySelector('.toastrDefaultError');

        // Jika elemen ada, tampilkan Toast
        if (successMessage) {
            toastr.success(successMessage.textContent);
        }else{
            toastr.error(errorMessage.textContent);
        }

    });
    
</script>
