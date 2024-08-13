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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            /* outline: 1px solid blue; */
        }

        .hidden {
            display: none;
        }

        .active-button {
            background-color: #d3d3d3;
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

    <div class="">
        <h1 class="bg-blue-500 w-fit text-center rounded-md mx-auto p-2 leading-5 mt-24 font-bold">Detail Siklus
            AMI<br>Prodi
            {{ $prodi }}
        </h1>
            <table class="w-2/4 mx-auto font-sans mt-6">
                <thead class="bg-amber-400">
                    <tr>
                        <th class="w-4/12 border border-black">Daftar Siklus AMI</th>
                        <th class="w-4/12 border border-black">Status AMI</th>
                        <th class="w-2/12 border border-black">Edit AMI</th>
                        <th class="w-2/12 border border-black">Detail</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-center">
                    @foreach ($data_ami as $siklus)
                        @foreach ($siklus as $ami)
                        <tr>
                            <td class="border border-black text-left font-bold">Siklus {{ $ami->siklus }}</td>
                            <td class="border border-black px-6"><span class="border border-black rounded-md bg-green-400 inline-block w-full">Terlaksana</span></td>
                            <td class="border border-black"><button onclick="location.href='{{ route('lpm.edit.view', $ami) }}'" class="border border-black rounded-md px-4">Edit</button></td>
                            <td class="border border-black"><button onclick="location.href='{{route('lpm.ami.view', $ami)}}'" class="border border-black rounded-md px-4 detail-btn" data-target="child-1">Detail</button></td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
    </div>

    <div class="text-center mt-6"><button onclick="location.href='{{ route('lpm.ami.create', $prodi) }}'" class="bg-blue-400 border border-black rounded-md">Tambah Siklus</button>
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
