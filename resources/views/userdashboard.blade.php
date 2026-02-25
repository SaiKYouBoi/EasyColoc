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
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard</h1>
                    <p class="text-slate-500 mt-1">Overview of your shared finances for <span
                            class="font-medium text-slate-900">Sunnyvale Apt 4B</span></p>
                </div>
                <button
                    class="bg-primary hover:bg-primary-dark text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all shadow-sm shadow-primary/20">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Add Expense
                </button>
            </div>
            <!-- Financial Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Expenses -->
                <div
                    class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between h-40 group hover:border-primary/30 transition-colors">
                    <div class="flex justify-between items-start">
                        <div
                            class="p-2 bg-slate-50 rounded-lg text-slate-600 group-hover:bg-primary/10 group-hover:text-primary-dark transition-colors">
                            <span class="material-symbols-outlined">payments</span>
                        </div>

                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Expenses</p>
                        <h3 class="text-2xl font-bold text-slate-900 mt-1">$3,240.00</h3>
                    </div>
                </div>
                <!-- Your Balance -->
                <div
                    class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between h-40 group hover:border-primary/30 transition-colors relative overflow-hidden">
                    <div
                        class="absolute right-0 top-0 h-24 w-24 bg-primary/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110">
                    </div>
                    <div class="flex justify-between items-start relative z-10">
                        <div class="p-2 bg-primary/10 rounded-lg text-primary-dark">
                            <span class="material-symbols-outlined">account_balance_wallet</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p class="text-sm font-medium text-slate-500">Your Balance</p>
                        <h3 class="text-2xl font-bold text-primary-dark mt-1">+$120.50</h3>
                    </div>
                </div>
                <!-- You Owe -->
                <div
                    class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between h-40 group hover:border-red-200 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-red-50 rounded-lg text-red-500 group-hover:bg-red-100 transition-colors">
                            <span class="material-symbols-outlined">trending_down</span>
                        </div>

                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">You Owe</p>
                        <h3 class="text-2xl font-bold text-slate-900 mt-1">$45.00</h3>
                    </div>
                </div>
                <!-- You Are Owed -->
                <div
                    class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between h-40 group hover:border-blue-200 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-500 group-hover:bg-blue-100 transition-colors">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">You Are Owed</p>
                        <h3 class="text-2xl font-bold text-slate-900 mt-1">$165.50</h3>
                    </div>
                </div>
            </div>
            <!-- Main Content Split -->
            <div class="grid grid-cols-1">
                <!-- Settlements & Who Owes Whom (Left 2 cols) -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                        <h3 class="font-bold text-lg">Recent Expenses</h3>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 dark:bg-slate-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Title
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Category
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Amount
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Paid By
                                    </th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">
                                        Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-5 font-semibold text-sm">Fiber Internet</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-2.5 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-[11px] font-bold uppercase tracking-tight">Utilities</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-bold">$80.00</td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-200 bg-cover bg-center"
                                                data-alt="Small circular avatar of a man"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCKkaPpjh7dP4pjpYFhxXnBFTwBXrBEg-fAqOnzRaXc83X4QTdqgHuSziI7zbOXsQHgrDvJNb9i1Y8KnAWsnUHdkB97hO9RUyCoVk3VGsEPDCQQGFjLm35CiXVnOn7zkhZSHQjlrKgpBX34brwq_rhWSZi4j0RqH_ixImNyxEQdc7auqynjPR8E01x9ad9zYy-E0GppBmge6BMyYENwR4albKQyjXwWwdEHnarnuufsCCOXiKSGk8sX5mhIsq-AkuxIdkt9cT6yV1k')">
                                            </div>
                                            <span class="text-sm font-medium">Alex M.</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right text-sm text-slate-500">Oct 12, 2023</td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-5 font-semibold text-sm">Organic Groceries</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-full text-[11px] font-bold uppercase tracking-tight">Food</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-bold">$145.20</td>
                                    <td class="px-6 py-5 text-sm font-medium text-primary">You</td>
                                    <td class="px-6 py-5 text-right text-sm text-slate-500">Oct 10, 2023</td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-5 font-semibold text-sm">Rent Payment</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-full text-[11px] font-bold uppercase tracking-tight">Housing</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-bold">$1,800.00</td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-200 bg-cover bg-center"
                                                data-alt="Small circular avatar of a woman"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDt4I8JInl-8kRSZmqBrQDWJ03AnHbwKsrUCrfilTnEhFqGojgAzknu9Lmzf1ddFiZQF3AlqxbNRU1rQdx03Fjxv2ylFsUoPv1VZExqo9Slh5ZubVei3iwkb-85RKxgdppX7c5KMvzQnAP4sZwzYh-JiWViztIX6m2VzbabvZhN_x_0LWOg2G67iRdyvol5MdsbZZxCrNcrgJCakgjv8v5bvmgEfmphzdt2RkC0sDF9lTXXUsD5q7elSB3UfN2NVs5QiLDJ0Gp8IzI')">
                                            </div>
                                            <span class="text-sm font-medium">Sarah K.</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right text-sm text-slate-500">Oct 01, 2023</td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-6 py-5 font-semibold text-sm">Cleaning Supplies</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="px-2.5 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-full text-[11px] font-bold uppercase tracking-tight">Household</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-bold">$24.50</td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="size-6 rounded-full bg-slate-200 bg-cover bg-center"
                                                data-alt="Small circular avatar of a man"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD-ifp6nhW2F2cKlsZdxyUk5WEP5guYMtHG2sdnsoB4Eqn-ZfgATTiNgwnVqedv1We8PGipyp6bP1NMvyCpeQQ1GIXS-Gwhg_-z4SJxnxXICzpzsAx2oXaO7iH5p1bx6kSeKdr8WZCpjGyCE6FDEiMy7Ncf5NzmNy4p7mPfvDk892zfaXKgHGzn1aWQ3boXP293w0QIxgDJe_sq07mplVz8_RBuNinBHIuCYPNOG0DGL1QpUicXgafGIJhgD3KJXYV8PrIetOSiXcM')">
                                            </div>
                                            <span class="text-sm font-medium">Alex M.</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right text-sm text-slate-500">Sep 28, 2023</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-slate-200 dark:border-slate-800 text-center">
                        <button class="text-sm font-semibold text-slate-400 hover:text-primary transition-colors">View All
                            Transactions</button>
                    </div>
                </div>
                <!-- Right Sidebar (Recent Activity) -->
            </div>
        </div>
    </main>
    </div>
@endsection
