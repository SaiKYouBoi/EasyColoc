<div class="flex h-screen w-full bg-background-light">
    <!-- Side Navigation -->
    <aside class="flex w-72 flex-col border-r border-slate-200 bg-surface-light h-full lg:flex">
        <div class="flex h-20 items-center justify-center border-b border-slate-100 px-8">
            <div class="flex items-center gap-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white">
                    <span class="material-symbols-outlined text-2xl">roofing</span>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">EasyColoc</span>
            </div>
        </div>
        <div class="flex flex-col gap-2 p-4 flex-1 overflow-y-auto">
            <!-- User Profile Summary -->
            <div class="mb-6 flex items-center gap-3 rounded-xl bg-background-light p-3">
                <div class="size-10 rounded-lg bg-primary/20 flex items-center justify-center text-lg font-bold text-primary uppercase">
                                        A
                                    </div>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-slate-900">Alex Morgan</span>
                    <span class="text-xs text-slate-500">Premium Member</span>
                </div>
            </div>
            <!-- Navigation Links -->
            <nav class="space-y-1">
                <a class="flex items-center gap-3 rounded-lg bg-primary/10 px-3 py-2.5 text-primary-dark transition-colors"
                    href="{{ route('userdashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                    href="{{ route('colocations') }}">
                    <span class="material-symbols-outlined">home_work</span>
                    <span class="text-sm font-medium">Colocations</span>
                </a>
                <a class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">person</span>
                    <span class="text-sm font-medium">Admin</span>
                </a>
            </nav>
        </div>
        <div class="border-t border-slate-100 p-4">
            <div class="p-4">
                <div
                    class="bg-primary/5 dark:bg-primary/10 border border-primary/20 p-4 rounded-xl relative overflow-hidden group mb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-primary text-base">verified_user</span>
                        <h4 class="font-bold text-xs text-slate-900 dark:text-slate-100">Reputation</h4>
                    </div>
                    <div class="flex items-baseline gap-1 mb-1">
                        <span class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">+12</span>

                    </div>
                    <div class="mt-2 h-1 w-full bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full w-[80%]"></div>
                    </div>
                </div>

            </div>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-red-600 transition-colors"
                href="#">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-medium">Logout</span>
            </a>
        </div>
    </aside>
