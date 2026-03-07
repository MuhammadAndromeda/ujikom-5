<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} Page</title>
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
</head>
<body>
    <main class="w-full">
        <div class="w-full px-15 fixed top-10 flex justify-start items-center">
            <a href="/report" class="text-2xl text-gray-600 text-center capitalize flex justify-center items-center leading-none">
                <i class="fa-solid fa-chevron-left text-4xl mr-3"></i>
                back to report
            </a>
        </div>

        <section class="w-full h-screen py-10 px-3 flex justify-center items-center">
            <div class="w-90 h-full py-4 px-6 bg-white rounded-lg shadow-sm shadow-black gap-5 flex flex-col justify-start items-center">
                <header class="w-full flex flex-col justify-center items-center">
                    <img src="{{ asset('images/sumberpasirjaya.jpeg') }}" alt="" class="w-22 h-auto">
                    <div class="w-full gap-1 flex flex-col justify-center items-center">
                        <h1 class="text-gray-800 text-center text-2xl font-bold capitalize tracking-wide">CV. Sumber Pasir Jaya</h1>
                        <p class="text-gray-600 text-center text-xs font-medium capitalize tracking-wide">Jl. Raya Jonggol-Dayeuh, Sukanegara, Kec. Jonggol, Kabupaten Bogor, Jawa Barat 16830 <br> No telp: 0822-1010-2006</p>
                    </div>
                </header>

                <div class="w-full py-3 border-y-2 border-gray-600 border-dashed gap-6 flex flex-col">
                    <div class="w-full gap-2 flex flex-col justify-center items-center">
                        <header class="w-full gap-4 flex justify-between items-center">
                            <h1 class="text-left text-base text-gray-800 font-bold">Nama Customer:</h1>
                            <h1 class="text-right text-base text-gray-800 font-bold">Tanggal:</h1>
                        </header>

                        <div class="w-full gap-4 flex justify-between items-start">
                            <h1 class="text-left text-sm text-gray-600 font-medium">{{ $sale->customer }}</h1>
                            <h1 class="text-right text-sm text-gray-600 font-medium">{{ $sale->sales_date }}</h1>
                        </div>
                    </div>
                    
                    <div class="w-full gap-2 flex flex-col justify-center items-center">
                        <header class="w-full gap-4 grid grid-cols-3 justify-between items-center">
                            <h1 class="text-left text-base text-gray-800 font-bold">Material:</h1>
                            <h1 class="text-center text-base text-gray-800 font-bold">Quantity:</h1>
                            <h1 class="text-right text-base text-gray-800 font-bold">Harga:</h1>
                        </header>

                        <div class="w-full gap-4 grid grid-cols-3 justify-between items-start">
                            <h1 class="text-left text-sm text-gray-600 font-medium">{{ $sale->material }}</h1>
                            <h1 class="text-center text-sm text-gray-600 font-medium">{{ $sale->quantity }} M<sup>3</sup></h1>
                            <h1 class="text-right text-sm text-gray-600 font-medium">IDR {{ number_format($sale->price, 0, ',', '.') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="w-full pb-6 border-b-2 border-b-gray-600 border-dashed">
                    <div class="w-full gap-4 flex justify-between items-center">
                        <h1 class="text-left text-base text-gray-800 font-bold capitalize">Payment Status:</h1>
                        <h1 class="text-right text-base text-gray-800 font-bold capitalize">{{ $sale->payment_status }}</h1>
                    </div>
                </div>

                <div class="w-full px-10 flex justify-center items-center">
                    <h1 class="text-gray-800 text-2xl text-center font-bold capitalize">Thank you for using our service</h1>
                </div>
            </div>
        </section>
    </main>
</body>
</html>