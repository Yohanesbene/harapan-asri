<x-guest-layout>
    <x-auth-card>
        <!-- Card Title -->
        <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800 mb-6">
            Register New User
        </h2>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.storeUser') }}">
            @csrf

            <!-- role Input -->
            <x-label for="roleid" :value="__('Role')"/>
            <x-option-select name="roleid" id="roleid">
                <x-slot name="option">
                    <option>---Pilih Role---</option>
                    @foreach ($role as $role)
                        <option value="{{ $role->id }}">{{ $role->description }}</option>
                    @endforeach
                </x-slot>
            </x-option-select>

            <!-- Pegawai Input -->
            <x-label class="mt-4" for="pegawaiid" :value="__('Pegawai')"/>
            <x-option-select name="pegawaiid" id="pegawaiid">
                <x-slot name="option">
                    <option>---Pilih Pegawai---</option>
                    @foreach ($pegawai as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                    @endforeach
                </x-slot>
            </x-option-select>

            <!-- Username Input -->
            <x-label class="mt-4" for="username" :value="__('Username')"/>
            <x-input id="username" type="text" name="username" :value="old('username')" placeholder="Username" autofocus autocomplete="off"/>

            <!-- Password Input -->
            <x-label for="password" class="mt-4" 
                    :value="__('Password')"/>
            <x-input id="password" 
                    type="password" 
                    name="password" 
                    :value="old('password')" 
                    placeholder="Password" 
                    autofocus autocomplete="off"/>

            <!-- Password Confirmation Input -->
            <x-label for="password_confirmation" class="mt-4" 
                    :value="__('Password Confirm')"/>
            <x-input id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    :value="old('password_confirmation')" 
                    placeholder="Password" 
                    autofocus autocomplete="off"/>

            <!-- Button Input -->
            <x-button class="mb-6">
                {{ __('Daftar') }}
            </x-button>

            <p class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500">
                <a href="{{ route('admin.dataUser') }}" class="font-semibold text-indigo-500 hover:text-indigo-500no-underline hover:underline cursor-pointer transition ease-in duration-300">Cancel</a>
            </p>

        </form>
    </x-auth-card>
</x-guest-layout>
