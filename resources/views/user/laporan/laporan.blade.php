<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        @page {
            size: a4 portait;
            margin: 3cm 3cm 3cm 4cm;
        }

        .indent {
            text-indent: 3rem;
        }

        * {
            /* outline: 1px solid blue; */
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laporan AMI</title>
    <link rel="shortcut icon" href="https://utpas.ac.id/images/favicon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-serif">
    {{-- COVER --}}
    <section>
        <div class="text-center font-bold leading-normal">
            <h1 class="mb-6" style="font-size: 16pt">LAPORAN KEGIATAN</h1>
            <h1 class="mb-6" style="font-size: 14pt">AUDIT MUTU INTERNAL BIDANG PENDIDIKAN, PENELITIAN, DAN PENGABDIAN KEPADA MASYARAKAT</h1>
            <h1 class="" style="font-size: 12pt">PROGRAM STUDI {{ strtoupper($prodi) }}</h1>
            <h1 class="mb-32" style="font-size: 12pt">SIKLUS {{ $siklus }} TAHUN {{ $tanggal_ami->year }}</h1>
        </div>

        <div class="mb-44">
            <img src="https://utpas.ac.id/images/about/logo-inisial.svg" alt="logo utpas" class="mx-auto" style="height: 6cm">
        </div>

        <div class="text-center font-bold leading-normal" style="font-size: 14pt">
            <p>SISTEM PENJAMIN MUTU INTERNAL</p>
            <p>UNIVERSITAS UTPADAKA SWASTIKA</p>
            <p>TAHUN {{ $tanggal_akhir->year }}</p>
        </div>
    </section>

    {{-- LEMBAR PENGESAHAN --}}
    <section class="break-before-page">
        <div class="text-center w-full mb-4">
            <header>
                <table class="mx-auto w-full text-xs leading-4 bg-green-400">
                    <thead>
                        <tr>
                            <th class="border border-black">
                                <img src="https://utpas.ac.id/images/about/logo-inisial.svg" alt="Logo Utpas" class="mx-auto h-12">
                            </th>
                            <th class="border border-black font-normal leading-4">
                                Universitas Utpadaka Swastika<br>Jl. KS. Tubun No. 11 Pasar Baru - Tangerang<br>(021) 5589161/62
                            </th>
                            <th class="border border-black font-bold">
                                KODE/NO:<br>D.AMI/AKT/UTPAS/001/2023
                            </th>
                        </tr>
                        <tr>
                            <th class="border border-black font-normal" rowspan="2">
                                LEMBAGA<br>PENJAMIN<br>MUTU-LPM
                            </th>
                            <th class="border border-black font-bold" rowspan="2">
                                LAPORAN AUDIT MUTU INTERNAL (AMI)<br>PROGRAM STUDI {{ strtoupper($prodi) }}<br>SIKLUS {{ $siklus }} TAHUN {{ $tanggal_ami->year }}
                            </th>
                            <th class="border border-black font-normal">
                                TANGGAL DIKELUARKAN<br>{{ $tanggal_akhir->format('d F Y') }}
                            </th>
                        </tr>
                        <tr>
                            <th class="border border-black font-normal">
                                Revisi: -
                            </th>
                        </tr>
                    </thead>
                </table>
            </header>
        </div>

        <div class="text-center font-bold">
            <h1 class="mb-6" style="font-size: 14pt">LAPORAN AUDIT MUTU INTERNAL (AMI)<br>BIDANG PENDIDIKAN DAN
                PENGAJARAN</h1>
            <p class="mb-6">PROGRAM STUDI {{ strtoupper($prodi) }}</p>
            <P class="text-xs">UNIVERSITAS UTPADAKA SWASTIKA</P>
        </div>

        <div>
            <table class="w-full text-xs">
                <tbody>
                    <tr class="text-center border border-black">
                        <td colspan="2">
                            Revisi:
                        </td>
                    </tr>
                    <tr class="text-center border border-black">
                        <td colspan="2">
                            <br>
                        </td>
                    </tr>
                    <tr class="border border-black">
                        <td class="border border-black text-center">
                            <div class="my-auto">
                                Disusun oleh: SPMI
                            </div>
                        </td>
                        <td class="h-24 border border-black text-center p-2">
                            <div class="text-center">
                                <div class="mx-auto w-fit mb-2">
                                    <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Nani Dian Sari, S.Sn., M.Sn. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                                </div>
                                <span>Nani Dian Sari, S.Sn., M.Sn.</span>
                            </div>
                        </td>
                    </tr>
                    <tr class="border border-black">
                        <td class="border border-black text-center">
                            <div class="my-auto">
                                Disetujui oleh: LPM
                            </div>
                        </td>
                        <td class="h-24 border border-black text-center p-2">
                            <div class="text-center">
                                <div class="mx-auto w-fit mb-2">
                                    <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Asep Surahmat, S.Kom., M.Kom. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                                </div>
                                <span>Asep Surahmat, S.Kom., M.Kom.</span>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black text-center">
                            Rektor UTPAS
                        </td>
                        <td class="h-24 border border-black text-center p-2">
                            <div class="text-center">
                                <span>Ditetapkan Oleh:</span>
                                <div class="mx-auto w-fit my-2">
                                    <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Suhadarliyah, S.E., S.S., M.M. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                                </div>
                                <span>Suhadarliyah, S.E., S.S., M.M.</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- KATA PENGANTAR --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">KATA PENGANTAR</h1>
        <p class="text-justify mb-4 indent">Puji syukur kami panjatkan kehadirat Tuhan Yang Maha Esa, atas berkat
            dan rahmat-Nya kita masih diberi kesehatan dan
            kesempatan sehingga "Laporan Audit Mutu Internal Bidang Pendidikan, Penelitian, dan Pengabdian Kepada
            Masyarakat" ini
            dapat diselesaikan. Laporan ini disusun sebagai laporan hasil audit oleh Tim Auditor AMI dalam kegiatan
            Audit Mutu
            Internal Tahun Akademik SIKLUS {{ $siklus }} TAHUN {{ $tanggal_ami->year }} Universitas Utpadaka Swastika.</p>
        <p class="text-justify mb-4 indent">Berdasarkan hasil audit, terdapat beberapa temuan yang keseluruhannya
            sudah mendapat tanggapan dari pihak Prodi
            {{ $prodi }}. Harapan kami, temuan tersebut dapat segera ditindaklanjuti. Sehingga, dapat meningkatkan kualitas
            dan kinerja
            Program Studi {{ $prodi }}.</p>
        <p class="text-justify mb-4 indent">Apresiasi kami sampaikan kepada auditi yang telah kooperatif dalam
            pelaksanaan kegiatan ini. Ucapan terima kasih kami
            berikan bagi semua pihak yang telah membantu terlaksananya kegiatan.</p>
        <p class="text-justify mb-4 mt-24" style="margin-left: 60%">Tangerang, {{ $tanggal_akhir->dayName }} {{ $tanggal_akhir->format('d F Y') }}<br><br><br><br>SPMI</p>
    </section>

    {{-- DAFTAR ISI --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">DAFTAR ISI</h1>
    </section>

    {{-- DAFTAR TABEL --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">DAFTAR TABEL</h1>
    </section>

    {{-- IDENTITAS PROGRAM STUDI --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">IDENTITAS PROGRAM STUDI </h1>
        <div>
            <table class="mx-auto w-10/12">
                <tbody>
                    <tr>
                        <td>
                            Program Studi
                        </td>
                        <td>
                            : {{ $prodi }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Perguruan Tinggi
                        </td>
                        <td>
                            : UNIVERSITAS UTPADAKA SWASTIKA
                        </td>
                    </tr>
                    <tr>
                        <td class="align-top">
                            Auditee
                        </td>
                        <td>
                            : {{ $auditee->name }}<br><span class="ml-2">(Kaprodi {{ $prodi }})</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h1 class="text-center font-bold mt-12 mb-6">LAPORAN AUDIT MUTU INTERNAL PROGRAM STUDI</h1>
            <table class="mx-auto">
                <tbody>
                    <tr>
                        <td class="border border-black">
                            Perguruan Tinggi
                        </td>
                        <td colspan="2" class="border border-black">
                            : Universitas Utpadaka Swastika
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Program Studi
                        </td>
                        <td colspan="2" class="border border-black">
                            : {{ $prodi }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Alamat
                        </td>
                        <td colspan="2" class="border border-black">
                            : Jl. KS. Tubun No. 11, Pasar Baru-Tangerang
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Tanggal Audit
                        </td>
                        <td colspan="2" class="border border-black">
                            : {{ $tanggal_ami->format('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Ketua Auditor
                        </td>
                        <td class="border border-black">
                            {{ $auditor1->name }}
                        </td>
                        @php
                            $showQrCodeAuditor1 = false;
                            foreach ($alreadyApproved as $approval) {
                                if($approval['id_user'] == $auditor1->id){
                                    $showQrCodeAuditor1 = true;
                                    break;
                                }
                            }
                        @endphp
                        <td class="w-28 h-24 border border-black text-center p-2">
                            @if ($showQrCodeAuditor1)
                                <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_ami->year }}, telah disahkan oleh {{ $auditor1->name }} pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_ami->format('d F Y') }}"></div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-black">
                            Anggota
                        </td>
                        <td class="border border-black">
                            {{ $auditor2->name }}
                        </td>
                        @php
                            $showQrCodeAuditor2 = false;
                            foreach ($alreadyApproved as $approval) {
                                if($approval['id_user'] == $auditor2->id){
                                    $showQrCodeAuditor2 = true;
                                    break;
                                }
                            }
                        @endphp
                        <td class="w-28 h-24 border border-black text-center p-2">
                            @if ($showQrCodeAuditor2)
                                <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_ami->year }}, telah disahkan oleh {{ $auditor2->name }} pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_ami->format('d F Y') }}"></div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- BAB 1 --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">BAB I<br>
            PENDAHULUAN
        </h1>
        <h2 class="font-bold font-serif" style="font-size:12pt">
            <span class="inline-block w-12">A.</span>
            <span>Latar Belakang</span>
        </h2>
        <p class="text-justify mb-4 indent" style="font-size: 12pt">Mutu Pendidikan Tinggi merupakan kegiatan
            sistemik, Peningkatan Mutu Pendidikan
            Tinggi merupakan prioritas pertama dari rencana Strategis. Untuk meningkatkan mutu Pendidikan Tinggi secara
            terencana dan
            berkelanjutan, sesuai Permenristek No. 3 tahun 2020, dikemukakan "sistem penjamin mutu internal yang
            dikembangkan
            oleh Perguruan Tinggi meliputi yakni; standar mutu nasional pendidikan, standar penelitian, dan standar
            pengabdian kepada
            masyarakat. Sesuai Permenristekdikti No. 62 Tahun 2016 Tentang SPM Dikti, dan yang menjadi keharusan adalah
            keberadaan
            SPMI di setiap perguruan tinggi dengan menjalankan Audit Mutu Internal (AMI). Sedangkan Sistem penjamin mutu
            eksternal
            dilakukan melalui akreditasi.</p>
        <p class="text-justify mb-4 indent">Audit Mutu Internal merupakan evaluasi diri yang ditinjau secara
            berkala, disesuaikan dengan kondisi-kondisi internal program studi, praktik yang baik yang berlaku di
            Perguruan Tinggi dan Kemenristek Dikti. Data hasil audit adalah data dari, oleh, dan untuk program studi
            yang ada pada Universitas Utpadaka Swastika. Oleh karena itu, data yang diperoleh dapat menjadi penuntun
            program studi melakukan evaluasi diri, menetapkan rencana tindak lanjut, perencanaan, menetapkan
            pelaksanaan, monitoring-evaluasi, serta perbaikan terus-menerus untuk mencapai standar mutu dan kriteria
            yang ditetapkan. Instrumen pada kegiatan ini mengacu pada agenda audit, form Desk Evaluation, ceklist
            auditor, laporan hasil audit, dan saran.</p>
        <p class="text-justify mb-4 indent">Melalui pelaksanaan Audit Mutu Internal, program studi dapat mengetahui
            apakah Program Studi telah memenuhi standar Prodi Perguruan Tinggi dan apakah mereka telah memenuhi
            kebutuhan peserta didik. Karena itu, masing-masing program studi perlu dilakukan AMI setiap tahun, sehingga
            program studi dapat mempergunakan informasi yang dikumpulkan untuk mengarahkan perencanaan menuju
            peningkatan mutu berkelanjutan.</p>

        <h2 class="font-bold break-before-page" style="font-size:12pt">B. Tujuan Pelaksanaan AMI</h2>
        <p class="text-justify mb-2">Adapun tujuan dilaksanakan AMI antara lain:</p>
        <div class="pl-4">
            <ol class="list-disc">
                <li class="text-justify mb-2">Memastikan kelancaran pelaksanaan pengelolaan Program Studi;</li>
                <li class="text-justify mb-2">Memastikan pelaksanaan proses pembelajaran;</li>
                <li class="text-justify mb-2">Memetakan peluang peningkatan mutu Program Studi; dan</li>
                <li class="text-justify mb-2">Memetakan kesiapan Program Studi dalam melaksanakan program Akreditasi.</li>
            </ol>
        </div>


        <h2 class="font-bold font-serif" style="font-size:12pt">C. Sasaran Kegiatan AMI</h2>
        <div class="pl-4">
            <ol class="list-disc">
                <li class="text-justify mb-2">Adapun sasaran kegiatan AMI antara lain:</li>
                <li class="text-justify mb-2">Meningkatkan mutu kesadaran Budaya Universitas Utpadaka Swastika;</li>
                <li class="text-justify mb-2">Terlaksananya praktik audit mutu internal di Universitas Utpadaka Swastika;</li>
                <li class="text-justify mb-2">Terimplementasinya sistem audit mutu internal yang menggerakan Kinerja Akreditasi.</li>
            </ol>
        </div>
    </section>

    {{-- BAB 2 --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-4" style="font-size: 14pt">BAB II<br>METODE
            PELAKSANAAN</h1>
        <div>
            <h2 class="font-bold font-serif">A. Waktu dan Tempat Pelaksanaan AMI</h2>
            <table class="ml-6 my-4">
                <tbody>
                    <tr>
                        <td class="w-36">
                            Hari, Tanggal
                        </td>
                        <td>
                            : {{ $tanggal_mulai->dayName }}-{{ $tanggal_akhir->dayName }} ({{ $tanggal_mulai->format('d F Y') }} - {{ $tanggal_akhir->format('d F Y') }})
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Waktu
                        </td>
                        <td>
                            : 09.00-15.30 WIB
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tempat
                        </td>
                        <td>
                            : Ruang Perpustakaan Universitas Utpadaka Swastika
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <h2 class="font-bold font-serif mb-2">B. Ruang Lingkup AMI</h2>
            <p class="ml-6 text-justify">Adapun ruang lingkup AMI yang telah dilakukan yaitu: <br>Objek audit Program Studi {{ $prodi }} Universitas Utpadaka Swastika bidang Pendidikan yang terdiri dari <span class="font-semibold">Standar Kompetensi Lulusan, Standar Isi Pembelajaran, Standar Proses Pembelajaran, Standar Penilaian Pembelajaran, Standar Dosen Dan Tenaga Kependidikan, Standar Sarana Dan Prasarana Pembelajaran, Standar Pengelolaan Pembelajaran, Dan Standar Pembiayaan Pembelajaran.</span></p>
        </div>
        <div class="mb-4">
            <h2 class="font-bold font-serif">C. Anggaran Biaya</h2>
            <table class="ml-6 text-s w-full">
                <tbody>
                    @php
                        $counter =1;
                    @endphp
                    @foreach ($anggaran as $barang)
                    <tr>
                        <td class="w-fit">
                            {{ $counter }}.
                        </td>
                        <td class="w-fit">
                            {{ $barang->nama_item }} {{ $barang->jumlah_item }} pcs / Rp{{ $barang->harga_satuan }}
                        </td>
                        <td class="w-fit">
                            = Rp{{ number_format(($barang->subtotal), 2) }}
                        </td>
                    </tr>
                    @php
                        $counter++;
                    @endphp
                    @endforeach
                    <tr class="font-bold">
                        <td colspan="2">
                            Jumlah anggaran keseluruhan
                        </td>
                        <td>
                            = Rp{{ number_format(($anggaran->sum('subtotal')), 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <h2 class="font-bold font-serif">D. Mekanisme Pelaksanaan AMI</h2>
            <p class="ml-6">
                Mekanisme pelaksanaan AMI untuk SIKLUS {{ $siklus }} TAHUN {{ $tanggal_ami->year }} adalah sebagai berikut:
            </p>
            <div class="pl-10 mb-4">
                <ol class="list-decimal text-justify" type="1">
                    <li>
                        Rektor mengeluarkan Surat Perintah Pelaksanaan AMI.
                    </li>
                    <li>
                        Wakil Rektor kick off meeting untuk meresmikan dimulainya masa AMI dan menentukan area audit
                    </li>
                    <li>
                        Ketua LPM membentuk Tim Audit yang terdiri dari Auditor Mutu Internal.
                    </li>
                    <li>
                        LPM menyelenggarakan Pelatihan Audit Mutu Internal (AMI)
                    </li>
                    <li>
                        Auditor Lapangan sesuai dengan penugasannya melakukan Audit Dokumen berdasarkan daftar pertanyaan audit yang sudah diisi oleh Program Studi.
                    </li>
                    <li>
                        Auditor membuat Daftar Pertanyaan AMI yang diserahkan kepada Auditee setidaknya H – 1 dari jadwal Audit Lapangan.
                    </li>
                    <li>
                        Auditor melaksanaan Audit Lapangan sesuai dengan waktu yang disepakati ke lokasi Prodi/Unit.
                    </li>
                    <li>
                        Auditor melakukan rapat hasil Audit Lapangan dan menyampaikan kembali kepada Auditee untuk mendapat
                        persetujuan. Luaran AMI adalah rekomendasi untuk pengendalian dan peningkatan mutu, dituangkan dalam
                        dokumen Permintaan Tindakan Koreksi (PTK) dan Permintaan Tindakan Peningkatan (PTP). Luaran ini akan
                        didiskusikan dalam Rapat Tinjauan Manajen (RTM) bersama para Pimpinan Universitas Utpadaka Swastika.
                    </li>
                </ol>
            </div>
        </div>
        <div>
            <h2 class="font-bold font-serif">E. Pelaksana Kegiatan dan Penanggungjawab</h2>
            <div class="pl-6">
                <p>Tim pelaksanaan kegiatan Audit Mutu Internal Program Studi {{ $prodi }} Universitas Utpadaka Swastika Tahun
                    SIKLUS {{ $siklus }} TAHUN {{ $tanggal_ami->year }}.</p>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                Penanggungjawab
                            </td>
                            <td>
                                : Nani Dian Sari, S.Sn., M.Sn.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Ketua Auditor
                            </td>
                            <td>
                                : {{ $auditor1->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Anggota
                            </td>
                            <td>
                                : {{ $auditor2->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="align-top">
                                Auditee
                            </td>
                            <td>
                                : {{ $auditee->name }} <br> <span class="ml-2">(Kaprodi {{ $prodi }})</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- BAB 3 --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">BAB III<br>HASIL DAN ANALISIS</h1>
        <h2 class="font-bold font-serif mb-4">A. Hasil Temuan AMI Bidang Pendidikan dan Pengajaran</h2>
        <table class="w-full leading-4 mb-1" style="font-size:11pt">
            <thead class="bg-orange-200">
                <tr>
                    <th rowspan="3" class="border border-black">
                        No
                    </th>
                    <th rowspan="3" class="border border-black">
                        Referensi<br>Butir Mutu Standar
                    </th>
                    <th colspan="5" class="border border-black">
                        Jenis Temuan
                    </th>
                </tr>
                <tr>
                    <th rowspan="2" class="border border-black">
                        Kelebihan
                    </th>
                    <th colspan="3" class="border border-black">
                        Kekurangan Kategori*
                    </th>
                    <th rowspan="2" class="border border-black">
                        Peluang untuk Peningkatan
                    </th>
                </tr>
                <tr>
                    <th class="border border-black">
                        OBS
                    </th>
                    <th class="border border-black">
                        KTS
                    </th>
                    <th class="border border-black">
                        KTB
                    </th>
                </tr>
            </thead>
            <tbody class="font-normal">
                @foreach ($penilaian as $temuan)
                <tr>
                    <td class="border border-black text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="border border-black p-1">
                        {{ $temuan['tilik']['butir_mutu'] }}
                    </td>
                    <td class="border border-black p-1">
                        {{ $temuan['kelebihan'] }} 
                    </td>
                    
                    <td class="text-center border border-black">
                        @if($temuan['kekurangan_kategori'] === 1)
                            <span class="material-icons">check</span>
                        @endif
                    </td>
                    <td class="text-center border border-black">
                        @if($temuan['kekurangan_kategori'] === 2)
                            <span class="material-icons">check</span>
                        @endif
                    </td>
                    <td class="text-center border border-black">
                        @if($temuan['kekurangan_kategori'] === 3)
                            <span class="material-icons">check</span>
                        @endif
                    </td>

                    <td class="border border-black p-1">
                        {{$temuan['peluang_peningkatan']}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="w-full mt-1 leading-4">
            <tbody>
                <tr>
                    <td colspan="6" class="border border-black text-center bg-orange-200">
                        Tempat Persetujuan
                    </td>
                </tr>
                <tr class="h-16">
                    <td class="border border-black text-center bg-orange-200">
                        Ketua Auditor
                    </td>
                    <td class="border border-black text-center">
                        {{ $auditor1->name }}
                    </td>
                    <td class="border border-black text-center w-28 p-2">
                        @if ($showQrCodeAuditor1)
                            <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_ami->year }}, telah disahkan oleh {{ $auditor1->name }} pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_ami->format('d F Y') }}"></div>
                        @endif
                    </td>
                    <td class="border border-black text-center bg-orange-200" rowspan="2">
                        Auditee
                    </td>
                    <td class="border border-black text-center" rowspan="2" rowspan="2">
                        {{ $auditee->name }}
                    </td>
                    @php
                        $showQrCodeAuditee = false;
                        foreach ($alreadyApproved as $approval) {
                            if($approval['id_user'] == $auditee->id){
                                $showQrCodeAuditee = true;
                                break;
                            }
                        }
                    @endphp
                    <td class="border border-black text-center w-28 p-2" rowspan="2">
                        @if ($showQrCodeAuditee)
                            <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh {{ $auditee->name }} pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                        @endif
                    </td>
                </tr>
                <tr class="h-16">
                    <td class="border border-black bg-orange-200 text-center">
                        Anggota
                    </td>
                    <td class="border border-black text-center">
                        {{ $auditor2->name }}
                    </td>
                    <td class="border border-black text-center w-28 p-2">
                        @if ($showQrCodeAuditor2)
                            <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_ami->year }}, telah disahkan oleh {{ $auditor2->name }} pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_ami->format('d F Y') }}"></div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="w-full leading-4">
            <tbody>
                <tr>
                    <td colspan="3" class="text-center border border-black border-t-transparent bg-orange-200">
                        Direview oleh:
                    </td>
                </tr>
                <tr>
                    <td class="border border-black w-4/12 h-16 bg-orange-200 text-center">
                        Ketua SPMI
                    </td>
                    <td class="border border-black w-4/12">
                        {{ $ami->nama_spmi }}
                    </td>
                    <td class="border border-black text-center w-28 p-2">
                        <div class="mx-auto w-fit">
                        <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Nani Dian Sari, S.Sn., M.Sn. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="border border-black w-4/12 h-16 bg-orange-200 text-center">
                        Ketua LPM
                    </td>
                    <td class="border border-black w-4/12">
                        {{ $ami->user_lpm->name }}
                    </td>
                    <td class="border border-black text-center w-28 p-2">
                        <div class="mx-auto w-fit">
                        <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Asep Surahmat, S.Kom., M.Kom. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center border border-black border-t-transparent bg-orange-200">
                        Mengetahui:
                    </td>
                </tr>
                <tr>
                    <td class="border border-black w-4/12 h-16 bg-orange-200 text-center">
                        Wakil Rektor
                    </td>
                    <td class="border border-black w-4/12">
                        {{ $ami->nama_warek_utpas }}
                    </td>
                    <td class="border border-black text-center w-28 p-2">
                        <div class="mx-auto w-fit">
                            <div class="qrcode" data-text="Laporan AMI Prodi {{ $prodi }} Tahun {{ $tanggal_akhir->year }}, telah disahkan oleh Meidy F. Lombogia, S.H., M.M. pada hari {{ $tanggal_akhir->dayName }}, {{ $tanggal_akhir->format('d F Y') }}"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 class="font-bold my-4">B. Analisis Hasil Temuan</h2>
        <p class="text-justify indent mb-4">Kegiatan Audit Mutu Internal (AMI) diawali dengan melakukan audit dokumen desk evaluation
            dengan membuat pertanyan-pertanyaan yang berhubungan dengan ketersediaan dokumen serta pelaksanaan kegiatan yang harus
            dipersiapkan dan dilaksanakan oleh setiap unit di Prodi {{ $prodi }}.</p>
        <p class="text-justify indent mb-4">Kemudian hasil desk evaluation tersebut dilakukan tindak lanjut dengan melakukan audit
            lapangan menggunakan daftar tilik yang telah disediakan sehingga memperoleh hasil dari tilik dokumen (Sesuai dan
            Ketidaksesuaian).</p>
        <p class="text-justify indent mb-4">Berdasarkan dari hasil analisis desk evaluation, sesuai dengan standar dokumen Program
            Studi {{ $prodi }} telah mencapai persen (%) sebagai berikut:</p>
        <table class="mx-auto">
            <tbody>
                @foreach($penilaian->groupBy('tilik.standar.nama') as $nama_standar => $standar_penilaian)
                <tr>
                    <td class=" w-8 text-center">
                        1.
                    </td>
                    <td class="">
                        {{ ucwords(strtolower($nama_standar)) }}
                    </td>
                    <td class="">
                        : {{ number_format(($standar_penilaian->avg('angka') / 5 * 100), 1) }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    {{-- BAB 4 --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">BAB IV<br>RENCANA
            TINDAK LANJUT</h1>
        <table class="mx-auto">
            <thead class="bg-orange-200">
                <tr>
                    <th class="border border-black">
                        No
                    </th>
                    {{-- <th class="border border-black">
                        Referensi<br>(Butir Mutu)
                    </th> --}}
                    <th class="border border-black">
                        Temuan
                    </th>
                    <th class="border border-black">
                        *Rencana Tindakan Perbaikan (RTP)
                    </th>
                    <th class="border border-black">
                        Penanggungjawab
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rtp as $nama_standar => $standar_rtp)
                <tr>
                    <td colspan="4"  class="text-center border border-black">{{ ucwords(strtolower($nama_standar)) }}</td> 
                </tr>
                @foreach($standar_rtp as $temuan_rtp)
                <tr>
                    <td class="text-center border border-black">
                        1
                    </td>
                    <td class="border border-black">
                        {{ $temuan_rtp->temuan }}
                    </td>
                    <td class="border border-black">
                        {{ $temuan_rtp->rtp}}
                    </td>
                    <td class="border border-black">
                        {{ $temuan_rtp->penanggungjawab }}
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </section>

    {{-- BAB 5 --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">BAB V<br>PENUTUP</h1>
        <h2 class="font-bold font-serif mb-4">A. Kesimpulan Audit</h2>
        <p class="text-justify indent">Berdasarkan Audit Lapangan pada Prodi {{ $prodi }} dalam lingkup audit Standar Pendidikan dan Pengajaran dapat
            disimpulkan bahwa, berdasarkan {{ $ami->standar->count() }} standar dan {{ $jumlah_butir_mutu }} butir mutu yang diukur dalam hasil Audit Lapangan disimpulkan bahwa
            terdapat {{ $penilaian->whereNotNull('kekurangan_kategori')->count() }} temuan ketidaksesuaian yaitu {{ $penilaian->where('kekurangan_kategori', 2)->count() }} temuan dalam kategori ketidasesauian ringan (KTS), {{ $penilaian->where('kekurangan_kategori', 3)->count() }} kategori ketidaksesuaian
            berat (KTB), dan {{ $penilaian->where('kekurangan_kategori', 1)->count() }} obrservasi (OBS). Selain itu pada desk evaluation dari {{ $jumlah_tilik }} butir pertanyaan desk evaluation tentang {{ $ami->standar->count() }}
            standar pendidikan sehingga memperoleh kalkulasi data yaitu rincian persen (%). (dilihat pada halaman 9)</p>
        <h2 class="font-bold font-serif my-4">B. Saran</h2>
        <p class="text-justify indent">Dengan terlaksananya Audit Mutu Internal (AMI) Prodi {{ $prodi }} di Perguruan Tinggi
            Universitas Utpadaka Swastika diharapkan dapat menjadi evaluasi untuk kedepannya dalam peningkatan mutu baik di bidang
            pendidikan, penelitian dan pengabdian kepada masyarakat dan lainnya.</p>
    </section>

    {{-- LAMPIRAN --}}
    <section class="break-before-page">
        <h1 class="text-center font-bold mb-6" style="font-size: 14pt">LAMPIRAN</h1>
        <div>
            
        </div>
    </section>
    <script>
        document.querySelectorAll('.qrcode').forEach(function(element) {
            new QRCode(element, {
                text: element.getAttribute('data-text'),
                width: 100,
                height: 100
            });
        });
    </script>
</body>

</html>
