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
                        <li class="p-2 text-2xl font-bold"><a href="">Home</a></li>
                        <li class="p-2 text-2xl font-bold"><a href="">Registration</a></li>
                        <li class="p-2 text-2xl font-bold"><a href="">Login</a></li>
                    </ul>
                </div>
                <h1 class="text-3xl text-blue-600 font-black m-2">Rese</h1>
            </div>
        </header>
</x-slot>
{{-- mainに入る部分 --}}
        <main id="main_container" class="flex justify-center">
            <div class="w-11/12 flex justify-center">
                <div class="bg-white h-60 w-1/3 rounded shadow-md shadow-gray-400 flex flex-col">
                    <div class="w-full h-1/4 bg-blue-600 text-white mb-4 pt-2 p-2 rounded-t-lg flex items-center">
                        <p class="text-l text-white pl-2">Login</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-col justify-center w-full">
                    <!-- Email Address -->
                        <div class="flex justify-center">
                            <label for="email" class="text-gray-500">Email : </label>
                            <input id="email" type="email" :value="old('email')" required autofocus autocomplete="username" class="text-gray-500 w-2/3 p-1 border-none" />
                        </div>
                        <div class="flex justify-center">
                        <div class="border-b border-gray-500 w-10/12"></div>
                        </div>



                        {{-- <div class="w-full flex m-2">
                            <label for="email" class="text-gray-500":value="__('Email')">Email : </label>
                            <input id="email" class="border-none border-b-1 border-gray-500 mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div> --}}

                    <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block focus:boder-none mt-1 w-4/5"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 w-1/4 text-white mt-4 py-1.5 rounded">ログイン</button>
                </div>
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
    </div>

</html>

</x-app-layout>

