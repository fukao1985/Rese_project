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
            <div class="w-11/12 flex justify-between">
                {{-- 店舗詳細 --}}
                <div class="w-5/12">
                    <h2 class="font-bold text-xl mb-2">{{ $selectShop->name }}</h2>
                    <img src="{{ asset($selectShop->url) }}" alt="{{ $selectShop->name }}" class="pb-10">
                    <div class="flex">
                            <p class="text-gray-800 text-sm mb-2">#{{ $selectShop->area->area }}</p>
                            <p class="text-gray-800 text-sm pl-1 mb-2">#{{ $selectShop->genre->genre }}</p>
                    </div>
                    <p class="text-gray-800 text-sm mt-5 mb-2">{{ $selectShop->comment }}</p>
                    {{-- ここにデータベースから取得した評価&ユーザーコメントを入れる --}}
                    <div id="rating"></div>
                </div>

                {{-- 予約フォーム --}}
                <div class="w-6/12">
                    <form id="reservartion-form" action="{{ route('reservation.create') }}" method="POST" class="w-full">
                    @csrf
                        <div class="bg-blue-600 h-auto w-full rounded-t shadow-md shadow-gray-400 p-8 flex flex-col items-left">
                            <p class="text-white text-xl font-bold my-5">予約</p>
                            <div class="flex flex-col mb-5">
                                <input type="hidden" name="shop_id" value="{{ $selectShop->id }}">
                                <input id="date" type="date" name="date" class="rounded w-7/12 mb-3">
                                @error('date')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <select id="time" type="time" name="time" class="rounded w-11/12 mb-3">
                                    <option value="">時間を選択してください</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="18:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="20:30">21:30</option>
                                    <option value="21:00">22:00</option>
                                </select>
                                @error('time')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror
                                <select id="number" type="number" name="number" class="rounded w-11/12 mb-3">
                                    <option value="">人数を選択してください</option>
                                    <option value="1">1人</option>
                                    <option value="2">2人</option>
                                    <option value="3">3人</option>
                                    <option value="4">4人</option>
                                    <option value="5">5人</option>
                                    <option value="6">6人</option>
                                    <option value="7">7人</option>
                                    <option value="8">8人</option>
                                    <option value="9">9人</option>
                                    <option value="10">10人</option>
                                </select>
                                @error('number')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div id="confirm" class="flex flex-col w-full bg-blue-400 rounded p-8 mb-40">
                                <table class="text-white text-left w-full">
                                    <tr class="mb-2">
                                        <th class="w-2/6">Shop</th>
                                        <td class="w-4/6">{{ $selectShop->name }}</td>
                                    </tr>
                                    <tr class="mb-2">
                                        <th class="w-2/6">Date</th>
                                        <td id="displayDate" class="w-4/6"></td>
                                    </tr>
                                    <tr class="mb-2">
                                        <th class="w-2/6">Time</th>
                                        <td id="displayTime" class="w-4/6"></td>
                                    </tr>
                                    <tr class="mb-2">
                                        <th class="w-2/6">Number</th>
                                        <td id="displayNumber" class="w-4/6"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-700 font-semibold text-white mb-10 p-4 rounded-b">予約する</button>
                    </form>
                </div>

                {{-- ここに利用後のお店の場合は評価&ユーザーコメント入力フォーム --}}
                {{-- <div id="ranting-form"></div> --}}
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
            <script src="{{ asset('js/confirm_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

