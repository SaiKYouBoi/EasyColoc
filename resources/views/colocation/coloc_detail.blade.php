@extends('layouts.main')
@section('content')
    <main class="flex-1 h-full overflow-y-auto overflow-x-hidden">


        <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">My Colocation</h1>
                    <p class="text-slate-500 mt-1">Overview of your colocation <span
                            class="font-medium text-slate-900">{{ $colocation->title }}</span></p>
                </div>
                <button
                    class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/20 rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-lg">logout</span>
                    Leave
                </button>
            </div>
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-wide">Total Expenses</p>
                        <h3 class="text-2xl font-bold tracking-tight mt-1">{{ $totalExpenses }} MAD</h3>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 text-3xl">payments</span>
                </div>
                <div
                    class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-medium uppercase tracking-wide">Your Balance</p>
                        <h3 class="text-2xl font-bold tracking-tight text-red-500 mt-1">-$125.40</h3>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 text-3xl">account_balance_wallet</span>
                </div>

            </section>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
                <section class="xl:col-span-2 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Expenses</h2>
                        <div class="flex gap-4">
                            <a href="{{ route('categories.show' ,$colocation) }}">
                            <button
                                class="bg-primary hover:bg-primary-dark text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all shadow-sm shadow-primary/20">
                                <span class="material-symbols-outlined text-xl">settings</span>
                                Manage Categories
                            </button>
                            </a>
                            <button id="createExpense"
                                class="bg-primary hover:bg-primary-dark text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all shadow-sm shadow-primary/20">
                                <span class="material-symbols-outlined text-xl">add</span>
                                Add Expense
                            </button>
                        </div>
                    </div>
                    <div
                        class="bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-800 p-3 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary ml-2">filter_alt</span>
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">Filter by month:</span>
                        <div class="relative group">
                            <button
                                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center gap-2 hover:border-primary transition-colors">
                                All months
                                <span class="material-symbols-outlined text-base">expand_more</span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden min-h-[400px]">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                    <tr>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Title / Category</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Paid
                                            By</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                            Amount</th>
                                        <th
                                            class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @foreach ($colocation->expenses as $expense)
                                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-bold text-sm text-slate-900 dark:text-white">{{ $expense->title }}</span>
                                                    <span
                                                        class="text-xs text-slate-500 font-medium">{{ $expense->category->name ?? 'No Category' }}
                                                        • {{ $expense->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-2">
                                                    <div class="size-8 rounded-full bg-slate-200 bg-cover bg-center border border-white dark:border-slate-700"
                                                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCKkaPpjh7dP4pjpYFhxXnBFTwBXrBEg-fAqOnzRaXc83X4QTdqgHuSziI7zbOXsQHgrDvJNb9i1Y8KnAWsnUHdkB97hO9RUyCoVk3VGsEPDCQQGFjLm35CiXVnOn7zkhZSHQjlrKgpBX34brwq_rhWSZi4j0RqH_ixImNyxEQdc7auqynjPR8E01x9ad9zYy-E0GppBmge6BMyYENwR4albKQyjXwWwdEHnarnuufsCCOXiKSGk8sX5mhIsq-AkuxIdkt9cT6yV1k')">
                                                    </div>
                                                    <span
                                                        class="text-sm font-medium">{{ $expense->payer->id === auth()->id() ? 'You' : $expense->payer->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-sm font-bold">{{ number_format($expense->amount, 2) }}
                                                MAD</td>
                                            <td class="px-6 py-5 text-right">
                                                <button class="text-slate-400 hover:text-primary transition-colors p-1">
                                                    <span class="material-symbols-outlined text-xl">visibility</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-sm text-slate-900 dark:text-white">Organic
                                                    Groceries</span>
                                                <span class="text-xs text-slate-500 font-medium">Food • Oct 10, 2023</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="size-8 rounded-full bg-primary/20 flex items-center justify-center text-primary text-xs font-bold border border-primary/20">
                                                    ME</div>
                                                <span class="text-sm font-medium text-slate-900 dark:text-white">You</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-bold">$145.20</td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-slate-400 hover:text-primary transition-colors p-1">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-sm text-slate-900 dark:text-white">Rent
                                                    Payment</span>
                                                <span class="text-xs text-slate-500 font-medium">Housing • Oct 01,
                                                    2023</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-2">
                                                <div class="size-8 rounded-full bg-slate-200 bg-cover bg-center border border-white dark:border-slate-700"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDt4I8JInl-8kRSZmqBrQDWJ03AnHbwKsrUCrfilTnEhFqGojgAzknu9Lmzf1ddFiZQF3AlqxbNRU1rQdx03Fjxv2ylFsUoPv1VZExqo9Slh5ZubVei3iwkb-85RKxgdppX7c5KMvzQnAP4sZwzYh-JiWViztIX6m2VzbabvZhN_x_0LWOg2G67iRdyvol5MdsbZZxCrNcrgJCakgjv8v5bvmgEfmphzdt2RkC0sDF9lTXXUsD5q7elSB3UfN2NVs5QiLDJ0Gp8IzI')">
                                                </div>
                                                <span class="text-sm font-medium">Sarah K.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-bold">$1,800.00</td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-slate-400 hover:text-primary transition-colors p-1">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-sm text-slate-900 dark:text-white">Cleaning
                                                    Supplies</span>
                                                <span class="text-xs text-slate-500 font-medium">Household • Sep 28,
                                                    2023</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-2">
                                                <div class="size-8 rounded-full bg-slate-200 bg-cover bg-center border border-white dark:border-slate-700"
                                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD-ifp6nhW2F2cKlsZdxyUk5WEP5guYMtHG2sdnsoB4Eqn-ZfgATTiNgwnVqedv1We8PGipyp6bP1NMvyCpeQQ1GIXS-Gwhg_-z4SJxnxXICzpzsAx2oXaO7iH5p1bx6kSeKdr8WZCpjGyCE6FDEiMy7Ncf5NzmNy4p7mPfvDk892zfaXKgHGzn1aWQ3boXP293w0QIxgDJe_sq07mplVz8_RBuNinBHIuCYPNOG0DGL1QpUicXgafGIJhgD3KJXYV8PrIetOSiXcM')">
                                                </div>
                                                <span class="text-sm font-medium">Alex M.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-bold">$24.50</td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-slate-400 hover:text-primary transition-colors p-1">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </section>
                <aside class="space-y-8 xl:col-span-1">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Who owes whom?</h3>
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 min-h-[200px] flex flex-col items-center justify-center text-center p-5">
                            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                                <!-- Row 1: Sarah K. owes Alex M. -->
                                <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex -space-x-2">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-slate-200 bg-cover bg-center shadow-sm"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDt4I8JInl-8kRSZmqBrQDWJ03AnHbwKsrUCrfilTnEhFqGojgAzknu9Lmzf1ddFiZQF3AlqxbNRU1rQdx03Fjxv2ylFsUoPv1VZExqo9Slh5ZubVei3iwkb-85RKxgdppX7c5KMvzQnAP4sZwzYh-JiWViztIX6m2VzbabvZhN_x_0LWOg2G67iRdyvol5MdsbZZxCrNcrgJCakgjv8v5bvmgEfmphzdt2RkC0sDF9lTXXUsD5q7elSB3UfN2NVs5QiLDJ0Gp8IzI')">
                                            </div>
                                            <div class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-slate-200 bg-cover bg-center shadow-sm"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCKkaPpjh7dP4pjpYFhxXnBFTwBXrBEg-fAqOnzRaXc83X4QTdqgHuSziI7zbOXsQHgrDvJNb9i1Y8KnAWsnUHdkB97hO9RUyCoVk3VGsEPDCQQGFjLm35CiXVnOn7zkhZSHQjlrKgpBX34brwq_rhWSZi4j0RqH_ixImNyxEQdc7auqynjPR8E01x9ad9zYy-E0GppBmge6BMyYENwR4albKQyjXwWwdEHnarnuufsCCOXiKSGk8sX5mhIsq-AkuxIdkt9cT6yV1k')">
                                            </div>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-xs font-bold text-slate-900 dark:text-white">Sarah owes Alex</p>
                                            <span class="text-[11px] font-bold text-primary">$45.00</span>
                                        </div>
                                    </div>
                                    <button
                                        class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-[11px] font-bold transition-colors">Settle</button>
                                </div>
                                <!-- Row 2: Alex M. owes You -->
                                <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex -space-x-2">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-slate-200 bg-cover bg-center shadow-sm"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCKkaPpjh7dP4pjpYFhxXnBFTwBXrBEg-fAqOnzRaXc83X4QTdqgHuSziI7zbOXsQHgrDvJNb9i1Y8KnAWsnUHdkB97hO9RUyCoVk3VGsEPDCQQGFjLm35CiXVnOn7zkhZSHQjlrKgpBX34brwq_rhWSZi4j0RqH_ixImNyxEQdc7auqynjPR8E01x9ad9zYy-E0GppBmge6BMyYENwR4albKQyjXwWwdEHnarnuufsCCOXiKSGk8sX5mhIsq-AkuxIdkt9cT6yV1k')">
                                            </div>
                                            <div
                                                class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                ME</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-xs font-bold text-slate-900 dark:text-white">Alex owes You</p>
                                            <span class="text-[11px] font-bold text-primary">$12.50</span>
                                        </div>
                                    </div>
                                    <button
                                        class="px-3 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary rounded-lg text-[11px] font-bold transition-colors">Pay</button>
                                </div>
                                <!-- Row 3: Sarah K. owes You -->
                                <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex -space-x-2">
                                            <div class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-slate-200 bg-cover bg-center shadow-sm"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDt4I8JInl-8kRSZmqBrQDWJ03AnHbwKsrUCrfilTnEhFqGojgAzknu9Lmzf1ddFiZQF3AlqxbNRU1rQdx03Fjxv2ylFsUoPv1VZExqo9Slh5ZubVei3iwkb-85RKxgdppX7c5KMvzQnAP4sZwzYh-JiWViztIX6m2VzbabvZhN_x_0LWOg2G67iRdyvol5MdsbZZxCrNcrgJCakgjv8v5bvmgEfmphzdt2RkC0sDF9lTXXUsD5q7elSB3UfN2NVs5QiLDJ0Gp8IzI')">
                                            </div>
                                            <div
                                                class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                ME</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-xs font-bold text-slate-900 dark:text-white">Sarah owes You</p>
                                            <span class="text-[11px] font-bold text-primary">$22.00</span>
                                        </div>
                                    </div>
                                    <button
                                        class="px-3 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary rounded-lg text-[11px] font-bold transition-colors">Pay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-slate-900 dark:bg-black rounded-2xl border border-slate-800 shadow-lg overflow-hidden text-white">
                        <div class="p-5 border-b border-white/10 flex items-center justify-between">
                            <h3 class="font-bold text-sm tracking-wide">Colocation Members</h3>
                            <span class="text-[10px] font-bold bg-white/10 px-2 py-1 rounded text-white/70">ACTIVE</span>
                        </div>
                        <div class="p-3 space-y-2">
                            @foreach ($colocation->memberships as $membership)
                                <div
                                    class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors group cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="size-10 rounded-lg bg-slate-700 flex items-center justify-center text-lg font-bold text-white uppercase">
                                            AM
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-sm font-bold text-white">{{ $membership->user->name }}</span>
                                            </div>
                                            @if ($membership->role === 'owner')
                                                <div class="flex items-center gap-1.5 mt-0.5">
                                                    <span
                                                        class="material-symbols-outlined text-[10px] text-amber-400">crown</span>
                                                    <span
                                                        class="text-[10px] font-bold text-amber-400 uppercase tracking-wide">Owner</span>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-1.5 mt-0.5">
                                                    <span
                                                        class="material-symbols-outlined text-[10px] text-amber-400">person</span>
                                                    <span
                                                        class="text-[10px] font-bold text-amber-400 uppercase tracking-wide">Member</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-primary">0</span>
                                </div>
                            @endforeach
                            {{-- <div
                                class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors group cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-lg bg-indigo-900/50 flex items-center justify-center text-lg font-bold text-indigo-200 uppercase">
                                        SK
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">Sarah Kovac</span>
                                        <span class="text-[10px] text-slate-400">Master Bedroom</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-primary">0</span>
                            </div>
                            <div
                                class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors group cursor-pointer border border-primary/30">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-lg bg-primary/20 flex items-center justify-center text-lg font-bold text-primary uppercase">
                                        ME
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white">You</span>
                                        <span class="text-[10px] text-slate-400">Room B</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-primary">0</span>
                            </div> --}}

                            <div
                                class="flex items-center justify-between p-3 rounded-xl border border-dashed border-white/10 hover:bg-white/5 transition-colors cursor-pointer opacity-70 hover:opacity-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-lg bg-transparent border border-white/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-400">add</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-slate-300">Invite Member</span>
                                        <span class="text-[10px] text-slate-500">Room C Vacant</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Modal Overlay -->
        <div id="modal" class="fixed hidden inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
            <!-- Modal Content -->
            <div class="w-full max-w-[560px] bg-white rounded-xl shadow-2xl overflow-hidden border border-slate-100">
                <!-- Header -->
                <div class="px-8 pt-8 pb-4">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-2xl font-bold text-slate-900">Add New Expense</h2>

                    </div>
                    <p class="text-slate-500 text-sm">Fill in the details below to split a new expense with your roommates.
                    </p>
                </div>
                <!-- Form Body -->
                <form id="expenseForm" action="{{ route('expense.store',$colocation) }}" method="POST">
                    @csrf
                <div class="px-8 py-4 space-y-6 max-h-[70vh] overflow-y-auto">
                    <!-- Expense Title -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Expense Title</label>
                        <div class="relative">
                            <input name="expenseTitle"
                                class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-slate-400"
                                placeholder="e.g. Weekly Groceries" type="text" />
                            <span
                                class="material-symbols-outlined absolute right-3 top-3 text-slate-400">shopping_cart</span>
                        </div>
                    </div>
                    <!-- Amount & Category Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Amount</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-slate-500 font-medium">$</span>
                                <input name="amount"
                                    class="w-full pl-8 pr-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                    placeholder="0.00" type="number" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Category</label>
                            <select name="categoryId"
                                class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all appearance-none bg-no-repeat bg-[right_1rem_center]"
                                style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%2394a3b8%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E'); background-size: 1.25rem;">
                                <option value="">Select Category</option>
                                @foreach ($colocation->categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Payer Selection (Avatar Dropdown) -->
                    <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Paid by</label>
                            <div class="relative">
                                <span
                                class="absolute left-2 top-3 material-symbols-outlined text-slate-400">person</span>
                                <select name="payerId"
                                    class="w-full pl-8 pr-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                    placeholder="0.00" type="number">
                                    @foreach ($colocation->memberships as $membership )
                                    <option value="{{ $membership->user->id }}">{{ $membership->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <!-- Date Picker Area -->
                     <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Date of Expenses</label>
                            <div class="relative">
                                <input name="expenseDate"
                                    class="w-full pl-8 pr-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                    type="date" />
                            </div>
                        </div>

                </div>
                <!-- Footer Actions -->
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex items-center gap-4">
                    <button id="cancelExpense" type="button"
                        class="flex-1 px-6 py-3.5 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-white hover:shadow-sm transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-[2] px-6 py-3.5 rounded-lg bg-primary text-background-dark font-bold shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xl">receipt_long</span>
                        Create Expense
                    </button>
                </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        modal = document.getElementById('modal');
        form = document.getElementById('expenseForm');

        createexpense = document.getElementById('createExpense');
        cancelexpense = document.getElementById('cancelExpense');

        createexpense.addEventListener("click", function(event) {
            modal.classList.remove('hidden');
        });

        cancelexpense.addEventListener("click", function(event) {
            modal.classList.add('hidden');
            form.reset();
        });
    </script>
@endsection
