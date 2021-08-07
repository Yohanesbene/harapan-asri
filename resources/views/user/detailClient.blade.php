<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<x-app-layout>

    <!-- Navbar -->
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('user.keperawatan')" :active="request()->routeIs('user.keperawatan')">
                            {{ __('Keperawatan') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->username }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="GET" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.keperawatan')" :active="request()->routeIs('user.keperawatan')">
                    {{ __('Keperawatan') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->username }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="GET" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="max-w-full flex justify-between mx-auto px-4 py-12 sm:px-10 lg:px-40">
        @foreach ($penghuni as $pghn)
        <!-- START: Button Kembali -->
        <a href="{{ route('user.dashboard') }}">
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
        <!-- START: Button Cetak Data -->
        <a href="/user/detailPenghuni/printDetailClient/{{ $pghn->id }}" target="_blank">
            <button class="bg-white text-blue-500 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"
                        fill="currentColor" />
                </svg>
                <span class="mr-2">Cetak Data</span>
            </button>
        </a>
        <!-- END: Button Cetak Data -->
    </div>
    <div class="w-full flex flex-row flex-wrap px-4 sm:px-10 lg:px-40 my-4">
        <div class="mx-auto w-full">

            <!-- START: Profile Photo Section -->
            <div class="rounded-lg shadow-lg bg-white w-64 border-t-4 border-green-400 justify-center flex flex-row flex-wrap p-5 antialiased mb-6">
                <div class="object-cover h-full w-64">
                    <img src="{{ asset('images/' . $pghn->foto) }}" alt="Foto Penghuni" class="w-96 object-cover h-64" >
                </div>
            </div>
            <!-- END: Profile Photo Section -->
            <!-- START: Detail Section -->
            <div class="rounded-lg shadow-lg bg-white w-full border-t-4 border-green-400 p-5 antialiased">
                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                    <span class="text-green-500">
                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="tracking-wide text-green-500">Detail Penghuni</span>
                </div>
                <div class="text-gray-700 py-4">
                    <div class="grid md:grid-cols-1 text-base">
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Nama Lengkap</div>
                            <span class="px-4 py-2">{{ $pghn->namaLengkap }}</span>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Nama Panggilan</div>
                            <div class="px-4 py-2">{{ $pghn->namaPanggilan }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Nama Penanggung Jawab</div>
                            <div class="px-4 py-2">{{ $pghn->nama }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Alamat Penanggung Jawab</div>
                            <div class="px-4 py-2">{{ $pghn->alamatPJ }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Telepon Penanggung Jawab</div>
                            <div class="px-4 py-2">{{ $pghn->telpon }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Tanggal Lahir</div>
                            <div class="px-4 py-2">{{ $pghn->tgllahir }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Gender</div>
                            <div class="px-4 py-2">{{ $pghn->gender }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Agama</div>
                            <div class="px-4 py-2">{{ $pghn->agama }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Alamat</div>
                            <div class="px-4 py-2">{{ $pghn->alamat }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Nomor Telepon</div>
                            <div class="px-4 py-2">{{ $pghn->notelp }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Asal Daerah</div>
                            <div class="px-4 py-2">{{ $pghn->asalDaerah }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Ruang</div>
                            <div class="px-4 py-2">{{ $pghn->ruang }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Tanggal Masuk</div>
                            <div class="px-4 py-2">{{ $pghn->tglMasuk }}</div>
                        </div>
                        <div class="grid grid-cols-2">
                            @if ($pghn->tglKeluar == NULL)
                            <div class="px-4 py-2 font-bold">Tanggal Keluar</div>
                            <div class="px-4 py-2">-</div>
                                
                            @else
                            <div class="px-4 py-2 font-bold">Tanggal Keluar</div>
                            <div class="px-4 py-2">{{ $pghn->tglKeluar }}</div>
                            @endif
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Meninggal</div>
                            @if ($pghn->meninggal == 1)
                                <div class="px-4 py-2">Sudah</div>
                            @else
                                <div class="px-4 py-2">Belum</div>
                            @endif
                            
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="px-4 py-2 font-bold">Keluar</div>
                            @if ($pghn->keluar == 1)
                                <div class="px-4 py-2">Sudah</div>
                            @else
                                <div class="px-4 py-2">Belum</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Detail Section -->
            <!-- START: Data Medic -->
            <div class="w-full">
                <div class="w-full mt-6 md:flex">
                    <!-- START: Data Berat Badan -->
                    <div class="w-full md:w-1/2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Berat Badan</h3>
                                        <p class="text-sm text-gray-500">Data Berat Badan Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartBerat" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Berat Badan -->
                    <!-- START: Data Nadi -->
                    <div class="w-full md:w-1/2 md:ml-6">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Nadi</h3>
                                        <p class="text-sm text-gray-500">Data Nadi Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartNadi" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Nadi -->
                </div>
            </div>
            <!-- END: Data Medic -->
            <!-- START: Data Medic 2 -->
            <div class="w-full">
                <div class="w-full mt-6 md:flex">
                    <!-- START: Data Suhu Badan -->
                    <div class="w-full md:w-1/2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Suhu Badan</h3>
                                        <p class="text-sm text-gray-500">Data Suhu Badan Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartSuhu" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Suhu Badan -->
                    <!-- START: Data SpO2 -->
                    <div class="w-full md:w-1/2 md:ml-6">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">SpO2</h3>
                                        <p class="text-sm text-gray-500">Data SpO2 Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartSpO2" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data SpO2 -->
                </div>
            </div>
            <!-- END: Data Medic 2 -->
            <!-- START: Data Medic 3 -->
            <div class="w-full">
                <div class="w-full mt-6 md:flex">
                    <!-- START: Data Tekanan Darah -->
                    <div class="w-full md:w-1/2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Tekanan Darah</h3>
                                        <p class="text-sm text-gray-500">Data Tekanan Darah Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartTekananDarah" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Tekanan Darah -->
                    <!-- START: Data Nutrisi -->
                    <div class="w-full md:w-1/2 md:ml-6">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Nutrisi</h3>
                                        <p class="text-sm text-gray-500">Data Nutrisi Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartNutrisi" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Nutrisi -->
                </div>
            </div>
            <!-- END: Data Medic 3 -->
            <!-- START: Data Medic 4 -->
            <div class="w-full">
                <div class="w-full mt-6 md:flex">
                    <!-- START: Data Cairan -->
                    <div class="w-full md:w-1/2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Cairan/Minum</h3>
                                        <p class="text-sm text-gray-500">Data Cairan Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartCairan" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Cairan -->
                    <!-- START: Data GDS -->
                    <div class="w-full md:w-1/2 md:ml-6">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">GDS</h3>
                                        <p class="text-sm text-gray-500">Data GDS Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartGDS" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data GDS -->
                </div>
            </div>
            <!-- END: Data Medic 4 -->
            <!-- START: Data Medic 5 -->
            <div class="w-full">
                <div class="w-full mt-6 md:flex">
                    <!-- START: Data Asam Urat -->
                    <div class="w-full md:w-1/2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Asam Urat</h3>
                                        <p class="text-sm text-gray-500">Data Asam Urat Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartAsamUrat" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Asam Urat -->
                    <!-- START: Data Kolesterol -->
                    <div class="w-full md:w-1/2 md:ml-6">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-5 pt-8 pb-10 relative">
                                    <div class="mb-2 pb-2">
                                        <h3 class="text-lg text-gray-600 font-semibold leading-tight pb-2">Kolesterol</h3>
                                        <p class="text-sm text-gray-500">Data Kolesterol Penghuni Per Hari</p>
                                    </div>
                                    <canvas id="chartKolesterol" class="w-full" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Data Kolesterol -->
                </div>
            </div>
            <!-- END: Data Medic 5 -->
        </div>
            
        @endforeach
    </div>
</x-app-layout>

<script>
    // Chart Data Berat
    var areaChartCanvas = $('#chartBerat').get(0).getContext('2d')
    var areaChartData = {
      labels  : [
          @foreach ( $beratbadan as $databerat)
            '{{ $databerat->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $beratbadan as $databerat)
                '{{ $databerat->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    // Chart Data Nadi
    var areaChartCanvasNadi = $('#chartNadi').get(0).getContext('2d')
    var areaChartDataNadi = {
      labels  : [
          @foreach ( $nadi as $nadiwaktu)
            '{{ $nadiwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $nadi as $nadihasil)
                '{{ $nadihasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsNadi = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasNadi, {
      type: 'line',
      data: areaChartDataNadi,
      options: areaChartOptionsNadi
    })

    // Chart Data Suhu
    var areaChartCanvasSuhu = $('#chartSuhu').get(0).getContext('2d')
    var areaChartDataSuhu = {
      labels  : [
          @foreach ( $suhu as $suhuwaktu)
            '{{ $suhuwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $suhu as $suhuhasil)
                '{{ $suhuhasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsSuhu = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasSuhu, {
      type: 'line',
      data: areaChartDataSuhu,
      options: areaChartOptionsSuhu
    })

    // Chart Data SpO2
    var areaChartCanvasSpO2 = $('#chartSpO2').get(0).getContext('2d')
    var areaChartDataSpO2 = {
      labels  : [
          @foreach ( $spo2 as $spo2waktu)
            '{{ $spo2waktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $spo2 as $spo2hasil)
                '{{ $spo2hasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsSpO2 = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasSpO2, {
      type: 'line',
      data: areaChartDataSpO2,
      options: areaChartOptionsSpO2
    })

    // Chart Data Tekanan Darah
    var areaChartCanvasTekananDarah = $('#chartTekananDarah').get(0).getContext('2d')
    var areaChartDataTekananDarah = {
      labels  : [
          @foreach ( $tekananDarah as $tekananDarahwaktu)
            '{{ $tekananDarahwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : 'Systole',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $tekananDarah as $tekananDarahsystole)
                '{{ $tekananDarahsystole->systole }}',
              @endforeach
          ]
        },
        {
          label               : 'Diastole',
          backgroundColor     : "rgba(181,141,60, 0.1)",
          borderColor         : "rgba(181,141,60, 1)",
          pointBackgroundColor: "rgba(181,141,60, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(181,141,60,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(181,141,60,1)',
          data                : [
              @foreach ( $tekananDarah as $tekananDarahdiastole)
                '{{ $tekananDarahdiastole->diastole }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsTekananDarah = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true,
        position: 'top',
        labels: {
            boxWidth: 80,
            fontColor: 'Black'
        }
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasTekananDarah, {
      type: 'line',
      data: areaChartDataTekananDarah,
      options: areaChartOptionsTekananDarah
    })

    // Chart Data Nutrisi
    var areaChartCanvasNutrisi = $('#chartNutrisi').get(0).getContext('2d')
    var areaChartDataNutrisi = {
      labels  : [
          @foreach ( $nutrisi as $nutrisiwaktu)
            '{{ $nutrisiwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $nutrisi as $nutrisiketerangan)
                '{{ $nutrisiketerangan->keterangan }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsNutrisi = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasNutrisi, {
      type: 'line',
      data: areaChartDataNutrisi,
      options: areaChartOptionsNutrisi
    })

    // Chart Data Cairan
    var areaChartCanvasCairan = $('#chartCairan').get(0).getContext('2d')
    var areaChartDataCairan = {
      labels  : [
          @foreach ( $cairan as $cairanwaktu)
            '{{ $cairanwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $cairan as $cairanketerangan)
                '{{ $cairanketerangan->keterangan }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsCairan = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasCairan, {
      type: 'line',
      data: areaChartDataCairan,
      options: areaChartOptionsCairan
    })

    // Chart Data GDS
    var areaChartCanvasGDS = $('#chartGDS').get(0).getContext('2d')
    var areaChartDataGDS = {
      labels  : [
          @foreach ( $gds as $gdswaktu)
            '{{ $gdswaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $gds as $gdshasil)
                '{{ $gdshasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsGDS = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasGDS, {
      type: 'line',
      data: areaChartDataGDS,
      options: areaChartOptionsGDS
    })

    // Chart Data Asam Urat
    var areaChartCanvasAsamUrat = $('#chartAsamUrat').get(0).getContext('2d')
    var areaChartDataAsamUrat = {
      labels  : [
          @foreach ( $asamUrat as $asamUratwaktu)
            '{{ $asamUratwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $asamUrat as $asamUrathasil)
                '{{ $asamUrathasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsAsamUrat = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasAsamUrat, {
      type: 'line',
      data: areaChartDataAsamUrat,
      options: areaChartOptionsAsamUrat
    })

    // Chart Data Kolesterol
    var areaChartCanvasKolesterol = $('#chartKolesterol').get(0).getContext('2d')
    var areaChartDataKolesterol = {
      labels  : [
          @foreach ( $kolesterol as $kolesterolwaktu)
            '{{ $kolesterolwaktu->waktu }}',
          @endforeach
      ],
      datasets: [
        {
          label               : '',
          backgroundColor     : "rgba(60,141,181, 0.1)",
          borderColor         : "rgba(60,141,181, 1)",
          pointBackgroundColor: "rgba(60,141,181, 1)",
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
              @foreach ( $kolesterol as $kolesterolhasil)
                '{{ $kolesterolhasil->hasil }}',
              @endforeach
          ]
        },
      ]
    }
    var areaChartOptionsKolesterol = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            display : false,
          }
        }],
        xAxes: [{
        //   ticks: {
        //     fontColor: "rgba(60,141,181, 1)",
        //   },
          gridLines : {
            color: "rgba(60,141,181, .2)",
            borderDash: [5, 5],
            zeroLineColor: "rgba(60,141,181, .2)",
            zeroLineBorderDash: [5, 5]
          }
        }]
      }
    }
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvasKolesterol, {
      type: 'line',
      data: areaChartDataKolesterol,
      options: areaChartOptionsKolesterol
    })
</script>