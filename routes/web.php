<?php

use App\Models\Sales;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/report', function () {
    $search = request('search');
    
    $sales = Sales::when($search, function ($query, $search) {
        return $query->where('customer', 'like', '%' . $search . '%');
    })->get();

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