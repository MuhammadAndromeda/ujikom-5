<!DOCTYPE html>
<html>
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <main class="w-full flex flex-col justify-start items-center">
        <section class="w-full h-screen py-5 px-3 flex justify-center items-center">
            <div class="w-100 h-full py-6 px-7 rounded-2xl shadow-sm shadow-black/40 flex flex-col justify-start items-center">
                <header class="w-full h-auto gap-1 flex flex-col justify-center items-center">
                    <h1 class="text-gray-800 text-xl text-center font-bold capitalize tracking-wide">CV. Sumber Pasir Jaya</h1>
                    <p class="text-gray-600 text-xs text-center font-medium tracking-wide">Jl. Raya Jonggol-Dayeuh, Sukanegara, Kec. Jonggol, Kabupaten Bogor, Jawa Barat 16830</p>
                    <p class="text-gray-600 text-xs text-center font-normal tracking-wide">No telp: 0822-1010-2006</p>
                </header>

                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <div>
                    <h1 class="text-gray-800 text-xl text-center font-bold capitalize tracking-wide">{{ $sale->invoice_number }}</h1>
                </div>

                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <div class="w-full gap-1 flex flex-col justify-between items-center">
                    <div class="w-full flex justify-between items-center">
                        <h1 class="text-gray-800 text-sm md:text-base text-left font-bold capitalize tracking-wide">Nama Customer:</h1>
                        <p class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide">{{ $sale->customer }}</p>
                    </div>
                    <div class="w-full flex justify-between items-center">
                        <h1 class="text-gray-800 text-sm md:text-base text-left font-bold capitalize tracking-wide">Tanggal:</h1>
                        <p class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide">{{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y') }}</p>
                    </div>
                </div>

                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <table class="w-full">
                    <thead>
                        <tr>
                            <td class="text-gray-800 text-sm md:text-base text-left font-bold capitalize tracking-wide">Material:</td>
                            <td class="text-gray-800 text-sm md:text-base text-center font-bold capitalize tracking-wide" style="text-align: center;">Quantity:</td>
                            <td class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide" style="text-align: right;">Harga:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-gray-600 text-sm text-left font-medium capitalize tracking-wide">{{ $sale->material }}</td>
                            <td class="text-gray-600 text-sm text-center font-medium capitalize tracking-wide" style="text-align: center;">{{ $sale->quantity }} M<sup>3</sup></td>
                            <td class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide" style="text-align: right;">IDR {{ number_format($sale->price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <div class="w-full gap-1 flex flex-col justify-center items-end">
                    <div class="w-full flex justify-between items-center">
                        <h1 class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide">Total:</h1>
                        <p class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide">IDR {{ number_format($sale->quantity * $sale->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-full flex justify-between items-center">
                        <h1 class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide">Dibayarkan:</h1>
                        <p class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide">IDR {{ number_format($sale->paid, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-full flex justify-between items-center">
                        <h1 class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide">Kembalian:</h1>
                        <p class="text-gray-600 text-sm text-right font-medium capitalize tracking-wide">IDR {{ number_format($sale->paid - ($sale->quantity * $sale->price), 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <div class="w-full flex justify-between items-center">
                    <h1 class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide">Status Pembayaran:</h1>
                    <h1 class="text-gray-800 text-sm md:text-base text-right font-bold capitalize tracking-wide">{{ $sale->payment_status }}</h1>
                </div>

                <span class="w-full my-4 border-t-2 border-t-gray-800 border-dashed"></span>

                <footer class="mt-2 text-gray-800 text-xl text-center font-bold capitalize tracking-wide">Thank you for using <br>our service</footer>
            </div>
        </section>
    
        <section class="w-full pb-4 flex justify-center items-center">
            <a href="/receipt/download?id={{ request('id') }}">
                <button type="button" class="py-3 px-12 rounded-lg bg-green-600 hover:bg-green-700 text-2xl text-white font-medium capitalize tracking-wide cursor-pointer transition-all">
                    Download PDF
                </button>
            </a>
        </section>
    </main>
</body>
</html>