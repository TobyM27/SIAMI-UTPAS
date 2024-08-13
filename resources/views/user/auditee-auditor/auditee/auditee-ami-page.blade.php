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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

    <div class="flex">
        <div class="w-44 h-100% bg-gray-800 text-white flex flex-col" style="background:rgb(102, 16, 242);">
            <div class="p-4 text-lg font-semibold">
                Siami Utpas
            </div>
            <ul class="flex-1">
                <li class="p-4 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="location.href='/dashboard-audit-page'">
                        <span class="material-icons">home</span>
                        <span class="ml-3">Home</span>
                    </a>
                </li>
                <li class="p-4 hover:bg-gray-700">
                    <a href="#" class="flex items-center" onclick="location.href='{{ route('laporan.pengesahan.view', $ami) }}'">
                        <span class="material-icons">draw</span>
                        <span class="ml-3">Pengesahan Laporan</span>
                    </a>
                </li>
            </ul>
            <div class="p-4 border-t border-gray-700">
                <a href="#" class="flex items-center">
                    <span class="material-icons">logout</span>
                    <span class="ml-3">Logout</span>
                </a>
            </div>
        </div>
        <div class="w-full mt-24 px-4">
            {{-- Nama Siklus --}}
            <div class="text-center text-white font-bold w-4/12 rounded-md mb-8 mx-auto" style="background:rgb(102, 16, 242);">
                <h1>Audit Mutu Internal<br>Program {{ $ami->prodi }}<br>Siklus {{ $ami->siklus }} ({{ \Carbon\Carbon::parse($ami->tanggal_ami)->format('Y') }})</h1>
            </div>

            {{-- Tabel Upload Dokumen --}}
            <div class="w-full">
                <table class="ml- text-center w-full">
                    <thead class="bg-yellow-400 sticky top-0">
                        <tr class="text-center">
                            <th class="border border-black">Daftar Pertanyaan</th>
                            <th class="border border-black">Status Verifikasi</th>
                            <th class="border border-black">Link</th>
                            <th class="border border-black">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('auditee.dokumen.store') }}" method="POST" id="form_auditee">
                            @csrf
                            <input type="hidden" name="id_ami" value="{{ $ami->id }}">
                            @foreach ($data_pertanyaan as $nama_standar => $standar_pertanyaan)
                            <tr>
                                <td colspan="4" class="border border-black font-bold">
                                    {{ $nama_standar }} 
                                </td>
                            </tr>
                            
                                @foreach ($standar_pertanyaan as $pertanyaan)
                                    <tr>
                                        <td class="border border-black">{{ $pertanyaan['daftar_pertanyaan'] }}</td>
                                        <td class="px-2 border border-black">
                                            @php
                                                $status_verifikasi = '';
                                                $warna_status = 'bg-yellow-500';
                                                $null = null;
                                                switch ($dokumen->where('id_soalstandar',$pertanyaan['id'])->first()?->status_verifikasi) {
                                                    case 1:
                                                        $status_verifikasi = "terverifikasi";
                                                        $warna_status = 'bg-green-500';
                                                        break;

                                                    case is_null($null):
                                                        $status_verifikasi = "tidak terverifikasi";
                                                        $warna_status = 'bg-red-500';
                                                        break;
                                                    case 0:
                                                        $status_verifikasi = "belum diupload / diverifikasi";
                                                        break;
                                                }
                                            @endphp
                                            <Span  class="border border-black inline-block w-full rounded-md {{ $warna_status }}">
                                                {{ $status_verifikasi }} 
                                            </Span>
                                        </td>
                                        <td class="border border-black"><input value="{{ $ami->dokumen->where('id_soalstandar',$pertanyaan['id'])->first()?->link ?? ''}}" name="link_dokumen[{{ $pertanyaan['id'] }}]" class="w-full h-1 border border-none" placeholder="Masukkan link dokumen di sini..."></td>
                                        <td class="border border-black">{{ $dokumen->where('id_soalstandar', $pertanyaan['id'])->first()?->komentar_verifikasi ?? ''}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>

            {{-- tabel kanan --}}
            <div class="text-center mt-12">
                <button class="border border-black bg-blue-500 px-2 rounded-md" type="submit" form="form_auditee">
                    Kirim 
                </button>
            </div>
        </div>
    </div>
    <script>
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
