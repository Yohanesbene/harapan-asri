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
        <h2 class="text-2xl sm:text-4xl font-semibold leading-tight">Daftar Penghuni</h2>
        <a href="{{ route('user.tambahPJ') }}">
            <button class="flex justify-end mb-6 bg-white text-green-500 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block">
                        <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z"
                            fill="currentColor" />
                    </svg>
                    <span class="mr-2">Tambah Penghuni</span>
                </button>
        </a>
        {{-- <a class="text-sm bg-green-500 hover:bg-green-700 text-white py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('user.tambahPJ') }}">{{ __('Tambah Penghuni Baru') }}</a> --}}
    </div>

    <div class="w-full px-4 sm:px-10 lg:px-40">
        <div class="shadow-lg overflow-x-auto rounded border-b border-gray-200 mb-10">
            <!-- Session Status Success -->
                @if ( session('success'))
                <div class="min-w-full px-5 py-4 mb-6 bg-green-100 text-green-800 text-sm rounded-md border border-green-200" role="alert">
                    {{ session('success') }}
                </div>
                @endif

            <!-- Session Status Failed -->
                @if ( session('error'))
                <div class="min-w-full px-5 py-4 mb-6 bg-red-100 text-red-800 text-sm rounded-md border border-red-200" role="alert">
                    {{ session('error') }}
                </div>
                @endif
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr class="text-white uppercase text-base leading-normal">
                        <th class="text-left py-3 px-6 font-semibold">ID</th>
                        <th class="text-left py-3 px-6 font-semibold">Nama Penghuni</th>
                        <th class="text-left py-3 px-6 font-semibold">Nama Penanggung Jawab</th>
                        <th class="text-left py-3 px-6 font-semibold">ruang</th>
                        <th class="text-left py-3 px-6 font-semibold">Actions</th>
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
                        
                        <td class="p-3 px-4 flex">
                            <a href="editPenghuni/{{ $pghn->id }}" class="mr-3 text-sm bg-indigo-100 hover:bg-indigo-300 text-black py-2 px-4 rounded focus:outline-none transition duration-200">Edit</a>
                            <a href="detailPenghuni/{{ $pghn->id }}" class="mr-3 text-sm bg-blue-500 hover:bg-blue-800 text-white py-2 px-4 rounded focus:outline-none transition duration-200">Details</a>
                            <a href="deletePenghuni/{{ $pghn->id }}" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded focus:outline-none transition duration-200">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $penghuni->links('vendor.pagination.tailwind') }}
        <div class="flex justify-end mb-6 ">
            <a href="{{ route('user.printListClient') }}" target="_blank">
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
    {{-- <div class="max-w-full flex justify-end mx-auto px-4 py-6 sm:px-10 lg:px-40">
        <a class="text-sm font-extrabold border-2 border-blue-500 hover:border-blue-700 text-blue-500 hover:text-blue-700 py-3 px-4 rounded focus:outline-none transition duration-200" href="{{ route('user.printListClient') }}" target="_blank">{{ __('Print Data') }}</a>
    </div> --}}
</x-app-layout>
