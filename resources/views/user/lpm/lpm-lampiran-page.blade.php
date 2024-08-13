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
        * {Q
            /* outline: 1px solid blue; */
        }
    </style>
</head>

<body class="font-sans">
    {{-- header --}}
    <div class="h-20 flex justify-between" style="background: rgb(255, 193, 7);">
        <img src="https://utpas.ac.id/images/logo.svg" alt="logo-utpas" class="h-16 ml-2 mt-2 mb2">
        <div class="relative flex gap-2 mr-2 items-center">
            <p class="text-right text-middle font-medium font-sans">Hai, {{ auth()->user()->name }}</p>
            <button type="button" id="dropdownButton" class="p-2 rounded hover:bg-gray-200 focus:outline-none">
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
    <div class="text-center mx-auto w-4/12 mb-4 mt-16" style="background:rgb(102, 16, 242);">
        <h1 class="text-white">RENCANA TINDAK LANJUT<br>AUDIT MUTU INTERNAL<br>PROGRAM STUDI {{ strtoupper($ami->prodi) }}</h1>
    </div>
    <div class="w-10/12 px-2 mx-auto pb-16">
        <table class="w-full">
            <thead style="background:rgb(255, 193, 7);">
                <tr>
                    <th class="border border-black w-3/12">Temuan</th>
                    <th class="border border-black w-6/12">*Rencana Tindakan Perbaikan (RTP)</th>
                    <th class="border border-black w-3/12" colspan="2">Penanggung<br>Jawab</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <form action="{{ route('rtp.ami.store', $ami) }}" method="POST" id="form_lpm">
                @csrf
                @foreach ($data_standar as $standar)
                <tr>
                    <td colspan="4" class="border border-black text-center font-bold h-10">
                        {{ $standar->nama }}
                    </td>
                </tr>
                @foreach($standar->rtp as $rtp)
                <tr data-standard-index="{{ $loop->iteration }}">
                    <td class="border border-black">
                        {{-- <input type="hidden" value="{{ $rtp['id'] }}" name="rtp[{{ $standar->id }}][id]"> --}}
                        <input type="text" value="{{ $rtp['temuan'] }}" name="rtp[{{ $rtp->id }}][temuan]" id="temuan-1-0" class="w-full border border-transparent" placeholder="Masukkan Temuan...">
                    </td>
                    <td class="border border-black">
                        <input type="text" value="{{ $rtp['rtp'] }}" name="rtp[{{ $rtp->id }}][rtp]" id="butir-rtp-1-0" class="w-full border border-transparent" placeholder="Masukkan butir RTP...">
                    </td>
                    <td class="border border-black">
                        <input type="text" value="{{ $rtp['penanggungjawab'] }}" name="rtp[{{ $rtp->id }}][penanggungjawab]" id="penanggungjawab-1-0" class="w-full border border-transparent" placeholder="Masukkan penanggungjawab...">
                    </td>
                    <td class="text-center border border-black">
                        <button type="button" onclick="removeRow(this, 1)"><span class="material-icons align-middle">remove</span></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-black text-center">
                        <button type="button" onclick="addRow(1)"><span class="material-icons align-middle">add</span></button>
                    </td>
                </tr>
                @endforeach
                @if($standar->rtp->empty())
                <tr data-standard-index="1">
                    <td class="border border-black">
                        <input type="hidden" name="rtp_baru[{{ $loop->index }}][id_standar]" value="{{ $standar['id'] }}">
                        <input type="text" name="rtp_baru[{{ $loop->index }}][temuan]" id="temuan-1-0" class="w-full border border-transparent" placeholder="Masukkan Temuan...">
                    </td>
                    <td class="border border-black">
                        <input type="text" name="rtp_baru[{{ $loop->index }}][rtp]" id="butir-rtp-1-0" class="w-full border border-transparent" placeholder="Masukkan butir RTP...">
                    </td>
                    <td class="border border-black">
                        <input type="text" name="rtp_baru[{{ $loop->index }}][penanggungjawab]" id="penanggungjawab-1-0" class="w-full border border-transparent" placeholder="Masukkan penanggungjawab...">
                    </td>
                    <td class="text-center border border-black">
                        <button type="button" onclick="removeRow(this, 1)"><span class="material-icons align-middle">remove</span></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="border border-black text-center">
                        <button type="button" onclick="addRow(1)"><span class="material-icons align-middle">add</span></button>
                    </td>
                </tr>
                @endif
                @endforeach
                </form>
            </tbody>
        </table>

        <table class="mt-4 w-full">
            <thead>
                <tr>
                    <th class="text-center border border-black" style="background:rgb(255, 193, 7);" colspan="2">
                        Lampiran Laporan AMI
                    </th>
                </tr>
            </thead>
            <tbody id="lampiran-body">
                <tr>
                    <td class="text-center border border-black">
                        1
                    </td>
                    <td class="border border-black">
                        <input form="form_lpm" name="link" value="{{ $ami->lampiran?->link }}" class="border border-transparent w-full" type="text" placeholder="Masukkan link gambar...">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-4 text-center">
            <button type="submit" form="form_lpm" class="bg-blue-500 rounded-md px-2">
                Simpan
            </button>

        </div>
    </div>

    <script>
        let rowCount = [1, 1]; // To keep track of the number of rows for each standard

        function addRow(standardIndex) {
            const tableBody = document.getElementById('table-body');
            const rows = tableBody.querySelectorAll(`tr[data-standard-index="${standardIndex}"]`);
            const lastRow = rows[rows.length - 1];
            const currentIndex = rowCount[standardIndex];

            const newRow = document.createElement('tr');
            newRow.setAttribute('data-standard-index', standardIndex);
            newRow.innerHTML = `
                <td class="border border-black">
                    <input type="text" name="temuan-${standardIndex}-${currentIndex}" id="temuan-${standardIndex}-${currentIndex}" class="w-full border border-transparent" placeholder="Masukkan Temuan...">
                </td>
                <td class="border border-black">
                    <input type="text" name="butir-rtp-${standardIndex}-${currentIndex}" id="butir-rtp-${standardIndex}-${currentIndex}" class="w-full border border-transparent" placeholder="Masukkan butir RTP...">
                </td>
                <td class="border border-black">
                    <input type="text" name="penanggungjawab-${standardIndex}-${currentIndex}" id="penanggungjawab-${standardIndex}-${currentIndex}" class="w-full border border-transparent" placeholder="Masukkan penanggungjawab...">
                </td>
                <td class="text-center border border-black">
                    <button type="button" onclick="removeRow(this, ${standardIndex})"><span class="material-icons align-middle">remove</span></button>
                </td>
            `;

            tableBody.insertBefore(newRow, lastRow);
            rowCount[standardIndex]++;
        }

        function removeRow(button, standardIndex) {
            const row = button.parentElement.parentElement;
            const tableBody = document.getElementById('table-body');
            const rows = tableBody.querySelectorAll(`tr[data-standard-index="${standardIndex}"]`);

            if (rows.length <= 1) {
                alert("Tidak bisa menghapus baris ini. Setidaknya harus ada satu baris tersisa.");
                return;
            }

            if (row === rows[rows.length - 1]) {
                if (rows.length === 2) {
                    if (confirm("Apakah Anda yakin ingin menghapus baris ini?")) {
                        row.parentElement.removeChild(row);
                    }
                } else {
                    alert("Tidak bisa menghapus baris ini. Baris terakhir tidak bisa dihapus.");
                }
            } else {
                if (confirm("Apakah Anda yakin ingin menghapus baris ini?")) {
                    row.parentElement.removeChild(row);
                }
            }
        }

        // Fungsi untuk memperbarui nomor urut
        function updateRowNumbers() {
            const rows = document.querySelectorAll('#lampiran-body tr');
            rows.forEach((row, index) => {
                if (index < rows.length - 1) { // Jangan ubah nomor baris untuk tombol tambah
                    row.cells[0].textContent = index + 1;
                }
            });
        }

        // Inisialisasi dengan menambahkan event listener ke tombol tambah
        // document.querySelector('#lampiran-body button').addEventListener('click', addRowToLampiran);
    </script>
</body>
