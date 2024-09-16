<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Pekerjaan</title>
    <style>
        .cover {
            padding: 30px;
            /* Mengatur padding di seluruh sisi untuk halaman cover */
            font-size: 24px;
        }

        .content {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-left: 70px;
            padding-right: 40px;
            padding-bottom: 20px;
            line-height: 1.5;
        }

        .text-center {
            text-align: center;
        }

        .logo {
            width: 400px;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 19px;
            margin-top: 20px;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        h3 {
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 20px;
        }

        p {
            margin: 5px 0;
            font-size: 13px;
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        /* signature */
        .signature-block {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 50px;
        }

        .left-column,
        .right-column {
            width: 45%;
        }

        .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            margin-bottom: 30px;
        }

        .signature-space {
            height: 60px;
        }

        .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .nip {
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="cover">
        <h1 class="text-center" style="margin-bottom: 50px;">LAPORAN PEKERJAAN</h1>

        <div style="text-align: center;">
            @if ($logoPath)
                <img src="{{ $logoPath }}" alt="Logo Dinas">
            @else
                <!-- Tampilkan teks atau gambar default jika logo tidak ditemukan -->
                <p>Logo tidak tersedia</p>
            @endif
        </div>

        <div class="text-center">Oleh : {{ $user->name }}</div>
        <div class="text-center" style="margin-bottom: 250px;">
            ({{ $pekerjaan->nama_pekerjaan ?? 'Tenaga Pendukung IT' }})
        </div>

        @php
            $bulanIndonesia = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ];

            // Asumsikan $bulan adalah angka bulan saat ini (1-12)
            $bulans = $bulan; // Mengambil bulan berdasarkan bulan yang dipilih user
            $bulanNama = $bulanIndonesia[$bulans];
        @endphp

        <div class="text-center">Bulan {{ $bulanNama }}</div>
        <div class="text-center">Tahun Anggaran {{ $tahun }}</div>

        {{-- batas halaman halaman 1 cover --}}
        <div style="page-break-after: always;"></div>
    </div>

    <div class="content">
        <h1 class="text-center">LAPORAN KERJA</h1>

        <table class="mb-3">
            <tr>
                <td><strong>PEKERJAAN</strong></td>
                <td>{{ $pekerjaan->nama_pekerjaan ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>TEMPAT</strong></td>
                <td>{{ $opd->name ?? 'N/A' }} Kota Pekanbaru</td>
            </tr>
            <tr>
                <td><strong>BULAN</strong></td>
                <td>
                    {{ $bulanIndonesia[$bulans] }}
                    {{ Carbon\Carbon::create(null, $bulans)->format('Y') }}
                </td>
            </tr>
            <tr>
                <td><strong>PEKERJA</strong></td>
                <td>{{ $user->name }}</td>
            </tr>
        </table>

        <h2>A. PENDAHULUAN</h2>
        <table class="mb-3">
            <tr>
                <td style="width: 110px;">
                    <strong>Latar Belakang</strong>
                </td>
                <td style="text-align: justify;">
                    {{ $formatLaporan->latar_belakang ?? 'N/A' }}
                </td>
            </tr>
            <tr>
                <td><strong>Maksud dan Tujuan</strong></td>
                <td style="text-align: justify;">{{ $formatLaporan->maksud_tujuan ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td><strong>Ruang Lingkup</strong></td>
                <td style="text-align: justify;">{{ $formatLaporan->ruang_lingkup ?? 'N/A' }}</td>
            </tr>
        </table>

        <h2>B. ISI LAPORAN</h2>
        @php
            // Sort the grouped rancangans to prioritize "Rancangan Kegiatan"
            $sortedGroupedRancangans = $groupedRancangans->sortBy(function ($rancangans, $kegiatanId) {
                return $rancangans->first()->kegiatan->nama_kegiatan === 'Rancangan Kegiatan' ? 0 : 1;
            });
        @endphp

        @foreach ($sortedGroupedRancangans as $kegiatanId => $rancangans)
            @php
                $kegiatan = $rancangans->first()->kegiatan;
                $nomorKegiatan = $loop->iteration;
            @endphp

            <h3>{{ $nomorKegiatan }}. {{ $kegiatan->nama_kegiatan }}</h3>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center; width: 10px;">No</th>
                        <th>Jenis Kegiatan</th>
                        <th>Tanggal Pekerjaan</th>
                        <th>Waktu dan Tempat</th>
                        <th>Pelaksanaan Kerja</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rancangans as $index => $rancangan)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $rancangan->jenis_kegiatan }}</td>
                            <td>
                                @php
                                    $tanggal = \Carbon\Carbon::parse($rancangan->tanggal);
                                    $bulanIndonesia = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                    $tanggalFormatted =
                                        $tanggal->format('d') .
                                        ' ' .
                                        $bulanIndonesia[$tanggal->format('n')] .
                                        ' ' .
                                        $tanggal->format('Y');
                                @endphp
                                {{ $tanggalFormatted }}
                            </td>
                            <td>{{ $rancangan->tempat }}</td>
                            <td style="text-align: justify;">{{ $rancangan->pelaksanaan_kerja }}</td>
                            <td style="text-align: center;">{{ $rancangan->progress }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <h2>C. KESIMPULAN PEKERJAAN</h2>
        <table class="mb-3">
            <thead>
                <tr>
                    <th style="text-align: center; width: 10px;">No</th>
                    <th>Kesimpulan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kesimpulan as $index => $k)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td style="text-align: justify;">{{ $k->isi_kesimpulan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="page-break-after: always;"></div>

        @if ($hasPhotos)
            <h2>D. LAMPIRAN</h2>
            @php $number = 1; @endphp
            @foreach ($lampirans as $lampiran)
                @if ($lampiran->foto)
                    <div style="margin-left: 35px; text-align: justify;">
                        <p>{{ $number }}. {{ $lampiran->jenis_kegiatan }}</p>
                    </div>
                    <div style="margin-bottom: 20px; text-align: center;">
                        <img src="{{ public_path('assets/images/' . $lampiran->foto) }}"
                            style="max-width: 460px; margin-top: 10px;">
                    </div>
                    @php $number++; @endphp
                @endif
            @endforeach
        @endif

        {{-- batas halaman tanda tangan --}}
        <div style="page-break-after: always;"></div>

        <p style="margin-left: 15px; margin-right: 15px; text-align: justify; padding-top: 20px;">Dengan penuh rasa
            tanggung jawab, kami
            menyampaikan laporan
            ini sebagai bentuk pertanggungjawaban kami terkait pelaksanaan pekerjaan yang telah dilakukan. Laporan ini
            disusun dengan seksama untuk memberikan gambaran yang jelas dan transparan mengenai seluruh proses dan hasil
            pekerjaan yang telah kami kerjakan.</p>

        <table style="width: 100%; margin-top: 50px; margin-left: 15px; border-collapse: collapse; border: none;">
            <tr>
                <td style="width: 45%; vertical-align: top; border: none; text-align: center; padding-right: 80px;">
                    <p style="font-weight: bold; margin-bottom: 5px;">Mengetahui</p>
                    <p style="margin-bottom: 30px;">{{ $formatLaporan->jabatan }} {!! $formatLaporan->bidangFormatted !!}</p>
                    <div style="height: 45px;"></div>
                    <p style="font-weight: bold;">{{ $formatLaporan->kabid }}</p>
                    <p>NIP. {{ $formatLaporan->nip }}</p>
                </td>
                <td style="width: 45%; vertical-align: top; border: none; text-align: center; padding-left: 100px;">
                    <p style="font-weight: bold; margin-bottom: 5px;">Yang Melaporkan,</p>
                    <p style="margin-bottom: 30px;">{{ $formatLaporan->pekerjaan }}</p>
                    <div style="height: 60px;"></div>
                    <p style="margin-bottom: 5px;">{{ $user->name }}</p>
                </td>
            </tr>
        </table>


    </div>
</body>

</html>
