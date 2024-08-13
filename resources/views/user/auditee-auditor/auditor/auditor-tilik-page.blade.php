<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTPAS › Siami</title>
    <link rel="shortcut icon" href="https://utpas.ac.id/images/favicon.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        * {
            /* outline: 1px solid blue; */
        }
    </style>
</head>

<body class="font-sans">

    {{-- header --}}
    <div class="h-20 flex justify-between" style="background: rgb(255, 193, 7);">
        <img src="https://utpas.ac.id/images/logo.svg" alt="logo-utpas" class="h-16 ml-2 mt-2 mb2">
        <div class="relative flex gap-2 mr-2 items-center">
            <p class="text-right text-middle font-medium">Hai, LPM</p>
            <button id="dropdownButton" class="p-2 rounded hover:bg-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
            <!-- Dropdown Menu -->
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg">
                <ul class="py-1 text-gray-700">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form action="{{ route('auditor.store.penilaian', $ami) }}" method="POST" id="form_auditor">
    @csrf
    <input type="hidden" name="id_ami" value="{{ $ami->id }}">
    @foreach ($data_tilik as $nama_instrumen => $data_standar)
    <div class="flex items-center justify-center mx-auto mt-16 h-12 w-11/12 bg-yellow-500 text-center text-2xl font-bold">
        Daftar Tilik {{ $nama_instrumen }}
    </div>
    <div class="">
        @foreach ($data_standar as $standar)
        <table class="mx-auto mt-12 w-11/12">
            <thead class="text-center font-bold">
                <tr>
                    <th class="w-5/12 bg-blue-500 border border-black" colspan="3">
                        {{ $standar->nama }}
                    </th>
                </tr>
                <tr>
                    <td class="border border-black">
                        Butir Mutu
                    </td>
                    <td class="border border-black">
                        Nilai
                    </td>
                    <td class="border border-black">
                        Keterangan
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($standar->tilik as $tilik)
                <tr class="">
                    <td class="border border-black">{{ $tilik['pertanyaan'] }}</td>
                    <td class="border border-black w-2/12 px-2">
                        <select name="nilai[{{ $tilik['id'] }}][angka]" class="verificationSelect w-full rounded-md">
                            <option value="" hidden>{{ $tilik->penilaian->first()['angka'] ?? 'Pilih'}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                    <td class="border border-black w-5/12"><input value="{{$tilik->penilaian->first()['catatan'] ?? ''}}" name="nilai[{{ $tilik['id'] }}][catatan]" type="text" class="w-full" placeholder="Isi dengan keterangan"> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    @endforeach
    <div class="text-center">
        <button class="bg-blue-500 px-2 rounded-md mt-24 text-white" type="submit" form="form_auditor">Simpan</button>
    </div>
    </form>
    
    <div class="flex justify-center mt-4 gap-12">
        <button type="button" class="border border-black bg-blue-500 rounded-md w-32" onclick="location.href='{{ route('auditor.verdok.view', $ami) }}'">
            Kembali
        </button>
        <button type="button" class="border border-black bg-blue-500 rounded-md w-32" onclick="location.href='location.href='{{ route('auditor.temuan.view', $ami) }}'">
            Daftar Temuan
        </button>
    </div>
        {{-- <div class="flex items-center justify-center mx-auto mt-16 h-12 w-11/12 bg-yellow-500 text-center text-2xl font-bold">
            Daftar Tilik Penelitian
        </div> --}}

        {{-- <div class="">
            <table class="mx-auto mt-12 w-11/12">
                <thead class="text-center font-bold">
                    <tr>
                        <th class="w-5/12 bg-blue-500 border border-black" colspan="3">
                            Standar Kompetensi Lulusan
                        </th>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Butir Mutu
                        </td>
                        <td class="border border-black">
                            Nilai
                        </td>
                        <td class="border border-black">
                            Keterangan
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td class="border border-black">Tersedianya profil lulusan</td>
                        <td class="border border-black w-2/12 px-2">
                            <select name="" class="verificationSelect w-full rounded-md">
                                <option value="" hidden>Pilih</option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                            </select>
                        </td>
                        <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                    </tr>
                    <tr class="">
                        <td class="border border-black">a</td>
                        <td class="border border-black w-2/12 px-2">
                            <select name="" class="verificationSelect w-full rounded-md">
                                <option value="" hidden>Pilih</option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                            </select>
                        </td>
                        <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                    </tr>
                    <tr class="">
                        <td class="border border-black">a</td>
                        <td class="border border-black w-2/12 px-2">
                            <select name="" class="verificationSelect w-full rounded-md">
                                <option value="" hidden>Pilih</option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                            </select>
                        </td>
                        <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                    </tr>
                </tbody>
            </table>
            <div class="flex items-center justify-center mx-auto mt-16 h-12 w-11/12 bg-yellow-500 text-center text-2xl font-bold">
                Daftar Tilik Pengabdian Kepada Masyarakat
            </div>

            <div class="">
                <table class="mx-auto mt-12 w-11/12">
                    <thead class="text-center font-bold">
                        <tr>
                            <th class="w-5/12 bg-blue-500 border border-black" colspan="3">
                                Standar Kompetensi Lulusan
                            </th>
                        </tr>
                        <tr>
                            <td class="border border-black">
                                Butir Mutu
                            </td>
                            <td class="border border-black">
                                Nilai
                            </td>
                            <td class="border border-black">
                                Keterangan
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="border border-black">Tersedianya profil lulusan</td>
                            <td class="border border-black w-2/12 px-2">
                                <select name="" class="verificationSelect w-full rounded-md">
                                    <option value="" hidden>Pilih</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </td>
                            <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                        </tr>
                        <tr class="">
                            <td class="border border-black">a</td>
                            <td class="border border-black w-2/12 px-2">
                                <select name="" class="verificationSelect w-full rounded-md">
                                    <option value="" hidden>Pilih</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </td>
                            <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                        </tr>
                        <tr class="">
                            <td class="border border-black">a</td>
                            <td class="border border-black w-2/12 px-2">
                                <select name="" class="verificationSelect w-full rounded-md">
                                    <option value="" hidden>Pilih</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </td>
                            <td class="border border-black w-5/12"><input type="text" class="w-full" placeholder="Isi dengan keterangan"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center mt-4 gap-12">
                <button class="border border-black bg-blue-500 rounded-md w-32" onclick="location.href='/auditor-verdok-page'">
                    Kembali
                </button>
                <button class="border border-black bg-blue-500 rounded-md w-32" onclick="location.href='/auditor-temuan-page'">
                    Daftar Temuan
                </button>
            </div>
        </div> --}}

        <script>
            document.querySelectorAll('.verificationSelect').forEach(function(selectElement) {
                selectElement.addEventListener('change', function() {
                    const selectedValue = this.value;

                    if (selectedValue === 'ya') {
                        this.classList.remove('bg-red-500', 'bg-white');
                        this.classList.add('bg-green-500');
                    } else if (selectedValue === 'tidak') {
                        this.classList.remove('bg-green-500', 'bg-white');
                        this.classList.add('bg-red-500');
                    } else {
                        this.classList.remove('bg-green-500', 'bg-red-500');
                        this.classList.add('bg-white');
                    }
                });
            });
            document.getElementById('dropdownButton').addEventListener('click', function() {
                const dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', function(event) {
                const dropdownButton = document.getElementById('dropdownButton');
                const dropdownMenu = document.getElementById('dropdownMenu');

                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        </script>
</body>


</html>
