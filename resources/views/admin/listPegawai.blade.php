<title>Print List Pegawai</title>
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=huWtxcdm7VBnR_EqK6qoaDi1zFlSShkHS9MTmWEMJk37Ptue63NEYdnOoQZaNEUD7BqxoSg4sZGvvGCXK8gOZDc_T2gDXeY4t21qpHG1Jya46oQklxeb1z14HeygLRMl" charset="UTF-8"></script>


<x-app-layout>
    <div class="w-full px-4 sm:px-10 lg:px-40">
        <div class="shadow-lg overflow-x-auto rounded border-b border-gray-200 mb-10">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr class="text-white uppercase text-base leading-normal">
                        <th class="text-left py-3 px-4 font-semibold text-base">ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-base">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold text-base">Posisi</th>
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

        <!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</x-app-layout>

