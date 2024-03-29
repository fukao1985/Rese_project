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
        <main id="main_container" class="flex justify-center mx-5">
            <div class="flex flex-col w-11/12 justify-center">
                <h1 class="font-bold text-xl text-center mb-10">{{ Auth::user()->name  }}さん</h1>
                <div class="w-full flex flex-col md:flex-row md:justify-between">

                    {{-- 予約状況 --}}
                    <div id="reservation" class="w-full md:w-2/5">
                        <h2 class="font-semibold mb-5">予約状況</h2>
                        @foreach($reservations as $reservation)
                        <div class="bg-blue-600 w-full rounded p-6 mb-3 shadow-md">
                            <div class="flex justify-between mb-5">
                                <div class="flex">
                                    <i id="clock" class="text-white mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>
                                    </i>
                                    <h3 class="text-white">予約{{ $loop->iteration }}</h3>
                                </div>
                                <div class="flex items-center">
                                    {{-- stripe決済 --}}
                                    <form action="{{route('stripe.charge')}}" method="POST">
                                    @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{ env('STRIPE_KEY') }}"
                                            data-amount="5000"
                                            data-name="お支払い画面"
                                            data-label="お支払いをする"
                                            data-description="現在はデモ画面です"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto"
                                            data-currency ="JPY">
                                        </script>
                                    </form>
                                    <form action="{{ route('reservation.delete', $reservation->id) }}" method="post" class="ml-3">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="text-white">
                                            <i>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <table class="text-white text-left h-auto w-full">
                                <tr class="mb-8">
                                    <th class="w-2/6">Shop</th>
                                    <td class="w-4/6">{{ $reservation->shop->name }}</td>
                                </tr>
                                <tr class="mb-8">
                                    <th class="w-2/6">Date</th>
                                    <td class="w-4/6">{{ $reservation->date }}</td>
                                </tr>
                                <tr class="mb-8">
                                    <th class="w-2/6">Time</th>
                                    <td class="w-4/6">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
                                </tr>
                                <tr class="mb-8">
                                    <th class="w-2/6">Number</th>
                                    <td class="w-4/6">{{ $reservation->number }}</td>
                                </tr>
                            </table>
                            {{-- QRコード表示 --}}
                            <div class="flex justify-center m-3 bg-white rounded">
                                <?php $qrCodeUrl = route('qr_code.generate', ['reservation_id' => $reservation->id]); ?>
                                <img src="{{ $qrCodeUrl }}" alt="QRコード" class="p-4">
                            </div>
                            {{-- 予約変更フォーム --}}
                            <div id="reservation_update-form" class="flex flex-col my-5 mt-8">
                                <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" novalidate>
                                @csrf
                                @method('PUT')
                                    <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">
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
                                    <button type="submit" class="w-full bg-blue-700 font-semibold text-white p-4 rounded-b">予約を変更する</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- お気に入り状況 --}}
                    <div id="farvorites" class="w-full md:w-3/5 md:ml-10">
                        <h2 class="font-semibold mt-10 md:mt-0 md:ml-5 mb-5">お気に入り状況</h2>
                        @if($favorites)
                        <div class="flex text-center md:justify-center">
                            <div class="w-full grid grid-cols-1 md:grid-cols-2">
                            @foreach($favorites as $favorite)
                                <div id="store_box" class="bg-white shadow-md rounded mx-5 mb-3">
                                    <img src="{{ asset($favorite->shop->url) }}" alt="{{ $favorite->shop->name }}" class="rounded-t">
                                    <h2 class="text-lg font-semibold mt-4 px-4">{{ $favorite->shop->name }}</h2>
                                    <div class="flex text-sm md:font-base">
                                        <p class="text-gray-600 mb-2 pl-4">#{{ $favorite->shop->area->area }}</p>
                                        <p class="text-gray-600 mb-2 pl-2">#{{ $favorite->shop->genre->genre }}</p>
                                    </div>
                                    <div class="flex justify-between items-center p-4">
                                        <form action="{{ route('shop.detail', $favorite->shop->id) }}" method="GET">
                                        @csrf
                                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm md:font-base">詳しく見る</button>
                                        </form>
                                        <form action="{{ route('favorite.remove', $favorite->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                                <button type="submit" class="text-red-500" >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

