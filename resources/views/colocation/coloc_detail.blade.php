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
                    @if ($balance < 0)
                        <div>
                            <p class="text-slate-500 text-xs font-medium uppercase tracking-wide">Your Balance</p>
                            <h3 class="text-2xl font-bold tracking-tight text-red-500 mt-1">{{ number_format($balance, 2) }}
                                MAD</h3>
                        </div>
                    @elseif ($balance > 0)
                        <div>
                            <p class="text-slate-500 text-xs font-medium uppercase tracking-wide">Your Balance</p>
                            <h3 class="text-2xl font-bold tracking-tight text-green-500 mt-1">
                                +{{ number_format($balance, 2) }} MAD</h3>
                        </div>
                    @else
                        <div>
                            <p class="text-slate-500 text-xs font-medium uppercase tracking-wide">Your Balance</p>
                            <h3 class="text-2xl font-bold tracking-tight mt-1">0 MAD</h3>
                        </div>
                    @endif
                    <span class="material-symbols-outlined text-slate-300 text-3xl">account_balance_wallet</span>
                </div>

            </section>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
                <section class="xl:col-span-2 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Expenses</h2>
                        <div class="flex gap-4">
                            <a href="{{ route('categories.show', $colocation) }}">
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

                            <input type="month" name="monthFilter" id="monthPicker" value="{{ request('monthFilter') }}"
                                class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 px-3 py-1.5 rounded-lg text-sm font-medium flex items-center gap-2 hover:border-primary transition-colors">
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
                                    @foreach ($expenses as $expense)
                                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-bold text-sm text-slate-900 dark:text-white">{{ $expense->title }}</span>
                                                    <span
                                                        class="text-xs text-slate-500 font-medium">{{ $expense->category->name ?? 'No Category' }}
                                                        • {{ $expense->date->format('M d, Y') }}</span>
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
                                            <td class="px-6 py-5 text-sm font-bold">
                                                {{ number_format($expense->amount, 2) }}
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
                                {{-- <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
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
                                </div> --}}
                                <!-- Row 2: Alex M. owes You -->

                                @foreach ($balances as $userId => $amount)
                                    @php
                                        $otherUser = $members[$userId];
                                    @endphp

                                    <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                                        <div class="flex items-center gap-3">

                                            <div class="flex -space-x-2">

                                                <!-- Me -->
                                                <div
                                                    class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                    {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                                </div>

                                                <!-- Other Person -->
                                                <div
                                                    class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                    {{ ucfirst(substr($otherUser->name, 0, 1)) }}
                                                </div>

                                            </div>

                                            <div class="flex flex-col">

                                                @if ($amount > 0)
                                                    <p class="text-xs font-bold text-slate-900 dark:text-white">
                                                        {{ $otherUser->name }} owes you
                                                    </p>
                                                    <span class="text-[11px] font-bold text-green-600">
                                                        {{ number_format($amount, 2) }} MAD
                                                    </span>
                                                @else
                                                    <p class="text-xs font-bold text-slate-900 dark:text-white">
                                                        You owe {{ $otherUser->name }}
                                                    </p>
                                                    <span class="text-[11px] font-bold text-red-600">
                                                        {{ number_format(abs($amount), 2) }} MAD
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="flex -space-x-2">
                                            <div
                                                class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                {{ ucfirst(substr($debt->debtor->name,0,1)) }}</div>
                                            <div
                                                class="size-8 rounded-full border-2 border-white dark:border-slate-900 bg-primary/20 flex items-center justify-center text-[10px] font-bold text-primary shadow-sm">
                                                {{ ucfirst(substr($debt->expense->payer->name,0,1)) }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-xs font-bold text-slate-900 dark:text-white">{{ $debt->debtor->name }} owes {{ $debt->expense->payer->name }}</p>
                                            <span class="text-[11px] font-bold text-primary">{{ number_format($debt->amount, 2) }}</span>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Row 3: Sarah K. owes You -->
                                {{-- <div class="flex items-center justify-between py-4 first:pt-0 last:pb-0">
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
                                </div> --}}
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

                                <button type="button" id="createInvite">
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
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <!-- Modal Overlay -->
        <div id="modal"
            class="fixed hidden inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
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
                <form id="expenseForm" action="{{ route('expense.store', $colocation) }}" method="POST">
                    @csrf
                    <div class="px-8 py-4 space-y-6 max-h-[70vh] overflow-y-auto">
                        <!-- Expense Title -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Expense Title</label>
                            <div class="relative">
                                <input name="expenseTitle"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-slate-400"
                                    placeholder="e.g. Weekly Groceries" type="text" required />
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
                                        placeholder="0.00" type="number" required />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Category</label>
                                <select name="categoryId"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all appearance-none bg-no-repeat bg-[right_1rem_center]"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27%2394a3b8%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E'); background-size: 1.25rem;">
                                    <option value="">Select Category</option>
                                    @foreach ($colocation->categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Payer Selection (Avatar Dropdown) -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Paid by</label>
                            <div class="relative">
                                <span class="absolute left-2 top-3 material-symbols-outlined text-slate-400">person</span>
                                <select name="payerId"
                                    class="w-full pl-8 pr-4 py-3 rounded-lg border border-slate-200 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                                    placeholder="0.00" type="number">
                                    @foreach ($colocation->memberships as $membership)
                                        <option value="{{ $membership->user->id }}">{{ $membership->user->name }}
                                        </option>
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
                                    type="date" required />
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
    {{-- Category Modal --}}
    <!-- Modal Overlay -->
    <div id="inviteModal"
        class="fixed hidden inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div
            class="bg-white dark:bg-zinc-900 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-slate-200 dark:border-zinc-800">
            <div class="p-8">
                <!-- Header Component Variation -->
                <div class="flex flex-col gap-2 mb-8">
                    <h2 class="text-slate-900 dark:text-slate-100 text-2xl font-bold tracking-tight">Add New
                        Member
                    </h2>
                    <p class="text-slate-500 dark:text-zinc-400 text-sm font-normal leading-relaxed">
                        Enter the email for the new member.
                    </p>
                </div>
                <form action="" id="inviteForm" method="POST">
                    @csrf
                    <!-- Form Section -->
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-slate-700 dark:text-zinc-300 text-sm font-semibold leading-none">
                                Email
                            </label>
                            <div class="relative">
                                <input name="memberEmail"
                                    class="w-full h-12 px-4 rounded-xl border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 dark:placeholder:text-zinc-500 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                    placeholder="member@easycoloc.ma" type="email" required />
                            </div>
                        </div>
                        <!-- Icon Picker (Optional Enhancement) -->

                    </div>
                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 mt-10">
                        <button id="cancelInvite" type="button"
                            class="px-6 h-11 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-zinc-300 font-semibold text-sm hover:bg-slate-200 dark:hover:bg-zinc-700 transition-colors">
                            Cancel
                        </button>
                        <!-- Overriding primary for user request emerald color while keeping theme structure -->
                        <button type="submit"
                            class="px-6 h-11 rounded-xl bg-[#13ecb6] text-slate-900 font-bold text-sm hover:opacity-90 shadow-lg shadow-[#13ecb6]/20 transition-all active:scale-95">
                            Send invitation
                        </button>
                    </div>
            </div>
            <!-- Bottom Accent -->
            <div class="h-1.5 w-full bg-gradient-to-r from-primary to-[#13ecb6]"></div>
        </div>
        </form>
    </div>

    {{-- Expense Details --}}
    <!-- Header Section -->
    <div id="expenseDetail"
        class="fixed hidden inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div
            class="w-full max-w-lg bg-surface-light dark:bg-surface-dark rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] overflow-hidden border border-slate-100 dark:border-slate-800 transition-colors duration-200">
            <div class="relative p-6 border-b border-slate-100 dark:border-slate-800/50">
                <button
                    class="absolute right-6 top-6 text-text-sub-light dark:text-text-sub-dark hover:text-text-main-light dark:hover:text-text-main-dark transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="flex items-center gap-3 mb-2">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/20 text-primary-dark dark:text-primary">
                        <span class="material-symbols-outlined">wifi</span>
                    </div>
                    <span
                        class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-medium text-text-sub-light dark:text-text-sub-dark">Utility</span>
                </div>
                <h1 class="text-3xl font-bold text-text-main-light dark:text-text-main-dark tracking-tight mb-2">
                    WiFi <span class="text-text-sub-light dark:text-text-sub-dark font-normal mx-2">|</span> 500 DH
                </h1>
                <div class="flex items-center gap-2 text-sm text-text-sub-light dark:text-text-sub-dark">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    <span>Paid by <strong
                            class="text-text-main-light dark:text-text-main-dark font-semibold">Sarah</strong> on
                        Oct 24, 2023</span>
                </div>
            </div>
            <!-- Split Details Section -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-text-main-light dark:text-text-main-dark">Split Breakdown</h2>
                    <div class="text-xs font-medium text-primary uppercase tracking-wider bg-primary/10 px-2 py-1 rounded">
                        2 of
                        4 Settled</div>
                </div>
                <div class="space-y-4">
                    <!-- User Row: Payer (You) -->
                    <div
                        class="flex items-center justify-between p-3 -mx-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="h-12 w-12 rounded-full bg-cover bg-center border-2 border-primary p-0.5"
                                    data-alt="Portrait of Sarah smiling"
                                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAXrG2nR-2rdQz1HJZ2VJadc8Z1B92E_bZ-lqQNfToHreiik-VziQ3oSpkqwJNI5Mu2K6Nd1gPXm5xcO6K71haKPTQHVvwwrPjojOundWB8pEG_Y7EHrv5yQxNY3SKuyE9bKd-CTIQATe2ILcVZ3clhZqPn8HwBtmP-w5maRP4iJdXOZAfcEQSoIciSIl1aQ3dqbH9oKdIzXX8eAnVH8Ie52IuIPoqZlBQCAwebRBhZNpttb3_PwG2C9V6dtRUWBtjaA3EUoYwVwzc');">
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 bg-primary text-[#111816] rounded-full p-0.5 border-2 border-white dark:border-surface-dark">
                                    <span class="material-symbols-outlined text-[12px] font-bold block">check</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <p
                                    class="text-text-main-light dark:text-text-main-dark font-semibold text-base flex items-center gap-2">
                                    Sarah <span
                                        class="text-xs font-normal text-text-sub-light dark:text-text-sub-dark bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">(You)</span>
                                </p>
                                <p class="text-text-sub-light dark:text-text-sub-dark text-sm">Paid 500 DH • 125 DH share
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-primary font-semibold text-sm">Payer</span>
                        </div>
                    </div>
                    <!-- User Row: Mike (Settled) -->
                    <div
                        class="flex items-center justify-between p-3 -mx-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-cover bg-center bg-slate-200 dark:bg-slate-700"
                                data-alt="Portrait of Mike smiling"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBt45ht2w1BpNeHV82_6HqWmkjU8e-vzpAaN9gieVYmRCbt5qwCOq32IIc--T3zr5nckg6CXG07iuLMNJlNk4UGs3bU2NCj1iJnl-jQ7uiqflq-OOm9-MpB_SAEE-A52HWi8uCSq4IHuB4gvLq_SfaTqWGazI1CqtM6zRcSfFJn3qamuDa1CBPXOs0FrNXD0hK5WFz5eiRqbhuBxkt6xtrsuWjV67VcNH1vsySSFU2vk1VXBDk8Pj6i1X_Qg2Byd_i0TLo7qoCk9Lk');">
                            </div>
                            <div class="flex flex-col">
                                <p class="text-text-main-light dark:text-text-main-dark font-semibold text-base">Mike</p>
                                <p class="text-emerald-600 dark:text-emerald-400 text-sm font-medium">Settled 125 DH</p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <label
                                class="flex items-center justify-center cursor-pointer p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                <input checked=""
                                    class="h-5 w-5 rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-surface-dark text-primary focus:ring-primary/20 focus:ring-offset-0 transition-all cursor-pointer"
                                    type="checkbox" />
                            </label>
                        </div>
                    </div>
                    <!-- User Row: Jessica (Pending) -->
                    <div
                        class="flex items-center justify-between p-3 -mx-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-cover bg-center bg-slate-200 dark:bg-slate-700"
                                data-alt="Portrait of Jessica smiling"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBCcX46TUlIgVscQ6Zge2tK8egpeJ25uu8rVR8YoOqFIKWpronGvUt5iXCSl-eY19veSOjJuU0PFqYSga-keWakILlr5MHC6HTsxD9KmNNVwQY3_UgxK0lw4wwOrWig9vweo8T2-yPwmTiuDPaOoW_orXlCbBdqk3LpDqvlwawr5ue4shjN4kgrPllffn64BwQ7n6IBTCEwd6OF8jlwg-dXcyULc_CSti9dr8l4hUNUZhb1NTo8PgXgtaOTUG4N2_nBt9BmfaXYHVQ');">
                            </div>
                            <div class="flex flex-col">
                                <p class="text-text-main-light dark:text-text-main-dark font-semibold text-base">Jessica
                                </p>
                                <p class="text-rose-500 dark:text-rose-400 text-sm font-medium">Owes 125 DH</p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <label
                                class="flex items-center justify-center cursor-pointer p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                <input
                                    class="h-5 w-5 rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-surface-dark text-primary focus:ring-primary/20 focus:ring-offset-0 transition-all cursor-pointer"
                                    type="checkbox" />
                            </label>
                        </div>
                    </div>
                    <!-- User Row: David (Pending) -->
                    <div
                        class="flex items-center justify-between p-3 -mx-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-full bg-cover bg-center bg-slate-200 dark:bg-slate-700"
                                data-alt="Portrait of David looking serious"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC5-H9W65PxvM4ATA5iG3j1Ra8kXNe2E7IaGXmo856Gq-8KkOnts7W7veWcHTlos-P0L3_0AjaOp0tmgOuwScjzjKiqWtkjoXVOwhV_Is2bhPbT6707wCCjJrMSgZYfAuSlkPe3Rzhw_M86OfDlRCMeRg0q0WhOqfR92hh2Ee1x5Zsy6LirMBLWZpLcxuh4h7W-D_Oy8ObnqDt5boqyw4fv2yn3q4nYO_067k0Qk0gwtHVqwXhQe0_bLQ1pjktHe77bQwP1j_WKgLA');">
                            </div>
                            <div class="flex flex-col">
                                <p class="text-text-main-light dark:text-text-main-dark font-semibold text-base">David</p>
                                <p class="text-rose-500 dark:text-rose-400 text-sm font-medium">Owes 125 DH</p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <label
                                class="flex items-center justify-center cursor-pointer p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                <input
                                    class="h-5 w-5 rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-surface-dark text-primary focus:ring-primary/20 focus:ring-offset-0 transition-all cursor-pointer"
                                    type="checkbox" />
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Action Footer -->
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800/50 flex flex-col gap-3">
                    <button
                        class="w-full bg-primary hover:bg-[#10dcb0] text-[#111816] font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">notifications_active</span>
                        Send Reminders
                    </button>
                    <button type="button" id="cancelExpenseDetail"
                        class="w-full bg-transparent hover:bg-slate-50 dark:hover:bg-slate-800/50 text-text-sub-light dark:text-text-sub-dark font-medium py-3 px-4 rounded-lg transition-colors border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

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


        inviteModal = document.getElementById('inviteModal');
        inviteForm = document.getElementById('inviteForm');

        createInvite = document.getElementById('createInvite');
        cancelInvite = document.getElementById('cancelInvite');

        createInvite.addEventListener("click", function(event) {
            inviteModal.classList.remove('hidden');
        });

        cancelInvite.addEventListener("click", function(event) {
            inviteModal.classList.add('hidden');
            inviteForm.reset();
        });

        const monthInput = document.getElementById('monthPicker');

        monthInput.addEventListener('change', function() {
            const selectedMonth = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('monthFilter', selectedMonth);
            window.location.href = url.toString();
        });

        expenseDetail = document.getElementById('expenseDetail');
        expenseDetailForm = document.getElementById('expenseDetailForm');

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
