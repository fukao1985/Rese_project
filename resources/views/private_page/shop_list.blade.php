<x-app-layout>

<!-- Session Status -->
@if (session('status'))
<x-auth-session-status class="mb-4" :status="session('status')" />
@endif

@if(session()->has('script'))
    {!! session('script') !!}
@endif

{{-- headerに入る部分 --}}
<x-slot name="header">
    <div id="container" class="min-w-screen bg-gray-100">
        <header id="header_container" class="flex justify-center">
            <div class="w-11/12 flex flex-col md:flex-row justify-center md:justify-between mb-10 mt-4">
                <div id="logo" class="flex items-center mb-6 md:mb-3">
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
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('user.top') }}">Home</a></li>
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
                <form id="search_form" action="{{ route('guest.shop_list') }}" method="POST" class="md:w-1/2 bg-white shadow-md rounded md:flex items-center">
                @csrf
                    <!-- Arear セレクトボックス-->
                    <div class="mr-4 ml-4">
                        <select name="area_id" id="area_id" class="text-gray-700 border-none" >
                            <option value="">All area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-white md:text-gray-200">|</div>

                    <!-- Genre セレクトボックス-->
                    <div class="mr-4 ml-4">
                        <select name="genre_id" id="genre_id" class="text-gray-700 border-none">
                            <option value="">All genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-white md:text-gray-200">|</div>

                    <!-- Search wind -->
                    <div class="flex justify-left items-center mr-8 ml-8">
                        <button type="submit" name="action" value="POST">
                        <i class="text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </i>
                        </button>
                        <input id="name" type="name" name="name" placeholder="Search..." class="focus:outline-none text-gray-500 w-8/12 p-1 border-none" value="{{ old('name') }}" autocomplete="off"/>
                    </div>
                </form>
            </div>
        </header>
</x-slot>

{{-- mainに入る部分 --}}
        <main id="main_container" class="flex justify-center">
            <div class="w-11/12 flex justify-center">
                <div class="w-full grid grid-cols-1 md:grid-cols-4 md:gap-4">
                    @foreach ($shops as $shop)
                    <div id="store_box" class="bg-white shadow-md mb-5 rounded">
                        <img src="{{ asset($shop->url) }}" alt="{{ $shop->name }}" class="rounded-t">
                        <h2 class="text-lg font-semibold mt-4 px-4">{{ $shop->name }}</h2>
                        <div class="flex text-sm md:font-base">
                            <p class="text-gray-600 mb-2 pl-4">#{{ $shop->area->area }}</p>
                            <p class="text-gray-600 mb-2 pl-2">#{{ $shop->genre->genre }}</p>
                        </div>
                        <div class="flex justify-between items-center p-4">
                            <form action="{{ route('shop.detail', $shop->id) }}" method="GET">
                            @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm md:font-base">詳しく見る</button>
                            </form>

                            {{-- お気に入り登録/削除ボタン --}}
                            @if ($isFavorite[$shop->id])
                                <form action="{{ route('favorite.remove', ['favorite_id' => $isFavorite[$shop->id], 'shop_id' => $shop->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('favorite.add') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <button type="submit" class="text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

