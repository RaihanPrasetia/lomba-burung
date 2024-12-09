@extends('layouts.master')
@section('title', 'Perlombaan')
@section('content')
    <section class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Daftar Perlombaan</h1>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow">
                + Tambah Acara
            </a>
        </div>

        <div class="bg-white shadow-lg overflow-hidden">
            <table class="table-auto w-full border-collapse border text-gray-800">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="border px-4 py-3 text-center w-4">No</th>
                        <th class="border px-4 py-3">Nama</th>
                        <th class="border px-4 py-3">Class</th>
                        <th class="border px-8 py-3 text-center w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="border px-4 py-3 text-center">1</td>
                        <td class="border px-4 py-3">Road to Walikota Cup</td>
                        <td class="border px-4 py-3">
                            <ul class="list-disc list-inside">
                                <li>Class A</li>
                                <li>Class B</li>
                                <li>Class C</li>
                            </ul>
                        </td>
                        <td class="border px-4 py-3 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="#"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-3 rounded shadow flex items-center">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="#" method="POST" class="inline">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded shadow flex items-center"
                                        onclick="return confirm('Yakin ingin menghapus acara ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
@endsection
