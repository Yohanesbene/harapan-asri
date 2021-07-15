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
    <div class="w-full px-4 py-12 mx-2 min-h-screen sm:px-10 lg:px-40">
        <div class="mx-auto py-6">
            <a class="text-sm bg-gray-500 hover:bg-gray-700 text-white py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('user.dashboard') }}">{{ __('Back') }}</a>
        </div>
        <!-- Profile tab -->
        <!-- About Section -->
        <div class="bg-white p-3 shadow-sm rounded-sm">
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
                    @foreach ($penghuni as $pghn)
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-bold">Nama Lengkap</div>
                        <div class="px-4 py-2">{{ $pghn->namaLengkap }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-bold">Nama Panggilan</div>
                        <div class="px-4 py-2">{{ $pghn->namaPanggilan }}</div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="px-4 py-2 font-bold">Penanggung Jawab</div>
                        <div class="px-4 py-2">{{ $pghn->nama }}</div>
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
                        <div class="px-4 py-2 font-bold">Tanggal Keluar</div>
                        <div class="px-4 py-2">{{ $pghn->tglKeluar }}</div>
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
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Data Berat Badan -->
        <div class="w-full container">
            <div class="mt-6 md:flex">
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
                <div class="w-full md:w-1/2 md:ml-4">
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
            </div>
        </div>

    </div>
    
    {{-- {{ $penghuni->links() }} --}}
    {{-- <div class="max-w-full flex justify-end mx-auto px-4 py-6 sm:px-10 lg:px-40">
        <a class="text-sm font-extrabold border-2 border-blue-500 hover:border-blue-700 text-blue-500 hover:text-blue-700 py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('user.print') }}" target="_blank">{{ __('Print Data') }}</a>
    </div> --}}
</x-app-layout>

<script>
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

</script>
