<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Monitoring & Barcode Scanner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Library QR/Barcode Scanner -->
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body class="bg-slate-50 p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Notifikasi Sukses/Error -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Sistem Produksi</h1>
                <p class="text-slate-500 text-sm">Kelola item dan cetak barcode tags secara otomatis.</p>
            </div>
            
            <div class="flex gap-2">
                <!-- Tombol Buka Scanner -->
                <button onclick="toggleScanner()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition flex items-center gap-2">
                    📷 Scan Barcode
                </button>
                <a href="{{ route('productions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    + Tambah Produksi
                </a>
            </div>
        </div>

        <!-- Section Scanner (Hidden by Default) -->
        <div id="scanner-container" class="hidden mb-8 bg-white p-6 rounded-xl shadow-md border border-indigo-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-slate-700">Arahkan Kamera ke Barcode</h2>
                <button onclick="toggleScanner()" class="text-red-500 hover:text-red-700 font-bold">Tutup X</button>
            </div>
            <div id="reader" class="overflow-hidden rounded-lg bg-slate-100 mx-auto" style="max-width: 500px;"></div>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-100 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-700">Item Code</th>
                        <th class="px-6 py-4 font-semibold text-slate-700">Nama Barang</th>
                        <th class="px-6 py-4 font-semibold text-slate-700">Batch</th>
                        <th class="px-6 py-4 font-semibold text-slate-700">Qty</th>
                        <th class="px-6 py-4 font-semibold text-slate-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($productions as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded font-mono text-xs border border-slate-300">
                                {{ $item->item_code }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-800 font-medium">{{ $item->item_name }}</td>
                        <td class="px-6 py-4 text-slate-600 italic">{{ $item->batch_number }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $item->quantity }} Unit</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('productions.pdf', $item->id) }}" target="_blank" 
                               class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-md text-sm font-medium transition shadow-sm">
                                🖨️ Print Tag
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400">Belum ada data produksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let html5QrCode;
        const scannerContainer = document.getElementById('scanner-container');

        function toggleScanner() {
            if (scannerContainer.classList.contains('hidden')) {
                scannerContainer.classList.remove('hidden');
                startScanner();
            } else {
                stopScanner();
                scannerContainer.classList.add('hidden');
            }
        }

        function startScanner() {
            html5QrCode = new Html5Qrcode("reader");
            const config = { fps: 10, qrbox: { width: 300, height: 150 } };

            html5QrCode.start(
                { facingMode: "environment" }, 
                config, 
                (decodedText) => {
                    // Jika scan berhasil
                    stopScanner();
                    // Mengarahkan ke route pencarian berdasarkan item_code yang terdeteksi
                    window.location.href = `/productions/search/${decodedText}`;
                }
            ).catch(err => {
                console.error("Gagal start scanner:", err);
            });
        }

        function stopScanner() {
            if (html5QrCode) {
                html5QrCode.stop().catch(err => console.error(err));
            }
        }
    </script>
</body>
</html>