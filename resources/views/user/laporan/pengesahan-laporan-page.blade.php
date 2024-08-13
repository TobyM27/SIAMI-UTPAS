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

        .iframe-container {
            width: 210mm;
            height: 297mm;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .iframe-content {
            width: 210mm;
            /* A4 width */
            height: 297mm;
            /* A4 height */
            border: 1px solid #000;
        }
    </style>
</head>

<body class="font-sans">
    {{-- header --}}
    <div class="h-20 flex justify-between" style="background: rgb(255, 193, 7);">
        <img src="https://utpas.ac.id/images/logo.svg" alt="logo-utpas" class="h-16 ml-2 mt-2 mb2">
        <div class="relative flex gap-2 mr-2 items-center">
            <p class="text-right text-middle font-medium font-sans">Hai, {{ auth()->user()->name }}<p>
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
    <div class="flex justify-between w-full">
        <div class="iframe-container mt-16 ml-4">
            <iframe class="iframe-content" src="{{ route('laporan.ami.view', $ami) }}"></iframe>
        </div>
        <form action="{{ route('laporan.ami.sah', $ami) }}" method="POST" id="sahkan_button">
        @csrf
        <input type="hidden" name="id_ami" value="{{ $ami->id }}">
        <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
        <input type="hidden" name="nama_pengesah" value="{{ auth()->user()->name }}">
        <input type="hidden" name="jabatan_pengesah" value="{{ auth()->user()->role }}">
        <input type="hidden" name="tanggal_pengesahan" value="{{ date('Y-m-d H:i:s') }}">

        <div class="mt-16 mr-4">
            <table class="mx-auto w-full">
                <thead class="text-sm" style="background: rgb(102, 16, 242)">
                    <th class="leading-4 border border-black p-2 text-white font-semibold" colspan="2">
                        Pernyataan Pengesahan Dokumen AMI<br>Program Studi {{ $ami->prodi }}<br>Tahun {{ $ami->tanggal_akhir->year }}
                    </th>
                </thead>
                <tbody class="text-sm">
                    <tr>
                        <th class="border border-black font-normal text-center h-12" colspan="2">
                            Saya <strong>{{ auth()->user()->name }}</strong>, sebagai <strong> {{ auth()->user()->role }} </strong> menyatakan:
                        </th>
                    </tr>
                    <tr>
                        <th class="border border-black  w-1/12">
                            <input type="checkbox" name="checkbox1" id="checkbox1" @if(isset($alreadyApproved) && $alreadyApproved) checked disabled @endif>
                        </th>
                        <th class="border border-black h-12 text-sm text-left font-medium">
                            Saya telah membaca keseluruhan isi laporan dengan teliti dan seksama
                        </th>
                    </tr>
                    <tr>
                        <th class="border border-black h-12 w-1/12">
                            <input type="checkbox" name="checkbox2" id="checkbox2" @if(isset($alreadyApproved) && $alreadyApproved) checked disabled @endif>
                        </th>
                        <th class="border border-black text-sm text-left font-medium">
                            Saya menyatakan bahwa isi laporan telah sesuai dengan ketentuan
                        </th>
                    <tr>
                        <th class="border border-black h-12 w-1/12">
                            <input type="checkbox" name="checkbox3" id="checkbox3" @if(isset($alreadyApproved) && $alreadyApproved) checked disabled @endif>
                        </th>
                        <th class="border border-black  text-sm text-left font-medium">
                            Saya menyatakan setuju untuk mengesahkan laporan AMI ini
                        </th>
                    </tr>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <button class="border border-black rounded-md p-2 w-5/12" id="sahkan-button" disabled>
                    Sahkan dokumen AMI
                </button>
            </div>
            <div class="text-center mt-4">
                {{-- <button class="border border-black rounded-md p-2 w-5/12" onclick="printPreview()">
                    Unduh laporan AMI
                </button> --}}
                <a class="border border-black rounded-md p-2 w-5/12 text-center inline-block" href="{{ route('laporan.ami.view', $ami) }}" download>
                    Unduh laporan AMI
                </a>
            </div>
        </div>
        </form>
    </div>
    <script>
        //script untuk ngecek semua checkbox untuk pengesahan user
        const checkbox1 = document.getElementById('checkbox1');
        const checkbox2 = document.getElementById('checkbox2');
        const checkbox3 = document.getElementById('checkbox3');
        const sahkanButton = document.getElementById('sahkan-button');

        function checkAllChecked() {
            if (checkbox1.checked && checkbox2.checked && checkbox3.checked) {
                sahkanButton.disabled = false;
                sahkanButton.classList.add('bg-green-500');
                sahkanButton.classList.remove('bg-gray-400');
            } else {
                sahkanButton.disabled = true;
                sahkanButton.classList.add('bg-gray-400'); 
                sahkanButton.classList.remove('bg-green-500'); 
            }
        }
        checkbox1.addEventListener('change', checkAllChecked);
        checkbox2.addEventListener('change', checkAllChecked);
        checkbox3.addEventListener('change', checkAllChecked);

        function printPreview() {
            const printWindow = window.open("https://siami.ddev.site/laporan", "_blank");
            printWindow.onload = function() {
                printWindow.print();
            };
        }
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
