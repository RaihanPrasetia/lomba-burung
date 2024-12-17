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
                        <div class="card-header bg-primary text-white">
                            <div class="card-title d-flex align-items-center">
                                <i class="fas fa-crow mr-2"></i>
                                <span style="font-size: 20px"> Daftar Perlombaan Burung Kicau</span>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($competitions->count() > 0)
                                <div class="row">
                                    @foreach ($competitions as $competition)
                                        <div class="col-md-6 mb-4">
                                            <div class="border rounded shadow-sm p-4 competition-card">
                                                <h5 class="mb-3 fw-bold text-primary d-flex align-items-center">
                                                    <i class="fas fa-trophy mr-2"></i>{{ $competition->name }}
                                                </h5>
                                                <p class="mb-2">
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    Tanggal:
                                                    {{ \Carbon\Carbon::parse($competition->date)->format('d M Y') }}
                                                </p>
                                                <a href="{{ $competition->pdf_link }}" target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-file-pdf me-1"></i> Lihat Detail PDF
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning text-center" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i> Tidak ada data perlombaan yang tersedia.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .competition-card {
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .competition-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                border-color: #007bff;
            }

            .btn-outline-primary:hover {
                color: white !important;
                background-color: #007bff !important;
            }
        </style>
    @endpush
@endsection
