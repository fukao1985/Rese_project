<x-app-layout>

<!-- Session Status -->
@if(session()->has('script'))
    {!! session('script') !!}
@endif

    {{-- headerに入る部分 --}}
<x-slot name="header">
    <div id="container" class="min-w-screen bg-gray-100">
        <header id="header_container" class="w-full flex justify-center">
            <div id=header-items class="w-11/12 flex flex-col justify-center md:flex-row md:justify-between items-center mb-10 mt-4">
                <div id="header-left" class="w-full md:w-1/3 flex justify-center md:justify-start items-center mb-10 mt-4">
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
                <div id="header-right" class="w-full md:w-2/3 flex justify-center">
                    <div class="w-full flex flex-row justify-center text-blue-600 font-bold">
                        <ul class="w-9/12 md:w-full flex justify-center md:justify-end">
                            <li><a href="{{ route('management.top') }}">Representative Create</a></li>
                            <li class="ml-10"><a href="{{ route('csv.file') }}">Shop Create</a></li>
                            <li class="ml-10"><a href="{{ route('send.form') }}">Send Notification</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
</x-slot>

{{-- mainに入る部分 --}}
        <main id="main_container" class="flex justify-center">
            <div class="w-11/12 flex justify-center">
                <div class="bg-white h-auto w-2/3 rounded shadow-md shadow-gray-400 flex flex-col">
                    <div class="w-full h-1/5 bg-blue-600 text-white mb-4 pt-2 p-2 rounded-t-lg flex items-center">
                        <p class="text-l text-white pl-6">Send campaign</p>
                    </div>
                    <form method="POST" action="{{ route('send.notification') }}" novalidate>
                    @csrf
                        <div class="flex flex-col justify-center w-full">
                            <!-- Title -->
                            <div class="w-10/12 flex justify-between items-center mx-auto">
                                <label for="title" :value="__('title')" class="w-2/12 text-gray-500 mr-3">Title</label>
                                <input id="title" type="text" name="title" value="{{ old('title') }}" class="w-11/12 focus:outline-none text-gray-500 border-none" />
                            </div>
                            <div class="w-10/12 flex justify-center mx-auto">
                                <div class="border-b border-gray-500 mb-1 w-full"></div>
                            </div>
                            @error('title')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- message -->
                            <div class="w-10/12 flex justify-between items-center mx-auto mt-5">
                                <label for="body" :value="__('body')" class="text-gray-500 pr-1">Message</label>
                                <textarea id="body" name="body" cols="80" rows="10" class="focus:outline-none text-gray-500 border-gray-500 text-start w-10/12 h-32 p-1 rounded resize-none">{{ old('body') }}</textarea>
                            </div>
                            @error('body')
                                <div class="text-red-600 text-sm h-4 flex justify-center">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Button -->
                            <div class="w-2/3 m-auto text-right mr-8 ml-auto">
                                <button type="submit" name="send_notification" class="bg-blue-600 w-8/12 text-sm md:fontbase text-white mt-6 mb-4 py-1.5 rounded">メールを送信する</button>
                            </div>
                        </div>
                    </form>
                </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

