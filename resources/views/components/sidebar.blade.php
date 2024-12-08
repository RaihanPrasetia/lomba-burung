<!-- Sidebar -->
<div class="bg-gray-100 text-black  w-64 h-screen shadow-md border-r border-white">
    <!-- Title di atas menu sidebar -->
    <div class="text-2xl font-bold py-7 text-center px-6 bg-gray-700 text-white border-b border-gray-300">Menu Utama
    </div>

    <!-- Menu Navigasi -->
    <nav class="py-6 px-2 font-semibold ">
        <a href="{{ route('dashboard') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Dashboard</a>
        <span class="block px-4 uppercase py-1 text-gray-500 mb-1 font-bold border-b border-gray-800">Data Master</span>
        <a href="{{ route('perlombaan.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Perlombaan</a>
        <a href="{{ route('class.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Class</a>
        <a href="{{ route('criteria.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Kriteria</a>
        <a href="{{ route('peserta.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Peserta</a>
        <a href="{{ route('juri.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Juri</a>
        <span class="block px-4 uppercase py-1 text-gray-500 mb-1 font-bold border-b border-gray-800">Penilaian
            Master</span>

        <a href="{{ route('penilaian.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Penilaian</a>
        <a href="{{ route('score.index') }}"
            class="block py-2 px-8 hover:text-white rounded-lg hover:bg-gray-700 transition duration-200">Hasil</a>

        <a href="{{ route('logout') }}"
            class="block w-full mt-4 py-2 px-8 rounded-lg hover:text-white hover:bg-red-700 transition duration-200 ">logout</a>
    </nav>
</div>
