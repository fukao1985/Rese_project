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
                <h1 class="font-bold text-xl text-center mb-10">予約詳細</h1>
                {{-- <div class="w-full flex flex-col md:flex-row md:justify-between"> --}}

                    {{-- 予約状況 --}}
                    <div id="reservation" class="w-full md:w-2/5 flex justify-center mx-auto">
                        <div class="bg-blue-600 w-full rounded p-6 mb-3 shadow-md">
                            <table class="text-white text-left h-auto w-full">
                                <tr class="mb-8">
                                    <th class="w-2/6">Name</th>
                                    <td class="w-4/6">{{ $reservation->user->name }}</td>
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
                                <tr class="mb-8">
                                    <th class="w-2/6">Email</th>
                                    <td class="w-4/6">{{ $reservation->user->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

