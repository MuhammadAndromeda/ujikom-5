@extends('layouts.main')
@section('content')
    {{-- hero --}}
    <section class="w-full h-screen px-10 overflow-hidden bg-gray-900/60 gap-8 flex flex-col justify-center items-center">
        <div class="w-3xl h-auto text-center gap-6 flex flex-col justify-center items-center">
            <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">Sales & Distribution Operational Dashboard System</h2>
            <p class="text-lg text-gray-200 font-medium">Monitor transactions, sales volume, and material delivery status centrally and in real time.</p>
            <div class="w-full gap-4 flex justify-center items-center">
                <a href="/report" class="inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700" role="button">
                    <i class="fa-solid fa-bookmark mr-3"></i>
                    See Report
                </a>
                <a href="/dashboard" class="inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700" role="button">
                    <i class="fa-solid fa-save mr-3"></i>
                    Access Dashboard
                </a>
            </div>
        </div>
    </section>
@endsection