@extends('layouts.main')
@section('content')
    <main class="flex-1 h-full overflow-y-auto overflow-x-hidden">
        <!-- Mobile Header -->
        <div
            class="lg:hidden flex items-center justify-between p-4 bg-surface-light border-b border-slate-200 sticky top-0 z-10">
            <div class="flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white">
                    <span class="material-symbols-outlined text-lg">roofing</span>
                </div>
                <span class="text-lg font-bold text-slate-900">EasyColoc</span>
            </div>
            <button class="text-slate-600">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
        <div class="max-w-[1200px] mx-auto p-6 md:p-8 space-y-8">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Colocations</h1>
                    <p class="text-slate-500 mt-1">Overview of your colocations<span
                            class="font-medium text-slate-900"></span></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($colocations as $coloc )
                <div
                    class="group bg-surface-light dark:bg-surface-dark rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:border-primary/30 dark:hover:border-primary/50 transition-all duration-300 relative overflow-hidden flex flex-col justify-between min-h-[220px]">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-8 -mt-8 pointer-events-none transition-opacity group-hover:bg-primary/10">
                    </div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            C1
                        </div>
                        <div class="flex gap-2">
                            @if ( $coloc->pivot->role == 'owner')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300 border border-amber-200 dark:border-amber-700/50">
                                <span class="material-icons-outlined text-[10px] mr-1">emoji_events</span>
                                OWNER
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-700/50">
                                MEMBER
                            </span>
                            @endif
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border border-green-200 dark:border-green-700/50">
                                ACTIVE
                            </span>
                        </div>
                    </div>
                    <div class="mb-6 relative z-10">
                        <h3
                            class="text-lg font-bold text-text-main-light dark:text-text-main-dark mb-1 group-hover:text-primary transition-colors">
                            {{ $coloc->title }}</h3>
                        <div class="flex items-center text-text-sub-light dark:text-text-sub-dark text-sm">
                            <span class="material-icons-outlined text-sm mr-1">people</span>
                            {{ $coloc->active_members_count }} Members
                        </div>
                    </div>
                    <div
                        class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-end justify-between relative z-10">
                        <div>
                            <p
                                class="text-xs text-text-sub-light dark:text-text-sub-dark uppercase tracking-wider font-semibold mb-0.5">
                                Expenses</p>
                            <p class="text-2xl font-bold text-text-main-light dark:text-text-main-dark">{{ $coloc->expenses_count ?? 0 }}</p>
                        </div>
                        <a href="{{ route('colocations.show', $coloc->id) }}"
                            class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-800 hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white text-text-main-light dark:text-text-main-dark flex items-center justify-center transition-all shadow-sm border border-gray-200 dark:border-gray-700 group-hover:border-primary/50">
                            <span class="material-icons-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
                {{-- <div
                    class="group bg-surface-light dark:bg-surface-dark rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:border-primary/30 dark:hover:border-primary/50 transition-all duration-300 relative overflow-hidden flex flex-col justify-between min-h-[220px]">
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-purple-500 to-fuchsia-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            DT
                        </div>
                        <div class="flex gap-2">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-700/50">
                                MEMBER
                            </span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border border-green-200 dark:border-green-700/50">
                                ACTIVE
                            </span>
                        </div>
                    </div>
                    <div class="mb-6 relative z-10">
                        <h3
                            class="text-lg font-bold text-text-main-light dark:text-text-main-dark mb-1 group-hover:text-primary transition-colors">
                            Downtown Loft</h3>
                        <div class="flex items-center text-text-sub-light dark:text-text-sub-dark text-sm">
                            <span class="material-icons-outlined text-sm mr-1">people</span>
                            4 Members
                        </div>
                    </div>
                    <div
                        class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-end justify-between relative z-10">
                        <div>
                            <p
                                class="text-xs text-text-sub-light dark:text-text-sub-dark uppercase tracking-wider font-semibold mb-0.5">
                                Expenses</p>
                            <p class="text-2xl font-bold text-text-main-light dark:text-text-main-dark">8</p>
                        </div>
                        <button
                            class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-800 hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white text-text-main-light dark:text-text-main-dark flex items-center justify-center transition-all shadow-sm border border-gray-200 dark:border-gray-700 group-hover:border-primary/50">
                            <span class="material-icons-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div> --}}
                {{-- <div
                    class="group bg-surface-light dark:bg-surface-dark rounded-2xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-xl hover:border-primary/30 dark:hover:border-primary/50 transition-all duration-300 relative overflow-hidden flex flex-col justify-between min-h-[220px] opacity-80 hover:opacity-100">
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div
                            class="h-12 w-12 rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-bold text-lg shadow-inner">
                            LP
                        </div>
                        <div class="flex gap-2">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                SETUP
                            </span>
                        </div>
                    </div>
                    <div class="mb-6 relative z-10">
                        <h3
                            class="text-lg font-bold text-text-main-light dark:text-text-main-dark mb-1 group-hover:text-primary transition-colors">
                            Le Marais Project</h3>
                        <div class="flex items-center text-text-sub-light dark:text-text-sub-dark text-sm">
                            <span class="material-icons-outlined text-sm mr-1">people</span>
                            1 Member
                        </div>
                    </div>
                    <div
                        class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700/50 flex items-end justify-between relative z-10">
                        <div>
                            <p
                                class="text-xs text-text-sub-light dark:text-text-sub-dark uppercase tracking-wider font-semibold mb-0.5">
                                Expenses</p>
                            <p class="text-2xl font-bold text-text-main-light dark:text-text-main-dark">0</p>
                        </div>
                        <button
                            class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-800 hover:bg-primary hover:text-white dark:hover:bg-primary dark:hover:text-white text-text-main-light dark:text-text-main-dark flex items-center justify-center transition-all shadow-sm border border-gray-200 dark:border-gray-700 group-hover:border-primary/50">
                            <span class="material-icons-outlined">settings</span>
                        </button>
                    </div>
                </div> --}}
                <div
                    class="group bg-transparent rounded-2xl p-6 border-2 border-dashed border-gray-300 dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary/5 transition-all duration-300 flex flex-col items-center justify-center min-h-[220px] cursor-pointer">
                    <button id="createColocation">
                        <div
                            class="h-14 w-14 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700 flex items-center justify-center mb-3 transition-colors">
                            <span
                                class="material-icons-outlined text-gray-400 dark:text-gray-500 group-hover:text-primary text-2xl">add</span>
                        </div>
                    </button>
                    <h3
                        class="text-sm font-semibold text-text-sub-light dark:text-text-sub-dark group-hover:text-primary transition-colors">
                        Create New Colocation</h3>
                </div>
            </div>



        </div>
    </main>
    {{-- cloccation modal --}}
    <div id="colocModal"
        class="fixed hidden inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/20 backdrop-blur-sm">
        <div
            class="w-full max-w-lg bg-modal-bg rounded-2xl shadow-xl overflow-hidden animate-fade-in-up border border-slate-100/50">
            <div class="p-8 space-y-6 bg-white rounded-2xl m-1">
                <div class="mb-2">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Create New Colocation</h2>
                    <p class="text-sm text-slate-500 mt-1">Set up a new shared space to manage expenses.</p>
                </div>
                <form id="colacForm" action="{{ route('colocation.create') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="relative group">
                        <input name="colocName"
                            class="peer block w-full rounded-xl border-slate-200 bg-white px-4 pt-5 pb-2 text-sm text-slate-900 focus:border-indigo-action focus:ring-1 focus:ring-indigo-action outline-none transition-all placeholder-transparent"
                            id="colocName" placeholder="Colocation Name" required="" type="text" />
                        <label
                            class="absolute left-4 top-1.5 text-xs font-medium text-slate-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-action"
                            for="colocName">
                            Colocation Name <span class="text-red-400">*</span>
                        </label>
                    </div>
                    <div class="relative">
                        <textarea name="description"
                            class="peer block w-full resize-none rounded-xl border-slate-200 bg-white px-4 pt-5 pb-2 text-sm text-slate-900 focus:border-indigo-action focus:ring-1 focus:ring-indigo-action outline-none transition-all placeholder-transparent"
                            id="description" placeholder="Describe your colocation briefly..." rows="3"></textarea>
                        <label
                            class="absolute left-4 top-1.5 text-xs font-medium text-slate-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-indigo-action"
                            for="description">
                            Description (optional)
                        </label>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button
                            class="flex-1 bg-primary hover:bg-primary-dark text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-[0.98]"
                            type="submit">
                            Create Colocation
                        </button>
                        <button class="px-4 py-3 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors"
                            type="button" id="cancelButton">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        colocModal = document.getElementById('colocModal');
        cancelButton = document.getElementById('cancelButton');
        createButton = document.getElementById('createColocation');
        colacForm = document.getElementById('colacForm');

        createButton.addEventListener("click", function(event) {
            colocModal.classList.remove('hidden');
        });

        cancelButton.addEventListener("click", function(event) {
            colocModal.classList.add('hidden');
            colacForm.reset();
        });
    </script>
@endsection
