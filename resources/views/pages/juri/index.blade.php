@extends('layouts.master')

@section('content')
    <section class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Daftar Juri</h1>
            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Juri
            </a>
        </div>

        <div class="bg-white shadow-md  overflow-x-auto">
            <table class="table-auto w-full border-collapse border text-gray-800 border-gray-300 text-left">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Jenis Kelamin</th>
                        <th class="border border-gray-300 px-4 py-2">Alamat</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-center">1</td>
                        <td class="border border-gray-300 px-4 py-2">Juri 1</td>
                        <td class="border border-gray-300 px-4 py-2">Laki-Laki</td>
                        <td class="border border-gray-300 px-4 py-2">Riau, Pekanbaru, Jalan Selamat</td>
                        <td class="border border-gray-300 px-4 py-2 flex justify-center items-center space-x-2">
                            <a href="#"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded flex items-center">
                                <i class="fas fa-edit "></i>
                            </a>
                            <form action="#" method="POST" class="inline">
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded flex items-center"
                                    onclick="return confirm('Yakin ingin menghapus juri ini?')">
                                    <i class="fas fa-trash-alt "></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
