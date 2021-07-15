<x-guest-layout>
    <x-auth-card>
        <!-- Card Title -->
        <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800 mb-6">
            Edit Client
        </h2>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.updatePenghuni') }}">
            @csrf

            <x-input type="hidden" name="id" value="{{ $penghuni->id }}"></x-input>
            <!-- pj Input -->
            <x-label for="pjid" :value="__('Penanggung Jawab')"/>
            <x-option-select name="pjid" id="pjid">
                <x-slot name="option">
                    <option value="{{ $penghuni->pjid }}" selected hidden>{{ $penghuni->nama }}</option>
                    @foreach ($pj as $pj)
                        <option value="{{ $pj->id }}">{{ $pj->nama }}</option>
                    @endforeach
                </x-slot>
            </x-option-select>

            <!-- Nama Lengkap Input -->
            <x-label class="mt-4" for="namalengkap" :value="__('nama Lengkap')" />
            <x-input id="namalengkap" type="text" name="namalengkap" value="{{ $penghuni->namaLengkap }}" placeholder="Nama Lengkap" autofocus autocomplete="off" />

            <!-- Name Panggilan-->
            <div class="mb-6">
                <x-label for="namepgl" :value="__('Nama Panggilan')" />

                <x-input id="namepgl" type="text" name="namepgl" value="{{ $penghuni->namaPanggilan }}" placeholder="Nama Panggilan" required autofocus />
            </div>

            <!-- Foto -->
            <!-- <div class="mb-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" name="image" placeholder="Choose image" id="image">
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>


            </div> -->

            <!-- Tanggal Lahir -->
            <div class="mb-6">
                <x-label for="tgllahir" :value="__('Tanggal Lahir')" />

                <x-input id="tgllahir" type="date" name="tgllahir" value="{{ $penghuni->tgllahir }}" placeholder="Tanggal Lahir" required />
            </div>

            <!-- Gender -->
            <x-label class="mt-4" for="gender" :value="__('Gender')"/>
            <x-label for="gender" class="py-4">
                    <input type="radio" name="gender" id="gender" class="form-radio h-5 w-5 text-gray-600" value="L" {{ $penghuni->gender == 'L' ? 'checked' : '' }}><span class="ml-2 text-gray-700">L</span>
                    <input type="radio" name="gender" id="gender" class="form-radio h-5 w-5 text-gray-600" value="P" {{ $penghuni->gender == 'P' ? 'checked' : '' }}><span class="ml-2 text-gray-700">P</span>
            </x-label>

            <!-- Agama -->
            <div class="mb-6">
                <x-label for="agama" :value="__('Agama')" />

                <x-input id="agama" type="text" name="agama" value="{{ $penghuni->agama }}" placeholder="Agama" />

            </div>


            <!-- Alamat -->
            <div class="mb-10">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" type="text" value="{{ $penghuni->alamat }}" placeholder="Alamat" name="alamat" required />
            </div>

            <!-- no telp -->
            <div class="mb-10">
                <x-label for="notelp" :value="__('No Telpon')" />

                <x-input id="notelp" type="text" value="{{ $penghuni->notelp }}" placeholder="No Telepon" name="notelp" required />
            </div>


            <!-- asal -->
            <div class="mb-10">
                <x-label for="asal" :value="__('Asal Daerah')" />

                <x-input id="asal" type="text" value="{{ $penghuni->asalDaerah }}" placeholder="Asal Daerah" name="asal" required />
            </div>

            <!-- ruang -->
            <div class="mb-10">
                <x-label for="ruang" :value="__('Ruang')" />

                <x-input id="ruang" type="text" value="{{ $penghuni->ruang }}" placeholder="Ruang" name="ruang" required />
            </div>

            <!-- tgl masuk -->
            <div class="mb-10">
                <x-label for="tglmasuk" :value="__('Tanggal Masuk')" />

                <x-input id="tglmasuk" type="date" value="{{ $penghuni->tglMasuk }}" placeholder="tglmasuk" name="tglmasuk" required />
            </div>

            <!-- tgl keluar -->
            <div class="mb-10">
                <x-label for="tglkeluar" :value="__('Tanggal Keluar')" />

                <x-input id="tglkeluar" type="date" value="{{ $penghuni->tglKeluar }}" placeholder="tglkeluar" name="tglkeluar" />
            </div>

            <!-- meninggal Input -->
            <x-label class="mt-4" for="meninggal" :value="__('Meninggal')"/>
            <x-label for="meninggal" class="pt-4">
                    <input type="radio" name="meninggal" id="meninggal" class="form-radio h-5 w-5 text-gray-600" value="0" {{ $penghuni->meninggal == 0 ? 'checked' : '' }}><span class="ml-2 text-gray-700">Belum</span>
                    <input type="radio" name="meninggal" id="meninggal" class="form-radio h-5 w-5 text-gray-600" value="1" {{ $penghuni->meninggal == 1 ? 'checked' : '' }}><span class="ml-2 text-gray-700">Sudah</span>
            </x-label>

            <!-- keluar Input -->
            <x-label class="mt-4" for="keluar" :value="__('Keluar')"/>
            <x-label for="keluar" class="pt-4">
                    <input type="radio" name="keluar" id="keluar" class="form-radio h-5 w-5 text-gray-600" value="0" {{ $penghuni->keluar == 0 ? 'checked' : '' }}><span class="ml-2 text-gray-700">Belum</span>
                    <input type="radio" name="keluar" id="keluar" class="form-radio h-5 w-5 text-gray-600" value="1" {{ $penghuni->keluar == 1 ? 'checked' : '' }}><span class="ml-2 text-gray-700">Sudah</span>
            </x-label>



            <!-- Button Input -->
            <x-button class="mb-6">
                {{ __('Update') }}
            </x-button>

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>