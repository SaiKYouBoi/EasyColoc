{{-- errors messages --}}
<div class="fixed top-6 right-6 z-50 flex flex-col gap-4 pointer-events-none">
    @if (session('success'))
        <div
            class="pointer-events-auto flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 border-l-4 border-emerald-500 rounded-lg shadow-lg shadow-emerald-900/5 min-w-[320px]">
            <div
                class="flex-shrink-0 size-8 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center">
                <span
                    class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-lg font-bold">check_circle</span>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Success</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div
            class="pointer-events-auto flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-900 border-l-4 border-red-500 rounded-lg shadow-lg shadow-red-900/5 min-w-[320px]">
            <div class="flex-shrink-0 size-8 rounded-full bg-red-50 dark:bg-red-900/30 flex items-center justify-center">
                <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-lg font-bold">error</span>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-slate-900 dark:text-slate-100">Error</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ session('error') }}</p>
            </div>

        </div>
    @endif
</div>
{{-- enderrormessages --}}
