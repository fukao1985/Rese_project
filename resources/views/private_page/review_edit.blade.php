<x-app-layout>

@if(session()->has('script'))
    {!! session('script') !!}
@endif

{{-- headerに入る部分 --}}
<x-slot name="header">
    <div id="container" class="min-w-screen bg-gray-100">
        <header id="header_container" class="flex justify-center">
            <div class="w-11/12 flex items-center mb-10 mt-4">
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
        </header>
</x-slot>
{{-- mainに入る部分 --}}
        <main id="main_container" class="flex justify-center">
            <div class="w-11/12 flex flex-col justify-center md:flex-row md:justify-between">
                {{-- 店舗詳細 --}}
                <div class="w-full md:w-5/12">
                    <div class="w-full text-center mt-10 mb-20">
                        <h2 class="text-3xl">今回のご利用は<br>いかがでしたか？</h2>
                    </div>
                    <div id="store_box" class="w-full md:w-10/12 md:mx-auto bg-white shadow-md mb-5 rounded">
                        <img src="{{ asset($selectShop->url) }}" alt="{{ $selectShop->name }}" class="rounded-t">
                        <h2 class="text-lg font-semibold mt-4 px-4">{{ $selectShop->name }}</h2>
                        <div class="flex text-sm md:font-base">
                            <p class="text-gray-600 mb-2 pl-4">#{{ $selectShop->area->area }}</p>
                            <p class="text-gray-600 mb-2 pl-2">#{{ $selectShop->genre->genre }}</p>
                        </div>
                        <div class="flex justify-between items-center p-4">
                            <form action="{{ route('shop.detail', $selectShop->id) }}" method="GET">
                            @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm md:font-base">詳しく見る</button>
                            </form>

                            {{-- お気に入り登録/削除ボタン --}}
                            @if ($isFavorite)
                                <div class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                    </svg>
                                </div>
                            @else
                                <div class="text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 口コミ更新フォーム --}}
                <div class="w-full md:w-6/12">
                    <form id="review_create_form" action="{{ route('update.review', $review->id) }}" method="POST" class="w-full" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                        <div class="bg-blue-300 h-auto w-full rounded-t shadow-md shadow-gray-400 p-8 flex flex-col items-left">
                            <div class="flex flex-col mb-5">

                                <!-- ShopId -->
                                <input type="hidden" name="shop_id" value="{{ $selectShop->id }}">

                                <!-- UserName -->
                                <input id="user_name" type="user_name" name="user_name" value="{{ $review->user_name }}" class="h-10 rounded-md w-10/12 mb-14 pl-2">
                                @error('user_name')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror


                                <!-- Rating -->
                                <div class="mb-2">
                                    <p class="text-white text-xl font-bold">体験を評価してください</p>
                                </div>
                                <div class="felx items-center mb-10">
                                    <input type="hidden" id="ranting" name="ranting" value="">
                                    <span class="rating-star cursor-pointer text-4xl text-gray-300 z-10" data-value="1">★</span>
                                    <span class="rating-star cursor-pointer text-4xl text-gray-300 z-10" data-value="2">★</span>
                                    <span class="rating-star cursor-pointer text-4xl text-gray-300 z-10" data-value="3">★</span>
                                    <span class="rating-star cursor-pointer text-4xl text-gray-300 z-10" data-value="4">★</span>
                                    <span class="rating-star cursor-pointer text-4xl text-gray-300 z-10" data-value="5">★</span>
                                </div>
                                @error('ranting')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror

                                <!-- Comment -->
                                <div class="mb-2">
                                    <p class="text-white text-xl font-bold">口コミを投稿</p>
                                </div>
                                <textarea name="comment" id="comment" rows="8" class="w-full h-auto bg-white text-start p-2 border-none resize-none rounded-md outline-none" placeholder="(例) カジュアルな夜のお出かけにおすすめのスポット">{{ $review->comment }}</textarea>
                                <div id="charCount" class="text-right text-gray-800 text-sm mb-10">0/400 (最高文字数)</div>
                                @error('comment')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror

                                <!-- Image File -->
                                <div class="mb-2">
                                    <p class="text-white text-xl font-bold">画像の追加</p>
                                </div>
                                <div id="drop_area" class="w-full bg-white h-auto hover:bg-blue-500 cursor-pointer rounded-lg p-6">
                                    <div class="flex flex-col my-10 text-gray-800">
                                        <label for="review_image" class="mx-auto ">クリックして写真を追加</label>
                                        <p class="text-sm mx-auto">またはドラッグアンドドロップ</p>
                                    </div>
                                    <input type="file" id="review_image" name="review_image" accept="image/*" class="hidden">
                                    <img id="uploaded_image" src="#" alt="Uploaded Image" class="hidden">
                                </div>
                                @error('file')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 font-semibold text-white mb-10 p-4 rounded-b">口コミを更新する</button>
                    </form>
                </div>
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
            <script src="{{ asset('js/confirm_script.js') }}" defer></script>
            <script src="{{ asset('js/review_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

