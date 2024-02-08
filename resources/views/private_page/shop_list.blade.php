<x-app-layout>

{{-- headerに入る部分 --}}
<x-slot name="header">
    <div id="container" class="min-w-screen bg-gray-100">
        <header id="header_container" class="flex justify-center">
            <div class="w-11/12 flex justify-between mb-10 mt-4">
                <div id="logo" class="flex items-center">
                    <button id="button" type="button" class="bg-blue-600 rounded p-1.5 text-white m-2 shadow-md shadow-gray-700 z-20">
                        <i id="bars">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                            </svg>
                        </i>
                        <i id="xmark" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </i>
                    </button>
                    <div id="menu" class="bg-white fixed top-0 left-0 z-10 w-full h-full text-blue-600 font-bold flex items-center justify-center translate-x-full transition-all ease-linear">
                        <ul>
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('private.shop_list') }}">Home</a></li>
                            <li class="p-2 text-2xl font-bold">
                                <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="border-none">Logout</button>
                                </form>
                            </li>
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('my_page') }}">Mypage</a></li>
                        </ul>
                    </div>
                    <h1 class="text-3xl text-blue-600 font-black m-2">Rese</h1>
                </div>
                <div id="search_box" class="bg-white w-1/2 shadow-md shadow-gray-400 flex rounded items-center">
                    @php
                        $areas = session()->has('areas') ? session('areas') : [];
                        $genres = session()->has('genres') ? session('genres') : [];
                        $shops = session()->has('shops') ? session('shops') : [];
                    @endphp
                    <!-- Arear セレクトボックス-->
                        <div class="mr-4 ml-4">
                            <select name="area_id" id="area_id" class="text-gray-700 border-none" required>
                                <option value="">All area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-gray-200">|</div>

                        <!-- Genre セレクトボックス-->
                        <div class="mr-4 ml-4">
                            <select name="genre_id" id="genre_id" class="text-gray-700 border-none" required>
                                <option value="">All genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-gray-200">|</div>

                        <!-- Search wind -->
                        <div class="flex justify-left items-center mr-8 ml-8">
                            <i class="text-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </i>
                            <input id="name" type="name" name="name" placeholder="Search..." class="focus:outline-none text-gray-500 w-8/12 p-1 border-none" />
                        </div>
                        <div class="flex justify-center">
                            <div class="border-b border-gray-500 mb-1 mr-8 ml-auto w-7/12"></div>
                        </div>
                </div>
            </div>
        </header>
</x-slot>
{{-- mainに入る部分 --}}
        <main id="main_container" class="flex justify-center">
            <div class="w-11/12 flex justify-center">
                <div class="w-full grid grid-cols-4 gap-4">
                    @foreach ($shops as $shop)
                    <div id="store_box" class="bg-white p-4 shadow-md">
                        {{-- <a href="{{ route('shop.detail', ['id' => 1]) }}"> --}}
                        <a href="{{ route('shop.detail', $shop->id) }}">
                            <img src="" alt="">
                            <h2 class="text-lg font-semibold">{{ $shop->name }}</h2>
                            <p class="text-gray-600 mb-2">{{ $shop->area->area }}</p>
                            <p class="text-gray-600 mb-2">{{ $shop->genre->genre }}</p>
                        </a>
                    </div>
                        <option value="{{ $shop->id }}">{{ $genre->genre }}</option>
                    @endforeach
                    
                </div>
                {{-- <div class="bg-white h-auto w-1/3 rounded shadow-md shadow-gray-400 p-8 flex flex-col items-center">
                    <p class="text-xl mt-10 mb-4">ログインユーザーのトップページ</p>
                    <button type="button" class="bg-blue-600 text-white mb-10 mt-4 px-4 py-2 rounded">ログインする</button>
                </div> --}}
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

