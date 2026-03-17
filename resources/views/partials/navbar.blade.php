<nav class="w-full h-max fixed top-0 py-6 bg-gray-800 text-white flex justify-center items-center">
    <div class="w-full px-20 flex justify-between items-center lg:visible invisible lg:relative absolute">
        <a href="/" class="w-max gap-3 flex justify-start items-center">
            <img src="{{ asset('images/sumberpasirjaya.jpeg') }}" alt="Logo" class="w-10 h-auto rounded">
            <span class="text-2xl text-left font-medium text-white capitalize">CV. Sumber Pasir Jaya</span>
        </a>
        <div class="w-max h-auto gap-4 flex justify-end items-center">
            <a href="dashboard" class="py-2 px-6 rounded-lg bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 text-base text-white font-medium capitalize tracking-wide transition-all">Dashboard</a>
        </div>
    </div>

    <div class="w-full px-5 lg:absolute relative lg:invisible visible flex justify-end items-center">
        <button onclick="openSidebar()" class="py-2 px-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white text-2xl text-center">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <aside id="sidebar" class="w-80 h-screen p-5 bg-white/60 backdrop-blur-sm shadow-md shadow-black/60 fixed top-0 right-0 gap-10 flex flex-col justify-start items-start z-20 translate-x-full transition-all duration-300">
        <header class="w-full flex justify-between items-center">
            <button onclick="closeSidebar()" class=" text-gray-800 text-2xl text-center">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <a href="/" class="w-max gap-2 flex justify-start items-center">
                <img src="{{ asset('images/sumberpasirjaya.jpeg') }}" alt="Logo" class="w-12 h-auto rounded-xl">
            </a>
        </header>

        <div class="w-full gap-4 flex flex-col justify-center items-center">
            <a href="/dashboard" class="w-full flex items-center justify-center py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700" role="button">
                <i class="fa-solid fa-save mr-3"></i>
                Access Dashboard
            </a>
            <a href="/report" class="w-full flex items-center justify-center py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:bg-blue-700" role="button">
                <i class="fa-solid fa-bookmark mr-3"></i>
                See Report
            </a>
        </div>
    </aside>
</nav>