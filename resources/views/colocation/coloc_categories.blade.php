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
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Manage Categories</h1>
                    <p class="text-slate-500 mt-1">Organize and track your shared living expenses with custom labels.<span
                            class="font-medium text-slate-900"></span></p>
                </div>
                <button id="createCategory"
                    class="bg-primary hover:bg-primary-dark text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all shadow-sm shadow-primary/20">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Add Category
                </button>
            </div>

            <div
                class="w-[90%] m-auto bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Category
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($colocation->categories as $category)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="size-8 rounded-lg bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-sm">chips</span>
                                        </div>
                                        <span class="font-semibold text-sm">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        {{-- Category Modal --}}
        <!-- Modal Overlay -->
        <div id="modal"
            class="fixed hidden inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
            <div
                class="bg-white dark:bg-zinc-900 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-slate-200 dark:border-zinc-800">
                <div class="p-8">
                    <!-- Header Component Variation -->
                    <div class="flex flex-col gap-2 mb-8">
                        <h2 class="text-slate-900 dark:text-slate-100 text-2xl font-bold tracking-tight">Add New
                            Category
                        </h2>
                        <p class="text-slate-500 dark:text-zinc-400 text-sm font-normal leading-relaxed">
                            Enter a name for the new expense category.
                        </p>
                    </div>
                    <form action="{{ route('category.store',$colocation) }}" id="categoryForm" method="POST">
                        @csrf
                    <!-- Form Section -->
                    <div class="flex flex-col gap-6" >
                        <div class="flex flex-col gap-2">
                            <label class="text-slate-700 dark:text-zinc-300 text-sm font-semibold leading-none">
                                Category Name
                            </label>
                            <div class="relative">
                                <input name="categoryName"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 dark:placeholder:text-zinc-500 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                    placeholder="e.g., Subscriptions" type="text" />
                            </div>
                        </div>
                        <!-- Icon Picker (Optional Enhancement) -->

                    </div>
                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 mt-10">
                        <button id="cancelCategory" type="button"
                            class="px-6 h-11 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 font-semibold text-sm hover:bg-slate-200 dark:hover:bg-zinc-700 transition-colors">
                            Cancel
                        </button>
                        <!-- Overriding primary for user request emerald color while keeping theme structure -->
                        <button type="submit"
                            class="px-6 h-11 rounded-xl bg-[#13ecb6] text-slate-900 font-bold text-sm hover:opacity-90 shadow-lg shadow-[#13ecb6]/20 transition-all active:scale-95">
                            Create Category
                        </button>
                    </div>
                </div>
                <!-- Bottom Accent -->
                <div class="h-1.5 w-full bg-gradient-to-r from-primary to-[#13ecb6]"></div>
            </div>
            </form>
        </div>

        <script>
        modal = document.getElementById('modal');
        form = document.getElementById('categoryForm');

        createcategory = document.getElementById('createCategory');
        cancelcategory = document.getElementById('cancelCategory');

        createcategory.addEventListener("click", function(event) {
            modal.classList.remove('hidden');
        });

        cancelcategory.addEventListener("click", function(event) {
            modal.classList.add('hidden');
            form.reset();
        });
        </script>
@endsection
