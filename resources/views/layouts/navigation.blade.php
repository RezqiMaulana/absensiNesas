
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 p-6 flex flex-col transition-transform duration-300 lg:relative lg:translate-x-0">
            
            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <span class="text-xl font-bold text-slate-800 dark:text-white">E-Absen</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 space-y-2 text-sm">
                <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest px-2 mb-2">Main Menu</p>
                @php $role = Auth::user()->role; @endphp

                


                @if($role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50' }} flex items-center gap-3 p-3 rounded-xl font-semibold transition-all">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="{{ Request::is('admin/users*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50' }} flex items-center gap-3 p-3 rounded-xl font-semibold transition-all">Kelola User</a>
                    <a href="#" class="flex items-center gap-3 p-3 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 rounded-xl transition-all">Data Gedung</a>
                @elseif($role == 'piket')
                    <a href="{{ route('piket.dashboard') }}" class="{{ Request::is('piket.dashboard*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50' }} flex items-center gap-3 p-3 rounded-xl font-semibold transition-all">
                        Dashboard
                    </a>
                    <a href="{{ route('piket.rekap.index') }}" class="flex items-center gap-3 p-3 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 rounded-xl transition-all">Rekap Area</a>
                @endif
            </nav>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 space-y-2">
                <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
                    class="flex items-center gap-3 p-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 w-full rounded-xl transition-all">
                    <span x-show="!darkMode" class="flex items-center gap-3">🌙 Mode Gelap</span>
                    <span x-show="darkMode" class="flex items-center gap-3">☀️ Mode Terang</span>
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 w-full rounded-xl transition-all font-semibold">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>