<x-guest-layout>
    <x-auth-card>
        <!-- Card Title -->
        <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800 my-6">
            Register Penanggung Jawab
        </h2>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.storePJ') }}">
            @csrf


            <!-- Nama Input -->
            <x-label class="mt-4" for="nama" :value="__('Nama')" />
            <x-input id="nama" type="text" name="nama" :value="old('nama')" placeholder="Nama" autofocus autocomplete="off" />

            <!-- Alamat-->
            <div class="my-6">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" type="text" name="alamat" :value="old('alamat')" placeholder="Alamat" required />
            </div>

            <!-- Telepon -->
            <div class="mb-6">
                <x-label for="telpon" :value="__('Nomor Telepon')" />

                <x-input id="telpon" type="text" name="telpon" :value="old('telpon')" placeholder="Telepon" required />
            </div>


            <!-- Button Input -->
            <x-button class="mb-6">
                {{ __('Next') }}
            </x-button>
            <p class="flex flex-col items-center justify-center mt-6 text-center text-lg text-gray-500">
                <span>Sudah Punya Penanggung Jawab?</span>
                <a href="{{ route('user.tambahPenghuni') }}" class="font-semibold text-indigo-500 hover:text-indigo-500no-underline hover:underline cursor-pointer transition ease-in duration-300">Lewati</a>
            </p>

            </div>
        </form>
        
    </x-auth-card>
</x-guest-layout>