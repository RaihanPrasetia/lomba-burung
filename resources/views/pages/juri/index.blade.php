@extends('layouts.master')

@section('title', 'juri')

@section('content')
    <section>
        <div class="flex flex-col my-6 mx-4 rounded-2xl shadow-xl shadow-gray-200">
            <div class="overflow-x-auto rounded-2xl">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow-lg">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                        Alamat
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-left text-gray-500 uppercase lg:p-5">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium text-center text-gray-500 uppercase lg:p-5">
                                        <button type="button" data-modal-toggle="add-user-modal"
                                            class="text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 text-center inline-flex items-center shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                            <svg class="mr-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Tambah Juri
                                        </button>
                                    </th>
                                    <th scope="col" class="p-4 lg:p-5 ">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-100">
                                    <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap lg:p-5 lg:mr-0">
                                        <div class="text-sm font-normal text-gray-500">
                                            <div class="text-base font-semibold text-gray-900">Khairullah Zikri</div>
                                            <div class="text-sm font-normal text-gray-500">KhairullahZikri@yahoo.com</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap lg:p-5">Laki - Laki
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap lg:p-5">
                                        Jln.Patimura No.13</td>
                                    <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap lg:p-5">JURI</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap lg:p-5">
                                        <button type="button" data-modal-toggle="edit-user-modal"
                                            class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 hover:text-gray-900 hover:scale-[1.02] transition-all">
                                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Edit user
                                        </button>
                                        <button type="button" data-modal-toggle="delete-user-modal"
                                            class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform">
                                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Delete user
                                        </button>
                                    </td>
                                    <td class="p-4 w-4 lg:p-5 ">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('components.modals.modalDelete')
    @include('components.modals.modalEdit') --}}
@endsection
