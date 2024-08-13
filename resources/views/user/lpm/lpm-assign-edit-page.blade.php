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

    <form action="{{ route('lpm.ami.store', $ami) }}" method="POST" id="update_ami">
        @csrf
        {{-- <input type="hidden" name="id_ami" value="{{ $ami->id }}"> --}}
        <div class="flex justify-between mt-16 px-4 gap-2">
            {{-- tabel assign auditor --}}
            <div class="w-1/3">
                <table class="w-full border border-black">
                    <thead class="bg-red-500 h-14">
                        <tr>
                            <th class="border border-black text-white font-bold">Penugasan Auditor<br>Prodi {{ $prodi }}</th> 
                        </tr>
                    </thead>
                    <tbody>
                            {{-- <input type="hidden" name="prodi" value="{{ $prodi }}" readonly> --}}
                            <tr>
                                <td>
                                    <label for="tanggal-mulai" class="font-bold">Tanggal Mulai Upload</label>
                                    <input value="{{ $ami->tanggal_mulai->format('Y-m-d') }}" name="tanggal_mulai" id="tanggal_mulai" type="date" class="w-full mb-4">
                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <label for="tanggal-mulai" class="font-bold">Tanggal Pelaksanaan AMI</label>
                                    <input value="{{ $ami->tanggal_ami->format('Y-m-d') }}" name="tanggal_ami" id="tanggal_ami" type="date" class="w-full mb-4">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-selesai" class="font-bold">Tanggal Selesai</label>
                                    <input value="{{ $ami->tanggal_akhir->format('Y-m-d') }}" name="tanggal_akhir" id="tanggal_akhir" type="date" class="w-full mb-4">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-selesai" class="font-bold">Nama Rektor</label>
                                    <input value="{{ $ami->nama_rektor_utpas }}" name="nama_rektor_utpas" type="text" class="w-full mb-4" placeholder="Masukkan nama rektor, beserta gelar">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-selesai" class="font-bold">Nama Wakil Rektor</label>
                                    <input value="{{ $ami->nama_warek_utpas }}" name="nama_warek_utpas" type="text" class="w-full mb-4" placeholder="Masukkan nama wakil rektor, beserta gelar">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-selesai" class="font-bold">Nama Ketua LPM</label>
                                    <input value="{{ $ami->nama_spmi }}" name="nama_spmi" type="text" class="w-full mb-4" placeholder="Masukkan nama ketua LPM, beserta gelar">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-mulai" class="font-bold">Auditee</label>
                                    <select name="auditee" id="auditee" class="w-full mb-4">
                                        <option value="" hidden> {{ $user[$ami->id_user_auditee - 1]->name }} </option>
                                        @foreach ($data_ami as $user_data)
                                            <option value="{{ $user_data['id']}}">{{ $user_data['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-mulai" class="font-bold">Ketua Auditor</label>
                                    <select name="ketua_auditor" id="ketua_auditor" class="w-full mb-4">
                                        <option value="" hidden> {{ $user[$ami->id_user_auditor1 -1]->name }} </option>
                                        @foreach ($data_ami as $user_data)
                                            <option value="{{ $user_data['id']}}">{{ $user_data['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tanggal-mulai" class="font-bold">Anggota Auditor</label>
                                    <select name="anggota_auditor" id="anggota_auditor" class="w-full mb-4">
                                        <option value="" hidden>{{ $user[$ami->id_user_auditor2 - 1]->name }}</option>
                                        @foreach ($data_ami as $user_data)
                                            <option value="{{ $user_data['id']}}">{{ $user_data['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="SK-Auditor" class="font-bold">SK Auditor</label>
                                    <input value="{{ $ami->link_file }}" name="link_file" type="url" class="w-full" >
                                </td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>

            {{-- tabel standar --}}
            <div class="w-1/3">
                <table class="w-full">
                    <thead class="bg-yellow-400 text-sm h-14">
                        <tr class="text-black">
                            <th class="border border-black w-11/12">Standar Untuk Diaudit</th>
                            <th class="border border-black w-1/12 px-2">Ya/Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($standar as $std)
                        <tr>
                            <td class="pl-2 border border-black">{{ $std['nama'] }}</td>
                            @if (in_array($std['id'], $ami_standars))
                                <td class="text-center border border-black"><input name="standar[]" value="{{ $std['id'] }}" checked type="checkbox"></td>
                             @else 
                                <td class="text-center border border-black"><input name="standar[]" value="{{ $std['id'] }}" type="checkbox"></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-full mt-8 px-4">
            <table class="mx-auto w-full" id="dynamicTable">
                <thead class="bg-green-500 h-14">
                    <tr>
                        <th colspan="6" class="border border-black">
                            Anggaran Biaya AMI
                        </th>
                    </tr>
                    <tr class="text-sm">
                        <th class="border border-black w-1/12">No</th>
                        <th class="border border-black w-3/12">Nama Item</th>
                        <th class="border border-black w-2/12">Harga satuan</th>
                        <th class="border border-black w-1/12">Jumlah item</th>
                        <th class="border border-black w-2/12">Subtotal</th>
                        <th class="border border-black w-2/12">Hapus baris</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rancangan_anggaran as $anggaran)
                    <tr id="totalRow">
                        
                        <td class="border border-black text-center"> {{ $loop->iteration }}</td>
                        <td class="border border-black">
                            <input value="{{ $anggaran['nama_item'] }}" name="rancangan_anggaran[{{ $loop->iteration }}][nama_item]" type="text" class="border border-transparent w-full" placeholder="Masukkan nama item...">
                        </td>
                        <td class="border border-black">
                            <input value="{{ $anggaran['harga_satuan'] }}" name="rancangan_anggaran[{{ $loop->iteration }}][harga_satuan]" type="number" min="1" class="number-input border border-transparent w-full" placeholder="Masukkan harga satuan..." oninput="calculateSubtotal(this)">
                        </td>
                        <td class="border border-black">
                            <input value="{{ $anggaran['jumlah_item'] }}" name="rancangan_anggaran[{{ $loop->iteration }}][jumlah_item]" type="number" min="1" class="number-input border border-transparent w-full" placeholder="0" oninput="calculateSubtotal(this)">
                        </td>
                        <td class="border border-black text-center">
                            <span class="subtotal-display"> {{ $anggaran['subtotal'] }}</span>
                            <input type="hidden" class="subtotal-input" name="rancangan_anggaran[{{ $loop->iteration }}][subtotal]">
                        </td>
                        <td class="border border-black text-center">
                            <button onclick="deleteRow(this)" class="border border-black rounded-md px-2 hover:underline hover:text-red-500">Delete</button>
                        </td>
                        
                        
                    </tr>
                    @endforeach
                    <th class="border border-black text-sm" colspan="4">Total keseluruhan</th>
                        <th class="border border-black text-sm text-center" colspan="2" id="totalKeseluruhan"></th>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <button type="button" class="border border-black px-2 rounded-md" onclick="addRow()">Tambah baris</button>
            </div>
        </div>
    </form>

    <div class="text-center">
        <button class="bg-blue-500 px-2 rounded-md mt-24 text-white" type="submit" form="update_ami">Simpan</button>
    </div>
    <script>
        function addRow() {
            const table = document.getElementById("dynamicTable").getElementsByTagName('tbody')[0];
            const rowIndex = table.rows.length - 1;
            const newRow = table.insertRow(rowIndex); // Insert row above total row
            newRow.innerHTML = `
                <td class="border border-black text-center"></td>
                <td class="border border-black">
                    <input name="rancangan_anggaran[`+rowIndex+`][nama_item]" type="text" class="border border-transparent w-full" placeholder="Masukkan nama item...">
                </td>
                <td class="border border-black">
                    <input name="rancangan_anggaran[`+rowIndex+`][harga_satuan]" type="number" min="1" class="number-input border border-transparent w-full" placeholder="Masukkan harga satuan..." oninput="calculateSubtotal(this)">
                </td>
                <td class="border border-black">
                    <input name="rancangan_anggaran[`+rowIndex+`][jumlah_item]" type="number" min="1" class="number-input border border-transparent w-full" placeholder="0" oninput="calculateSubtotal(this)">
                </td>
                <td class="border border-black text-center">
                    <span class="subtotal-display"></span>
                    <input type="hidden" class="subtotal-input" name="rancangan_anggaran[`+rowIndex+`][subtotal]">
                </td>
                <td class="border border-black text-center">
                    <button onclick="deleteRow(this)" class="border border-black rounded-md px-2 hover:underline hover:text-red-500">Delete</button>
                </td>
            `;
            updateRowNumbers();
        }

        function deleteRow(button) {
            if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                const row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
                updateRowNumbers();
                updateTotalKeseluruhan();
            }
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll("#dynamicTable tbody tr:not(#totalRow)");
            rows.forEach((row, index) => {
                row.querySelector("td:first-child").innerText = index + 1;
            });
        }

        function calculateSubtotal(input) {
            const row = input.parentNode.parentNode;
            const hargaSatuan = row.querySelector("td:nth-child(3) input").value;
            const jumlahItem = row.querySelector("td:nth-child(4) input").value;
            const subtotalDisplay = row.querySelector("td:nth-child(5) .subtotal-display");
            const subtotalInput = row.querySelector("td:nth-child(5) .subtotal-input");
            if (hargaSatuan && jumlahItem) {
                const subtotal = hargaSatuan * jumlahItem;
                subtotalDisplay.innerText = subtotal;
                subtotalInput.value = subtotal;
            } else {
                subtotalDisplay.innerText = '';
                subtotalInput.value = '';
            }
            updateTotalKeseluruhan();
        }

        function updateTotalKeseluruhan() {
            let total = 0;
            document.querySelectorAll(".subtotal-input").forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            document.getElementById("totalKeseluruhan").innerText = total;
        }

        document.addEventListener("DOMContentLoaded", updateRowNumbers);
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
