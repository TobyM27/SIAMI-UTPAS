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

        .hidden {
            display: none;
        }
    </style>
</head>

<body class="font-sans">
    <div class="h-20 flex justify-between" style="background: rgb(255, 193, 7);">
        <img src="https://utpas.ac.id/images/logo.svg" alt="logo-utpas" class="h-16 ml-2 mt-2 mb2">
        <div class="relative flex gap-2 mr-2 items-center">
            <p class="text-right text-middle font-medium font-sans">Hai, {{ auth()->user()->name }}</p>
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

    <div class="text-center font-sans mt-24 mx-4">
        <div class="text-center mx-auto w-4/12 mb-4" style="background:rgb(102, 16, 242);">
            <h1 class="text-white">SISTEM INFORMASI AUDIT MUTU INTERNAL<br>UNIVERSITAS UTPADAKA SWASTIKA</h1>
        </div>
        <table class="w-2/4 h-fit mx-auto">
            <thead class="bg-amber-400 text-base">
                <tr>
                    <th class="w-5/12 border border-black">Daftar Program Studi & Unit</th>
                    {{-- <th class="w-5/12 border border-black">Siklus</th> --}}
                    <th class="w-3/12 border border-black">Status Audit</th>
                    <th class="w-2/12 border border-black">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-12 text-sm">
                <td colspan="3" class="border border-black font-bold">
                    Program Studi
                </td>
                @foreach ($data_ami_prodi as $data_ami)
                    <tr>
                        <td class="border border-black text-left">{{  $data_ami['nama_prodi'] }}</td>
                        {{-- <td class="border border-black text-center">{{  $data_ami['siklus'] }}</td> --}}
                        <td class="border border-black px-6">
                            @php
                                $warna_status = 'bg-white';
                                switch($data_ami['status']) {
                                    case 'belum ada':
                                        $warna_status = 'bg-white';
                                        break;
                                    case 'sedang dilaksanakan':
                                        $warna_status = 'bg-yellow-500';
                                        break;
                                }
                            @endphp
                            <span class="border border-black rounded-md {{  $warna_status }} inline-block w-full">
                                {{ $data_ami['status'] }} 
                            </span>
                        </td>
                        <td class="border border-black">
                            <button class="border border-black rounded-md px-4" onclick="location.href='{{route('lpm.prodi.page', $data_ami['nama_prodi']) }}'">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- untuk dikembangkan lebih lanjut. ini fitur untuk tambah standar --}}
        {{-- <table class="w-4/12 h-fit">
            <thead>
                <tr>
                    <th class="border border-black px-2 bg-yellow-500" colspan="2">
                        Daftar Standar Audit Mutu Internal
                    </th>
                </tr>
            </thead>
            <tbody class="text-left">
                <tr>
                    <td class="border border-black">
                        Standar 1
                    </td>
                    <td class="text-center border border-black w-1/12">
                        <button class="toggle-button" data-target="child-table-1">
                            <span class="material-icons align-middle">search</span>
                        </button>
                    </td>
                </tr>
                <tr class="child-table hidden" id="child-table-1">
                    <td colspan="2">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 1
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-1-1">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-1-1">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 2
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-1-2">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-1-2">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="border border-black">
                        Standar 2
                    </td>
                    <td class="text-center border border-black w-1/12">
                        <button class="toggle-button" data-target="child-table-2">
                            <span class="material-icons align-middle">search</span>
                        </button>
                    </td>
                </tr>
                <tr class="child-table hidden" id="child-table-2">
                    <td colspan="2">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 1
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-2-1">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-2-1">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 2
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-2-2">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-2-2">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="border border-black">
                        Standar 3
                    </td>
                    <td class="text-center border border-black w-1/12">
                        <button class="toggle-button" data-target="child-table-3">
                            <span class="material-icons align-middle">search</span>
                        </button>
                    </td>
                </tr>
                <tr class="child-table hidden" id="child-table-3">
                    <td colspan="2">
                        <table class="w-full">
                            <tbody>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 1
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-3-1">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-3-1">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-black">
                                        Butir Mutu 2
                                    </td>
                                    <td class="text-center border border-black w-1/12">
                                        <button class="toggle-button" data-target="child-question-table-3-2">
                                            <span class="material-icons align-middle">search</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="child-question-table hidden" id="child-question-table-3-2">
                                    <td colspan="2">
                                        <table class="w-full">
                                            <tbody>
                                                <tr>
                                                    <td class="border border-black">Pertanyaan Standar 1</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table> --}}
    </div>

    {{-- Ini fitur untuk hide/unhide table child, untuk dikembangkan lebih lanjut --}}
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const buttons = document.querySelectorAll('.toggle-button');

        //     buttons.forEach(button => {
        //         button.addEventListener('click', function() {
        //             const targetId = this.getAttribute('data-target');
        //             const targetElement = document.getElementById(targetId);
        //             if (targetElement.classList.contains('hidden')) {
        //                 targetElement.classList.remove('hidden');
        //             } else {
        //                 targetElement.classList.add('hidden');
        //             }
        //         });
        //     });
        // });--}}
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
