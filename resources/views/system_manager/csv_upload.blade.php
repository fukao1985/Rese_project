<x-app-layout>

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
                            <li class="ml-10"><a href="{{ route('csv.file') }}">Shop create</a></li>
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
                <div class="bg-white h-auto w-10/12 md:w-3/5 rounded shadow-md shadow-gray-400 flex flex-col justify-center">
                    <div class="w-full h-2/5 bg-blue-600 text-white mb-4 pt-2 p-2 rounded-t-lg flex items-center">
                        <p class="text-l text-white pl-2">Shop Create</p>
                    </div>
                    <div class="flex justify-center flex-col w-full">
                        <form method="POST" action="{{ route('csv.upload') }}" class="w-full flex flex-col justify-center" novalidate enctype="multipart/form-data">
                        @csrf
                            <!-- Button -->
                            <div class="w-10/12 flex justify-center flex-col mx-auto">
                                <p class="mt-2 mb-10 mx-auto">CSVファイルをアップロードしてください。</p>
                                <input type="file" name="csv_file" class="mx-auto  mt-6 mb-2 pl-10">
                                <button type="submit" class="bg-blue-600 w-1/3 text-white mt-2 mb-10 mx-auto py-1.5 rounded">アップロード</button>
                                <!-- error表示 -->
                                <div class="w-4/5 bg-red-200 h-auto mx-auto mb-4">
                                    <x-input-error class="text-center py-2 font-bold" :messages="$errors->all()"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/menu_script.js') }}" defer></script>
        </main>
    </div>
</x-app-layout>

