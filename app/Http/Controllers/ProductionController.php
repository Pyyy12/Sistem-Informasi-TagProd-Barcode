<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\DNS1D;

class ProductionController extends Controller
{
    // Menampilkan daftar produksi
    public function index()
    {
        $productions = Production::latest()->get();
        return view('productions.index', compact('productions'));
    }

    // Form input data produksi baru
    public function create()
    {
        return view('productions.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|unique:productions,item_code',
            'item_name' => 'required|string|max:255',
            'batch_number' => 'required',
            'production_date' => 'required|date',
            'operator_name' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        Production::create($validated);

        return redirect()->route('productions.index')->with('success', 'Data produksi berhasil ditambah.');
    }

    /**
     * Fungsi Tambahan: Mencari data berdasarkan Item Code (untuk Scanner)
     */
    public function searchByCode($code)
    {
        // Mencari item berdasarkan kode barcode yang di-scan
        $production = Production::where('item_code', $code)->first();

        if ($production) {
            // Jika ditemukan, langsung arahkan ke stream PDF
            return $this->downloadTag($production->id);
        }

        // Jika tidak ditemukan, kembali ke index dengan pesan peringatan
        return redirect()->route('productions.index')->with('error', 'Barcode "' . $code . '" tidak terdaftar di sistem.');
    }

    // Fungsi Utama: Generate PDF Barcode Tag
    public function downloadTag($id)
    {
        $production = Production::findOrFail($id);
        
        $data = [
            'title' => 'PRODUCTION TAG',
            'date' => date('d/m/Y'),
            'production' => $production
        ];

        $pdf = Pdf::loadView('productions.pdf_tag', $data);

        // Ukuran kertas custom (283.46 pt = 10cm, 425.20 pt = 15cm)
        $pdf->setPaper([0, 0, 283.46, 425.20], 'portrait');

        return $pdf->stream('Tag-Produksi-' . $production->item_code . '.pdf');
    }
}