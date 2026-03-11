<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Sales::when($this->startDate, fn($q) => $q->whereDate('created_at', '>=', $this->startDate))
            ->when($this->endDate, fn($q) => $q->whereDate('created_at', '>=', $this->endDate))
            ->get();
    }

    public function headings(): array
    {
        return [
            'No. Invoice',
            'Nama Customer',
            'Material',
            'Quantity (M3)',
            'Rit',
            'Harga',
            'Dibayar',
            'Status Pembayaran',
            'Tanggal',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->invoice_number,
            $sale->customer,
            $sale->material,
            $sale->quantity,
            $sale->rit,
            $sale->price,
            $sale->paid,
            $sale->payment_status,
            $sale->created_at->format('d M Y'),
        ];
    }
}
