<!-- Sidebar -->
<div class="bg-white text-black  w-64 h-screen shadow-md">
    <!-- Title di atas menu sidebar -->
    <div class="text-lg font-bold py-4 text-center px-6 bg-gray-200 border-b border-gray-300">Menu Utama</div>

    <!-- Menu Navigasi -->
    <nav class="py-6 ">
        <a href="{{ route('dashboard') }}"
            class="block py-2 px-8 hover:text-white hover:bg-gray-700 transition duration-200">Dashboard</a>
        <span class="block px-4 uppercase my-2 text-gray-800 font-semibold">Data Master</span>
        <a href="{{ route('perlombaan.index') }}"
            class="block py-2 px-8 hover:text-white hover:bg-gray-700 transition duration-200">Kelas
            Perlombaan</a>
        <a href="{{ route('penilaian.index') }}"
            class="block py-2 px-8 hover:text-white hover:bg-gray-700 transition duration-200">Penilaian</a>
        <a href="{{ route('juri.index') }}"
            class="block py-2 px-8 hover:text-white hover:bg-gray-700 transition duration-200">Juri</a>
        <a href="{{ route('result.index') }}"
            class="block py-2 px-8 hover:text-white hover:bg-gray-700 transition duration-200">Hasil</a>

        <a href="{{ route('logout') }}"
            class="block w-full mt-4 py-2 px-8 hover:text-white hover:bg-red-700 transition duration-200 ">logout</a>
    </nav>
</div>
