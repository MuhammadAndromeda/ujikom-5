<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded = ['id'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($sale) {
            $sale->invoice_number = self::generateInvoiceNumber();
        });
    }

    private static function generateInvoiceNumber(): string {
        $date = now()->format('Ymd');
        $last = self::whereDate('created_at', today())->count() + 1;
        $sequence = str_pad($last, 3, '0', STR_PAD_LEFT);
        
        return "INV-{$date}-{$sequence}";
    }
}
