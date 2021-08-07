<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#pj').select2({
            placeholder: '---Pilih Penanggung Jawab---',
            width: '100%',

            minimumInputLength: 3,
            "language": {
                searching: function() {
                    return "Sedang Mencari...";
                },
            }
        });
    });

</script>

<x-guest-layout>
    <x-auth-card>
        <!-- Card Title -->
        <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800 mb-6">
            Register New Client
        </h2>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.storePenghuni') }}" enctype="multipart/form-data">
            @csrf

            <!-- pj Input -->
            <x-label for="pj" :value="__('Penanggung Jawab')"/>
            <x-option-select name="pj" id="pj">
                <x-slot name="option">
                    {{-- <option>---Pilih Penanggung Jawab---</option> --}}
                    @foreach ($pj as $pj)
                        <option value="{{ $pj->id }}">{{ $pj->nama }}</option>
                    @endforeach
                </x-slot>
            </x-option-select>

            <!-- Foto Penghuni -->
            <div class="form-group">
                <x-label class="mt-4" for="image" :value="__('Foto Penghuni')" />
                <x-input id="image" type="file" name="image" :value="old('image')" onchange="previewFile(this)" />
                <img id="previewImg" alt="profile image" style="max-width: 130px; margin-top: 20px;">
            </div>
            {{-- <x-input id="image" type="file" name="image" :value="old('image')" autofocus /> --}}

            <!-- Nama Lengkap Input -->
            <x-label class="mt-4" for="namalengkap" :value="__('nama Lengkap')" />
            <x-input id="namalengkap" type="text" name="namalengkap" :value="old('namalengkap')" placeholder="Nama Lengkap" autocomplete="off" />

            <!-- Name Panggilan-->
            <div class="my-6">
                <x-label for="namepgl" :value="__('Nama Panggilan')" />

                <x-input id="namepgl" type="text" name="namepgl" :value="old('namepgl')" placeholder="Nama Panggilan" required autofocus />
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-6">
                <x-label for="tgllahir" :value="__('Tanggal Lahir')" />

                <x-input id="tgllahir" type="date" name="tgllahir" :value="old('tgllahir')" placeholder="Tanggal Lahir" required />
            </div>

            <!-- Gender -->
            <x-label class="mt-4" for="gender" :value="__('Gender')"/>
            <x-label for="gender" class="py-4">
                    <input type="radio" name="gender" id="gender" class="form-radio h-5 w-5 text-gray-600" value="L"><span class="ml-2 text-gray-700">L</span>
                    <input type="radio" name="gender" id="gender" class="form-radio h-5 w-5 text-gray-600" value="P"><span class="ml-2 text-gray-700">P</span>
            </x-label>

            <!-- Agama -->
            <div class="mb-6">
                <x-label for="agama" :value="__('Agama')" />

                <x-input id="agama" type="text" name="agama" placeholder="Agama" />

            </div>


            <!-- Alamat -->
            <div class="mb-10">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" type="text" placeholder="Alamat" name="alamat" required />
            </div>

            <!-- no telp -->
            <div class="mb-10">
                <x-label for="notelp" :value="__('No Telpon')" />

                <x-input id="notelp" type="text" placeholder="No Telepon" name="notelp" required />
            </div>


            <!-- asal -->
            <div class="mb-10">
                <x-label for="asal" :value="__('Asal Daerah')" />

                <x-input id="asal" type="text" placeholder="Asal Daerah" name="asal" required />
            </div>

            <!-- ruang -->
            <div class="mb-10">
                <x-label for="ruang" :value="__('Ruang')" />

                <x-input id="ruang" type="text" placeholder="Ruang" name="ruang" required />
            </div>

            <!-- tgl masuk -->
            <div class="mb-10">
                <x-label for="tglmasuk" :value="__('Tanggal Masuk')" />

                <x-input id="tglmasuk" type="date" placeholder="tglmasuk" name="tglmasuk" required />
            </div>



            <!-- Button Input -->
            <x-button class="mb-6">
                {{ __('Input') }}
            </x-button>
            <p class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500">
                <a href="{{ route('user.dashboard') }}" class="font-semibold text-indigo-500 hover:text-indigo-500no-underline hover:underline cursor-pointer transition ease-in duration-300">Cancel</a>
            </p>
            </div>
        </form>
        
    </x-auth-card>
</x-guest-layout>

<script type="text/javascript">
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>