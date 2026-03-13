@extends('layouts.main')
@section('content')
    <section class="w-full px-15 pt-30 h-screen bg-gray-100 gap-6 flex flex-col justify-start items-center">
        <header class="w-full flex justify-between items-center">
            <div class="gap-6 flex justify-center items-center">
                <form action="/report" method="get" class="gap-3 flex justify-center items-center">
                    <input type="text" value="{{ request('search') }}" name="search" class="w-60 py-2 px-3 bg-white border-2 border-gray-600/60 focus:border-blue-400 rounded-sm text-gray-800 text-base font-medium focus:ring-0 focus:outline-0 transition-all" placeholder="Search by Name">
                    <button type="submit" class="py-2 px-4 rounded-lg bg-blue-600 hover:bg-blue-700 text-base text-white font-medium capitalize cursor-pointer transition-all">Search</button>
                </form>

                <form action="/report" method="get" class="gap-3 flex justify-center items-center">
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="py-2 px-3 bg-white border-2 border-gray-600/60 rounded-sm text-gray-800 text-base font-medium focus:ring-0 focus:outline-0 transition-all">
                    <span class="text-gray-800 font-medium">s/d</span>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="py-2 px-3 bg-white border-2 border-gray-600/60 rounded-sm text-gray-800 text-base font-medium focus:ring-0 focus:outline-0 transition-all">
                    <button type="submit" class="py-2 px-4 rounded-lg bg-blue-600 hover:bg-blue-700 text-base text-white font-medium capitalize cursor-pointer transition-all">Filter</button>
                    @if(request('start_date') || request('end_date'))
                        <a href="/report" class="py-2 px-4 rounded-lg bg-gray-400 hover:bg-gray-500 text-base text-white font-medium capitalize cursor-pointer transition-all">Reset</a>
                    @endif
                </form>
            </div>

            <div class="gap-3 flex justify-center items-center">
                <a href="/export-excel?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}">
                    <button type="button" class="py-3 px-6 rounded-lg bg-blue-600 hover:bg-blue-700 text-base text-white font-medium capitalize cursor-pointer transition-all">Download Excel</button>
                </a>
            </div>
        </header>
        
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
                            @if ($baris->payment_status == 'unpaid' || $baris->payment_status == 'debt')
                                <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-500 font-medium">
                                    {{ $baris->payment_status }}
                                </td>
                            @else
                                <td class="w-max py-3 px-4 h-auto border-2 border-gray-800 capitalize text-center text-sm text-gray-800 font-medium">
                                    <a href="/receipt?id={{ $baris->id }}">
                                        <button type="button" class="py-2 px-5 rounded-lg bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 text-sm text-white font-medium capitalize tracking-wide cursor-pointer transition-all">Receipt</button>
                                    </a>
                                </td>
                            @endif
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