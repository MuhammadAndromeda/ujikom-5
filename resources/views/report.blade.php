@extends('layouts.main')
@section('content')
    <section class="w-full px-15 pt-30 h-screen bg-gray-100 gap-6 flex flex-col justify-start items-center">
        <form action="/report" method="get" class="w-full gap-8 flex justify-center items-center">
            <input type="text" value="{{ request('search') }}" name="search" id="search" class="w-120 py-2 px-3 bg-white border-2 border-gray-600/60 focus:border-blue-400 rounded-sm text-gray-800 text-base text-left font-medium tracking-wide focus:ring-0 focus:outline-0 focus:shadow-md focus:shadow-blue-400 transition-all duration-300" placeholder="Search by Name">

            <button type="submit" class="py-2 px-6 rounded-lg bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 text-base text-white font-medium capitalize tracking-wide cursor-pointer transition-all">Search</button>
        </form>
        <table class="w-full h-auto border-2 border-gray-800 shadow-lg shadow-black/60">
            <thead class="w-full h-auto border-2 border-gray-800">
                <tr class="w-full h-auto border-2 border-gray-800">
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">ID</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Nama Customer</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Nama Material</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Tanggal</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Quantity (M<sup>3</sup>)</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Pendapatan</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Dibayar</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Status Pembayaran</th>
                    <th class="w-max py-3 px-4 h-auto border-2 border-gray-800 bg-blue-600 capitalize tracking-wide text-center text-base text-white font-bold">Nota</th>
                </tr>
            </thead>
            <tbody class="w-full h-auto border-2 border-gray-800">
                @if ($sales->isEmpty())
                    <tr class="w-full h-auto border-2 border-gray-800">
                        <td colspan="10" class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-xl text-gray-800 font-bold">No Sales Data</td>
                    </tr>
                @else
                    @foreach($sales as $i => $baris)
                        <tr class="w-full h-auto border-2 border-gray-800">
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-bold">{{ $i + 1 }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">{{ $baris->customer }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">{{ $baris->material }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">{{ $baris->created_at->format('d M Y') }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">{{ $baris->quantity }} M<sup>3</sup></td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">IDR {{ number_format($baris->price, 0, ',', '.') }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">IDR {{ number_format($baris->paid, 0, ',', '.') }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">{{ $baris->payment_status }}</td>
                            <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">
                                <a href="/receipt?id={{ $baris->id }}">
                                    <button type="button" class="py-2 px-5 rounded-lg bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 text-sm text-white font-medium capitalize tracking-wide cursor-pointer transition-all">Receipt</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <footer class="w-full flex justify-center items-center absolute bottom-20">
            {{ $sales->appends(['search' => request('search')])->links() }}
        </footer>
    </section>
@endsection