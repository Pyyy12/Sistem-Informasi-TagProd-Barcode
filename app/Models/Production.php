<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_name',
        'batch_number',
        'production_date',
        'operator_name',
        'quantity',
    ];

    /**
     * Helper untuk generate format barcode yang konsisten
     * Misal: Gabungan item_code dan batch_number
     */
    public function getFullBarcodeAttribute()
    {
        return $this->item_code . '-' . $this->batch_number;
    }
}