<title>Print List Penghuni</title>
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=huWtxcdm7VBnR_EqK6qoaDi1zFlSShkHS9MTmWEMJk37Ptue63NEYdnOoQZaNEUD7BqxoSg4sZGvvGCXK8gOZDc_T2gDXeY4t21qpHG1Jya46oQklxeb1z14HeygLRMl" charset="UTF-8"></script>
<x-app-layout>
    <div class="max-w-full flex justify-between mx-auto px-4 py-12 sm:px-10 lg:px-40">
        <h2 class="text-2xl sm:text-4xl font-semibold leading-tight">Daftar Penghuni</h2>
        <i>Date: {{ date('d-M-Y') }}</i>
    </div>

    <div class="w-full px-4 sm:px-10 lg:px-40">
        <div class="shadow-lg rounded border-b border-gray-200 mb-10">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr class="text-white uppercase text-base leading-normal">
                        <th class="text-left py-3 px-6 font-semibold">ID</th>
                        <th class="text-left py-3 px-6 font-semibold">Nama Penghuni</th>
                        <th class="text-left py-3 px-6 font-semibold">Nama Penanggung Jawab</th>
                        <th class="text-left py-3 px-6 font-semibold">ruang</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-base font-light">
                    @foreach ($penghuni as $pghn)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $pghn->id }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $pghn->namaLengkap }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span>{{ $pghn->nama }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center whitespace-nowrap">
                            <div class="flex items-center">
                                <span>{{ $pghn->ruang }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</x-app-layout>