<?php

namespace App\Models;
// Tambah di bagian use / import atas
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public static function getSalesSummary()
    {
        return DB::table('sales')->select(
            'material',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(price) as total_revenue')
        )->groupBy('material')->get();
    }
}