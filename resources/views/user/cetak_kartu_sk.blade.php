<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Nomor SK - {{ $sk->nosk }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'times': ['"Times New Roman"', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Screen styles - tampilan normal */
        @media screen {
            .print-only { display: none !important; }
        }
        
        /* Print styles - layout dua kolom seperti file asli */
        @media print {
            .no-print { display: none !important; }
            
            @page {
                size: landscape;
                margin: 1cm;
            }
            
            body { 
                font-family: "Times New Roman", serif !important;
                font-size: 14px;
                margin: 0;
                padding: 0;
                background-color: white;
            }
            
            .print-container {
                display: flex !important;
                width: 100%;
                height: 100%;
                background-color: white;
            }
            
            .print-column {
                width: 50% !important;
                padding: 20px !important;
                box-sizing: border-box;
                display: flex !important;
                flex-direction: column;
                justify-content: space-between;
                margin: 0 !important;
            }
            
            .print-column + .print-column {
                border-left: 1px solid #000;
            }
            
            .print-title {
                text-align: center !important;
                font-weight: bold !important;
                font-size: 14px !important;
                margin-bottom: 0 !important;
            }
            
            .print-table {
                margin-top: 20px !important;
                width: 100% !important;
                border: none !important;
            }
            
            .print-table td {
                vertical-align: top !important;
                padding: 3px !important;
                border: none !important;
                background: none !important;
            }
            
            .print-footer {
                text-align: right !important;
                font-size: 8px !important;
                margin-top: 40px !important;
            }
            
            .print-ttd {
                text-align: right !important;
            }
            
            .print-ttd p {
                margin: 6px 0 !important;
            }
            
            .print-kode-footer {
                display: flex !important;
                justify-content: space-between !important;
                align-items: flex-end !important;
                font-size: 14px !important;
                margin-top: 40px !important;
            }
            
            .print-paraf {
                display: inline-block !important;
                min-width: 120px !important;
                text-align: center !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-times">
    <!-- Screen View - tampilan normal dengan Tailwind -->
    <div class="max-w-4xl mx-auto p-6 no-print">
        
        <!-- Header dengan tombol aksi -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Kartu Nomor SK</h1>
            <div class="flex gap-3">
                <button 
                    onclick="window.print()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    Cetak
                </button>
                <a href="{{ route('sk.year', ['year' => \Carbon\Carbon::parse($sk->tglsk)->year]) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                    KELUAR
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="border-4 border-black bg-white" id="kartu-sk">
            
            <!-- Header Card -->
            <div class="text-center py-4 border-b-2 border-black">
                <h2 class="text-xl font-bold underline">KARTU NOMOR SK</h2>
            </div>

            <!-- Content Area -->
            <div class="p-6">
                
                <!-- Data Table -->
                <div class="space-y-4">
                    <div class="flex">
                        <div class="w-32 font-medium">KODE SK</div>
                        <div class="w-4">:</div>
                        <div class="flex-1">
                            <input type="text" 
                                   id="kodesk-input"
                                   value="{{ old('kodesk', $sk->kodesk ?? 'SK' . str_pad($sk->nosk, 4, '0', STR_PAD_LEFT)) }}" 
                                   class="w-full px-3 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                                   onchange="updateKodeSK(this.value)">
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-medium">NOMOR SK</div>
                        <div class="w-4">:</div>
                        <div class="flex-1">
                            <div class="bg-yellow-300 px-3 py-2 font-medium rounded">
                                {{ $sk->nosk }}
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-medium">TANGGAL SK</div>
                        <div class="w-4">:</div>
                        <div class="flex-1">
                            <div class="bg-yellow-300 px-3 py-2 font-medium rounded">
                                {{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-medium">JUDUL SK</div>
                        <div class="w-4">:</div>
                        <div class="flex-1">
                            <div class="bg-yellow-300 px-3 py-2 font-medium rounded">
                                {{ $sk->judulsk }}
                            </div>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="w-32 font-medium">OPD/DINAS</div>
                        <div class="w-4">:</div>
                        <div class="flex-1">
                            <div class="bg-yellow-300 px-3 py-2 font-medium rounded">
                                {{ $sk->opd->namaopd ?? 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer dengan Kode SK dan Tanggal -->
                <div class="flex justify-between items-end mt-8 pt-4">
                    <div class="bg-yellow-300 px-3 py-2 font-bold rounded" id="footer-kodesk">
                        {{ old('kodesk', $sk->kodesk ?? 'SK' . str_pad($sk->nosk, 4, '0', STR_PAD_LEFT)) }}
                    </div>
                    <div class="bg-yellow-300 px-3 py-2 font-bold rounded">
                        {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Print Layout - hanya muncul saat print -->
    <div class="print-container print-only">
        <!-- Kolom Kiri -->
        <div class="print-column">
            <div>
                <div class="print-title">
                    KARTU NOMOR <br>
                    KEPUTUSAN BUPATI PURWOREJO
                </div>
                <table class="print-table">
                    <tr>
                        <td width="120">NOMOR SK</td>
                        <td width="10">:</td>
                        <td>{{ $sk->nosk }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL SK</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>JUDUL SK</td>
                        <td>:</td>
                        <td>{{ $sk->judulsk }}</td>
                    </tr>
                    <tr>
                        <td>DINAS/OPD</td>
                        <td>:</td>
                        <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <div class="print-footer">
                Lembar untuk OPD Pemrakarsa
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="print-column">
            <div>
                <div class="print-title">
                    KARTU NOMOR <br>
                    KEPUTUSAN BUPATI PURWOREJO
                </div>
                <table class="print-table">
                    <tr>
                        <td width="120">NOMOR SK</td>
                        <td width="10">:</td>
                        <td>{{ $sk->nosk }}</td>
                    </tr>
                    <tr>
                        <td>TANGGAL SK</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($sk->tglsk)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>JUDUL SK</td>
                        <td>:</td>
                        <td>{{ $sk->judulsk }}</td>
                    </tr>
                    <tr>
                        <td>DINAS/OPD</td>
                        <td>:</td>
                        <td>{{ $sk->opd->namaopd ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="print-ttd">
                    <p>TANDA TERIMA AMBIL</p>
                    <p>TANGGAL</p>
                    <br><br>
                    <p>(<span class="print-paraf"></span>)</p>
                </div>
            </div>

            <div class="print-kode-footer">
                <span id="print-kodesk">{{ old('kodesk', $sk->kodesk ?? 'SK' . str_pad($sk->nosk, 4, '0', STR_PAD_LEFT)) }}/{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                <span class="print-footer">Lembar untuk Bagian Hukum</span>
            </div>
        </div>
    </div>

    <script>
        function updateKodeSK(value) {
            // Update footer kodesk di layar
            document.getElementById('footer-kodesk').textContent = value;
            // Update kodesk di print layout
            document.getElementById('print-kodesk').textContent = value + '/{{ \Carbon\Carbon::now()->format('d-m-Y') }}';
        }

        // Set initial values
        document.addEventListener('DOMContentLoaded', function() {
            const kodeskInput = document.getElementById('kodesk-input');
            updateKodeSK(kodeskInput.value);
        });
    </script>
</body>
</html>