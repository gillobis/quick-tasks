@extends('layouts.auth')

@section('content')

    <style>
        @media(prefers-color-scheme: dark){ .bg-dots{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(200,200,255,0.15)'/%3E%3C/svg%3E");}}@media(prefers-color-scheme: light){.bg-dots{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,50,0.10)'/%3E%3C/svg%3E")}}
    </style>

    <div class="relative min-h-screen  bg-base-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white ">
        
        @if (Route::has('login'))
            <div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a href="{{ route('home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="py-6 lg:py-8 lg:mt-32 mx-auto w-full ">
            <div class="flex justify-center">
                <x-logo class="w-auto h-40 mx-auto" />
            </div>
            <div class="mt-16">
                <div class="grid grid-cols-1 gap-6 lg:gap-8 text-center w-full">
                    <h1 class="font-semibold text-5xl px-6">Don't forget anything anymore.</h1>
                    <h2 class="font-medium text-xl px-6">Create lists of appointments, tasks or things to do. Don't worry about forgetting them, we'll remember them for you.</h2>
                    
                    <div class="text-center">
                        <a href="{{ route('register')  }}" class="btn btn-primary max-w-sm">Get Started</a>
                    </div>

                    <div class="bg-accent text-white p-10 py-20 w-full  mt-3">
                        <h2 class="font-medium text-3xl">Simple. Easy. Quick.</h2>
                        <p class="mt-3 text-xl">Keeping track of the things to do is now easier than ever. Enter your commitments and you will never forget a deadline again.</p>
                    </div>

                    <div class="p-6 mt-3 text-center max-w-[700px] mx-auto">
                        <div class="grid grid-cols-2 gap-8">
                            <div class="text-right">
                                <div class="font-bold text-4xl">1.</div>
                                <div class="font-bold text-2xl">Write</div>
                                <div class="font-medium text-lg">Create lists and add to it tasks indicating the priority level and an optional due date.</div>
                            </div>
                            <div><img src="https://placehold.jp/150x150.png" alt="" class="rounded-lg"></div>

                            <div class="text-right">
                                <div class="font-bold text-4xl">2.</div>
                                <div class="font-bold text-2xl">Keep track</div>
                                <div class="font-medium text-lg">Stay informed about upcoming assignments nad don't miss your due tasks</div>
                            </div>
                            <div><img src="https://placehold.jp/150x150.png" alt="" class="rounded-lg"></div>

                            <div class="text-right">
                                <div class="font-bold text-4xl">3.</div>
                                <div class="font-bold text-2xl">Manage</div>
                                <div class="font-medium text-lg">Move tasks between lists, mark them as done or completely delete them.</div>
                            </div>
                            <div><img src="https://placehold.jp/150x150.png" alt="" class="rounded-lg"></div>
                        </div>
                    </div>

                    {{-- contact form --}}
                    <div class="bg-base-100">

                        <div class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32">
                            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                                    <div class="max-w-xl lg:max-w-lg">
                                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Subscribe to our newsletter.</h2>
                                        <p class="mt-4 text-lg leading-8 text-gray-300">Sign up to get the latest on updates, new releases and more...</p>
                                        
                                    </div>
                                    <div>
                                        <div class="mt-6 flex max-w-md gap-x-4">
                                            <label for="email-address" class="sr-only">Email address</label>
                                            <input id="email-address" name="email" type="email" autocomplete="email" required class="input" placeholder="Enter your email">
                                            <button type="submit" class="flex-none btn btn-secondary">Subscribe</button>
                                        </div>
                                    </div>
                                    {{-- <dl class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
                                        <div class="flex flex-col items-start">
                                            <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                                </svg>
                                            </div>
                                            <dt class="mt-4 font-semibold text-white">Weekly articles</dt>                                            
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                                                </svg>
                                            </div>
                                            <dt class="mt-4 font-semibold text-white">No spam</dt>
                                        </div>
                                    </dl> --}}
                                </div>
                            </div>
                            <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
                                <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                            </div>
                        </div>
  
                    
                </div>
            </div>
            {{-- <div class="flex justify-center px-0 mt-16 sm:items-center sm:justify-between">
                <div class="text-sm text-center text-gray-500 dark:text-gray-400 sm:text-left">
                    <div class="flex items-center gap-4">
                        <a href="https://github.com/sponsors/taylorotwell" class="inline-flex items-center group hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-5 h-5 mr-1 -mt-px stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            Sponsor
                        </a>
                    </div>
                </div>
                <div class="ml-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) & Livewire
                    {{ \Composer\InstalledVersions::getPrettyVersion('livewire/livewire') }}
                </div>
            </div> --}}
        </div>
    </div>
@endsection
