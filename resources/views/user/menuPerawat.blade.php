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
    <div class="flex bg-gray-100 py-12 px-4">
        <div class="container mx-auto">
             <!-- Session Status Success -->
            @if ( session('success'))
                <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">
                        {{ session('success') }}
                </div>
            @endif

            <!-- Session Status Failed -->
            @if ( session('error'))
                <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                        {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-rows-3 grid-cols-5 gap-5">
                <!-- START: Menu Berat Badan -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Berat Badan</h5>
                    </div>
                    <a href="{{ route('user.berat') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Berat Badan -->
                <!-- START: Menu Nadi -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Nadi</h5>
                    </div>
                    <a href="{{ route('user.nadi') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Nadi -->
                <!-- START: Menu Suhu Badan -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Suhu Badan</h5>
                    </div>
                    <a href="{{ route('user.suhu') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Suhu Badan -->
                <!-- START: Menu SpO2 -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">SpO2</h5>
                    </div>
                    <a href="{{ route('user.spo2') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu SpO2 -->
                <!-- START: Menu Tekanan Darah -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Tekanan Darah</h5>
                    </div>
                    <a href="{{ route('user.tekananDarah') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Tekanan Darah -->
                <!-- START: Menu Cek Obat -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Cek Obat</h5>
                    </div>
                    <a href="{{ route('user.cekObat') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Cek Obat -->
                <!-- START: Menu Pemberian Obat -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Pemberian Obat</h5>
                    </div>
                    <a href="{{ route('user.pemberianObat') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Pemberian Obat -->
                <!-- START: Menu Nutrisi -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Nutrisi</h5>
                    </div>
                    <a href="{{ route('user.nutrisi') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Nutrisi -->
                <!-- START: Menu Cairan -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Cairan</h5>
                    </div>
                    <a href="{{ route('user.cairan') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Cairan -->
                <!-- START: Menu GDS -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">GDS</h5>
                    </div>
                    <a href="{{ route('user.gds') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu GDS -->
                <!-- START: Menu Asam Urat -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Asam Urat</h5>
                    </div>
                    <a href="{{ route('user.asamUrat') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Asam Urat -->
                <!-- START: Menu Kolesterol -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Kolesterol</h5>
                    </div>
                    <a href="{{ route('user.kolesterol') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Kolesterol -->
                <!-- START: Menu Mobilisasi Dini -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Mobilisasi Dini</h5>
                    </div>
                    <a href="{{ route('user.mobilisasi') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Mobilisasi Dini -->
                <!-- START: Menu Peminjaman Alat -->
                <div 
                class="relative col-span-5 row-span-1 md:col-span-1 bg-blue-400 hover:shadow-lg hover:bg-indigo-500 rounded-3xl transition duration-300 shadow-none h-full hover:shadow-lg"
                style="height: 180px">
                    <div class="overlay inset-0 md:bottom-auto flex justify-center md:items-center flex-col pl-24 md:pl-0 pt-16 md:pt-16">
                        <h5 class="text-2xl font-semibold text-white">Peminjaman Alat</h5>
                    </div>
                    <a href="{{ route('user.peminjamanAlat') }}" class="absolute inset-0 z-10 cursor-pointer"></a>
                </div>
                <!-- END: Menu Peminjaman Alat -->
            </div>
        </div>
    </div>
</x-app-layout>
