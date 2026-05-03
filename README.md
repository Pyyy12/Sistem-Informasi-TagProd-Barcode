# Laravel 11 Production Barcode System 🏭

Sistem manajemen produksi sederhana yang dibangun dengan **Laravel 11** untuk men-generate barcode produk, mencetak label produksi (tags) dalam format PDF profesional, dan dilengkapi dengan fitur **Real-time Barcode Scanner** menggunakan kamera.

## 🚀 Fitur Utama

- **Manajemen Data Produksi**: Input data barang, nomor batch, dan operator.
- **Generator Barcode C128**: Menghasilkan barcode 1D standar industri yang panjang dan presisi.
- **Cetak Tag PDF**: Layout label siap cetak dengan ukuran presisi (10cm x 15cm).
- **Scanner Kamera**: Fitur scan barcode langsung dari browser untuk mencari data secara cepat.
- **UI Modern**: Menggunakan Tailwind CSS untuk tampilan yang bersih dan responsif.

## 🛠️ Tech Stack

- **Framework**: [Laravel 11](https://laravel.com)
- **PDF Engine**: [dompdf/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- **Barcode Engine**: [milon/barcode](https://github.com/milon/barcode)
- **Scanner Library**: [html5-qrcode](https://github.com/mebjas/html5-qrcode)
- **Styling**: Tailwind CSS

## 📋 Prasyarat

- PHP >= 8.2
- Composer
- MySQL atau PostgreSQL
- Extension PHP: `gd`, `mbstring`, `xml`

## 🔧 Instalasi

1. **Clone Repository**
   ```bash
   git clone [https://github.com/username/nama-repo.git](https://github.com/username/nama-repo.git)
   cd nama-repo
