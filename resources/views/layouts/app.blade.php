<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('theme') === 'dark', sidebarOpen: false }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body @class(['bg-slate-50', 'dark:bg-slate-900', 'transition-colors', 'duration-300'])>
    <div @class(['flex', 'min-h-screen', 'relative'])>
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" @class(['fixed', 'inset-0', 'z-40', 'bg-slate-900/50', 'backdrop-blur-sm', 'lg:hidden'])></div>
        @include("layouts.navigation")

        <main @class(['flex-1', 'w-full', 'overflow-x-hidden'])>
            <header @class(['sticky', 'top-0', 'z-30', 'bg-slate-50/80', 'dark:bg-slate-900/80', 'backdrop-blur-md', 'p-4', 'lg:p-8'])>
                <div @class(['flex', 'justify-between', 'items-center'])>
                    <div @class(['flex', 'items-center', 'gap-4'])>
                        <button @click="sidebarOpen = true" @class(['lg:hidden', 'p-2', 'rounded-lg', 'bg-white', 'dark:bg-slate-800', 'shadow-sm', 'border', 'border-slate-200', 'dark:border-slate-700'])>
                            <svg @class(['w-6', 'h-6', 'dark:text-white']) fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        <div>
                            <h2 @class(['text-xl', 'lg:text-2xl', 'font-bold', 'text-slate-800', 'dark:text-white', 'uppercase', 'tracking-tight'])>@yield('title')</h2>
                            <p @class(['hidden', 'sm:block', 'text-slate-500', 'dark:text-slate-400', 'text-xs', 'lg:text-sm'])>Selamat datang, {{ Auth::user()->name }}</p>
                        </div>
                    </div>

                    <div @class(['flex', 'items-center', 'gap-3', 'lg:gap-4'])>
                        <div @class(['text-right', 'hidden', 'sm:block'])>
                            <p @class(['text-sm', 'font-bold', 'text-slate-800', 'dark:text-white', 'leading-none'])>{{ Auth::user()->name }}</p>
                            <p @class(['text-[10px]', 'text-slate-400', 'dark:text-slate-500', 'mt-1', 'uppercase', 'font-bold', 'tracking-widest'])>{{ Auth::user()->role }}</p>
                        </div>
                        <div @class(['w-10', 'h-10', 'rounded-xl', 'bg-gradient-to-tr', 'from-blue-600', 'to-indigo-600', 'border-2', 'border-white', 'dark:border-slate-700', 'shadow-lg', 'shadow-blue-200', 'dark:shadow-none'])></div>
                    </div>
                </div>
            </header>

            <div @class(['px-4', 'lg:px-8', 'pb-8'])>

                <div @class(['max-w-12xl', 'mx-auto', 'px-4', 'lg:px-8', 'mt-4'])>
                    
                    @if(session('success'))
                    <div x-data="{ show: true }" 
                        x-show="show" 
                        x-init="setTimeout(() => show = false, 3000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        @class(['mb-4', 'flex', 'items-center', 'p-4', 'text-emerald-700', 'bg-emerald-50', 'dark:bg-emerald-900/30', 'dark:text-emerald-400', 'rounded-2xl', 'border', 'border-emerald-100', 'dark:border-emerald-800', 'shadow-sm']) 
                        role="alert">
                        <svg @class(['flex-shrink-0', 'w-5', 'h-5', 'mr-3']) fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span @class(['text-sm', 'font-bold'])>{{ session('success') }}</span>
                    </div>
                    @endif

                    @if($errors->any())
                    <div x-data="{ show: true }" 
                        x-show="show"
                        @class(['mb-4', 'p-4', 'text-red-700', 'bg-red-50', 'dark:bg-red-900/30', 'dark:text-red-400', 'rounded-2xl', 'border', 'border-red-100', 'dark:border-red-800', 'shadow-sm'])>
                        <div @class(['flex', 'items-center', 'justify-between', 'mb-2'])>
                            <div @class(['flex', 'items-center'])>
                                <svg @class(['flex-shrink-0', 'w-5', 'h-5', 'mr-3']) fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <span @class(['text-sm', 'font-bold'])>Terjadi Kesalahan:</span>
                            </div>
                            <button @click="show = false" @class(['text-red-400', 'hover:text-red-600', 'transition-colors'])>
                                <svg @class(['w-4', 'h-4']) fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <ul @class(['list-disc', 'list-inside', 'text-xs', 'space-y-1', 'ml-8', 'font-medium'])>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>