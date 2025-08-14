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
        @media print {
            .no-print { display: none !important; }
            body { font-family: "Times New Roman", serif !important; }
            .print-container { margin: 0; box-shadow: none; }
        }
    </style>
</head>
<body class="bg-gray-100 font-times">
    <div class="max-w-4xl mx-auto p-6">
        
        <!-- Header dengan tombol aksi -->
        <div class="flex justify-between items-center mb-6 no-print">
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
        <div class="border-4 border-black bg-white print-container" id="kartu-sk">
            
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
                                   class="w-full px-3 py-1 border border-gray-300 rounded focus:outline-none focus:border-blue-500 no-print"
                                   onchange="updateKodeSK(this.value)">
                            <div id="kodesk-display" class="hidden bg-yellow-300 px-3 py-2 font-medium rounded print:block">
                                {{ old('kodesk', $sk->kodesk ?? 'SK' . str_pad($sk->nosk, 4, '0', STR_PAD_LEFT)) }}
                            </div>
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

    <script>
        function updateKodeSK(value) {
            // Update display version untuk print
            document.getElementById('kodesk-display').textContent = value;
            document.getElementById('footer-kodesk').textContent = value;
        }

        // Set initial values
        document.addEventListener('DOMContentLoaded', function() {
            const kodeskInput = document.getElementById('kodesk-input');
            updateKodeSK(kodeskInput.value);
        });

        // Auto-hide input saat print
        window.addEventListener('beforeprint', function() {
            document.getElementById('kodesk-input').style.display = 'none';
            document.getElementById('kodesk-display').style.display = 'block';
        });

        window.addEventListener('afterprint', function() {
            document.getElementById('kodesk-input').style.display = 'block';
            document.getElementById('kodesk-display').style.display = 'none';
        });
    </script>
</body>
</html>