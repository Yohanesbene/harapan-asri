<x-app-layout>
    <div class="max-w-full flex justify-start mx-auto px-4 py-12 sm:px-10 lg:px-40">
        <!-- START: Button Kembali -->
        <a href="{{ route('admin.dashboard') }}">
            <button class="bg-white text-gray-500 font-bold rounded border-b-2 border-gray-500 hover:border-gray-600 hover:bg-gray-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.02698 11.9929L5.26242 16.2426L6.67902 14.8308L4.85766 13.0033L22.9731 13.0012L22.9728 11.0012L4.85309 11.0033L6.6886 9.17398L5.27677 7.75739L1.02698 11.9929Z"
                        fill="currentColor" />
                </svg>
                <span class="mr-2">Kembali</span>
            </button>
        </a>
        <!-- END: Button Kembali -->
        {{-- <a class="text-sm bg-gray-500 hover:bg-gray-700 text-white py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('admin.dashboard') }}">{{ __('Back') }}</a> --}}
    </div>
    <div class="max-w-full flex justify-between mx-auto px-4 py-12 sm:px-10 lg:px-40">
        <h2 class="text-2xl sm:text-4xl font-semibold leading-tight">Daftar Pegawai</h2>
        <a href="{{ route('admin.tambahPegawai') }}">
            <button class="flex justify-end mb-6 bg-white text-green-500 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block">
                        <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"
                            fill="currentColor" />
                    </svg>
                    <span class="mr-2">Tambah Pegawai</span>
                </button>
        </a>
        {{-- <a class="text-sm bg-green-500 hover:bg-green-700 text-white py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('admin.tambahPegawai') }}">{{ __('Tambah Pegawai') }}</a> --}}
    </div>
    <div class="w-full px-4 sm:px-10 lg:px-40">
        <div class="shadow-lg overflow-x-auto rounded border-b border-gray-200 mb-10">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr class="text-white uppercase text-base leading-normal">
                        <th class="text-left py-3 px-4 font-semibold text-base">ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-base">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold text-base">Posisi</th>
                        <th class="text-left py-3 px-4 font-semibold text-base">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-base font-light">
                    @foreach ($pegawai as $pegawai)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $pegawai->id }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $pegawai->nama }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span>{{ $pegawai->posisi }}</span>
                            </div>
                        </td>
                        <td class="p-3 px-4 flex">
                            <a href="editPenghuni/{{ $pegawai->id }}" class="mr-3 text-sm bg-indigo-100 hover:bg-indigo-300 text-black py-2 px-4 rounded focus:outline-none transition duration-200">Edit</a>
                            <a href="deletePenghuni/{{ $pegawai->id }}" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded focus:outline-none transition duration-200">Delete</a>
                        </td>
                        {{-- <td class="w-1/3 text-left py-3 px-4">{{ $pegawai->nama }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $pegawai->posisi }}</td>
                        <td class="p-3 px-4 flex">
                            <a href="dataPegawai/edit/{{ $pegawai->id }}" class="mr-3 text-sm bg-blue-100 hover:bg-blue-300 text-black py-2 px-4 rounded focus:outline-none transition duration-200">Edit</a>
                            <a href="dataPegawai/delete/{{ $pegawai->id }}" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded focus:outline-none transition duration-200">Delete</a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{ $pegawai->links('vendor.pagination.tailwind') }} --}}
        <div class="flex justify-end mb-6 ">
            <a href="{{ route('admin.printListPegawai') }}" target="_blank">
                <button class="bg-white text-blue-500 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                        <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"
                                fill="currentColor" />
                        </svg>
                        <span class="mr-2">Cetak Data</span>
                    </button>
            </a>

        </div>
    </div>
</x-app-layout>