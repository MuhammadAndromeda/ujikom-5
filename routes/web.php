<?php

use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/report', function () {
    $search = request('search');
    
    $sales = Sales::when($search, function ($query, $search) {
        return $query->where('customer', 'like', '%' . $search . '%');
    })->paginate(5);

    return view('report', [
        'title' => 'Sales Report',
        'sales' => $sales,
        'search' => $search
    ]);
});

Route::get('/receipt', function () {
    $sale = Sales::findOrFail(request('id'));
    return view('receipt', ['title' => 'Payment Receipt', 'sale' => $sale]);
});

Route::get('/receipt/download', function () {
    $sale = Sales::findOrFail(request('id'));
    
    $pdf = Pdf::loadView('receipt-pdf', ['sale' => $sale]);
    
    return $pdf->download('receipt-' . $sale->customer . '.pdf');
});