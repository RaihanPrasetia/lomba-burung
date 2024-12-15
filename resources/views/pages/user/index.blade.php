@extends('layouts.user')

@section('content')
    <main class="mt-3">
        <!-- Content Header -->
        <section class="content-header mb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Data Peringkat</h3>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">@yield('breadcrumb', 'Event')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <form action="{{ route('home') }}" method="GET">
                            <label for="selectCompetition">Pilih Event</label>
                            <select id="selectCompetition" class="form-select" name="competition_id"
                                onchange="this.form.submit()">
                                <option value="" disabled selected>Pilih Event</option>
                                @foreach ($competitions as $competition)
                                    <option value="{{ $competition->id }}"
                                        {{ request('competition_id') == $competition->id ? 'selected' : '' }}>
                                        {{ $competition->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($classes->isNotEmpty())
                            <div class="d-flex justify-content-center align-items-center py-3 gap-3 flex-wrap">
                                @foreach ($classes as $class)
                                    <a href="#" class="btn btn-dark">{{ $class->name }}</a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center">Tidak ada kelas yang tersedia untuk event ini.</p>
                        @endif
                    </div>
                </div>
                <div>
                    @yield('ranking')
                </div>
            </div>
        </section>




    </main>
@endsection
