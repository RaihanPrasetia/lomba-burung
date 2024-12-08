@extends('layouts.master')

@section('content')
    <section class="w-full">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        <main class="grid grid-cols-3 gap-4 mt-4 text-xl">
            <div
                class="w-full justify-center items-center border  bg-orange-600 rounded-lg shadow-xl text-white font-semibold p-6 flex flex-col space-y-2">
                <i class="fas fa-users text-4xl"></i> {{-- Ikon untuk peserta --}}
                <h2 class="text-3xl">Peserta</h2>
                <span class="text-2xl">50 Orang</span>
            </div>
            <div
                class="w-full justify-center items-center border bg-gray-600 rounded-lg shadow-xl text-white font-semibold p-6 flex flex-col space-y-2">
                <i class="fas fa-user-tie text-4xl"></i> {{-- Ikon untuk juri --}}
                <h2 class="text-3xl">Juri</h2>
                <span class="text-2xl">3 Orang</span>
            </div>
            <div
                class="w-full justify-center items-center border bg-green-600 rounded-lg shadow-xl text-white font-semibold p-6 flex flex-col space-y-2">
                <i class="fas fa-trophy text-4xl"></i> {{-- Ikon untuk kompetisi --}}
                <h2 class="text-3xl">Kompetisi</h2>
                <span class="text-2xl">5 Event</span>
            </div>
        </main>
    </section>
@endsection
