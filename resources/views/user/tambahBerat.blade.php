<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#penghuni').select2({
            placeholder: '---Pilih Penghuni---',
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
            Input Berat Badan
        </h2>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.storeBerat') }}">
            @csrf

            <!-- Penghuni Input -->
            <x-label for="penghuni" :value="__('Penghuni')"/>
            <x-option-select name="penghuni" id="penghuni">
                <x-slot name="option">
                    {{-- <option>---Pilih Penghuni---</option> --}}
                    @foreach ($penghuni as $penghuni)
                        <option value="{{ $penghuni->id }}">{{ $penghuni->namaLengkap }}</option>
                    @endforeach
                </x-slot>
            </x-option-select>

            <!-- Hasil Input -->
            <x-label class="mt-4" for="hasil" :value="__('Hasil')" />
            <x-input id="hasil" type="number" name="hasil" :value="old('hasil')" placeholder="Hasil" autocomplete="off" step="0.01"/>

            <!-- Button Input -->
            <x-button class="mb-6">
                {{ __('Input') }}
            </x-button>

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>