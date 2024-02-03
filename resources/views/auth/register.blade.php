<x-app-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

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
                        <ul class="">
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('public.shop_list') }}">Home</a></li>
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('register') }}">Registration</a></li>
                            <li class="p-2 text-2xl font-bold"><a href="{{ route('login') }}">Login</a></li>
                        </ul>
                    </div>
                    <h1 class="text-3xl text-blue-600 font-black m-2">Rese</h1>
                </div>
            </header>
    </x-slot>

            {{-- mainに入る部分 --}}
            <main id="main_container" class="flex justify-center">
                <div class="w-11/12 flex justify-center">
                    <div class="bg-white h-80 w-1/3 rounded shadow-md shadow-gray-400 flex flex-col">
                        <div class="w-full h-1/5 bg-blue-600 text-white mb-4 pt-2 p-2 rounded-t-lg flex items-center">
                            <p class="text-l text-white pl-2">Register</p>
                        </div>

                <form method="POST" action="{{ route('register') }}">
                @csrf

                    <div class="flex flex-col justify-center w-full">
                        <!-- Username -->
                        <div class="flex justify-center items-center ml-4">
                            <i class="text-gray-500 pr-2 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                </svg>
                            </i>
                            <label for="name" :value="__('Name')" class="text-gray-500 pr-1">Username</label>
                            <input id="name" type="name" name="name" :value="old('name')" autocomplete="name" class="focus:outline-none text-gray-500 w-7/12 p-1 border-none" />
                        </div>
                        <div class="flex justify-center">
                            <div class="border-b border-gray-500 mb-1 ml-2 w-8/12"></div>
                        </div>
                        @error('name')
                            <div class="text-red-600 text-sm h-4 flex justify-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Email Address -->
                        <div class="flex justify-center items-center mt-5">
                            <i class="text-gray-500 pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 object-botton">
                                    <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                    <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                                </svg>
                            </i>
                            <label for="email" :value="__('Email')" class="text-gray-500 pr-1">Email</label>
                            <input id="email" type="email" name="email" :value="old('email')" autocomplete="username" class="focus:outline-none text-gray-500 w-7/12 p-1 border-none" />
                        </div>
                        <div class="flex justify-center">
                            <div class="border-b border-gray-500 mb-1 ml-2 w-8/12"></div>
                        </div>
                        @error('email')
                            <div class="text-red-600 text-sm h-4 flex justify-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Password -->
                        <div class="flex justify-center items-center ml-4 mt-5">
                            <i class="text-gray-500 pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                </svg>
                            </i>
                            <label for="password" :value="__('Password')" class="text-gray-500 pr-1">Password</label>
                            <input id="password" type="password" name="password" autocomplete="new-password" class="focus:outline-none text-gray-500 w-7/12 p-1 border-none" />
                        </div>
                        <div class="flex justify-center">
                            <div class="border-b border-gray-500 mb-1 ml-2 w-8/12"></div>
                        </div>
                        @error('password')
                            <div class="text-red-600 text-sm h-4 flex justify-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <!-- Button -->
                        <div class="w-2/3 m-auto text-right">
                            <button type="submit" class="bg-blue-600 w-1/3 text-white mt-6 mb-4 py-1.5 rounded">登録</button>
                        </div>
                    </div>
                </form>
                <script src="{{ asset('js/menu_script.js') }}" defer></script>
            </main>
        </div>
</x-app-layout>
