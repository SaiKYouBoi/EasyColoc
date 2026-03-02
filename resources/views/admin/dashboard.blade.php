@extends('layouts.main')
@section('content')
    <div class="flex-1 overflow-y-auto p-8 space-y-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">User Managment</h1>
                <p class="text-slate-500 mt-1">Overview of your dashboard<span class="font-medium text-slate-900"></span></p>
            </div>
        </div>
        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white dark:bg-background-dark/40 p-6 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-primary/10 rounded-lg">
                        <span class="material-symbols-outlined text-primary">groups</span>
                    </div>

                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Users</p>
                <h3 class="text-3xl font-display font-bold mt-1">{{ number_format($totalUsers) }}</h3>
            </div>
            <div
                class="bg-white dark:bg-background-dark/40 p-6 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-blue-500/10 rounded-lg">
                        <span class="material-symbols-outlined text-blue-500">home_work</span>
                    </div>

                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Colocations</p>
                <h3 class="text-3xl font-display font-bold mt-1">{{ number_format($totalColocations) }}</h3>
            </div>
            <div
                class="bg-white dark:bg-background-dark/40 p-6 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-amber-500/10 rounded-lg">
                        <span class="material-symbols-outlined text-amber-500">account_balance_wallet</span>
                    </div>

                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Expenses</p>
                <h3 class="text-3xl font-display font-bold mt-1">{{ number_format($totalExpenses) }} MAD</h3>
            </div>
            <div
                class="bg-white dark:bg-background-dark/40 p-6 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-red-500/10 rounded-lg">
                        <span class="material-symbols-outlined text-red-500">gavel</span>
                    </div>

                </div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Active Bans</p>
                <h3 class="text-3xl font-display font-bold mt-1">{{ number_format($activeBans) }}</h3>
            </div>
        </div>
        <!-- Data Table Section -->
        <div
            class="bg-white dark:bg-background-dark/40 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm overflow-hidden flex flex-col">
            <!-- Filters -->

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-primary/5 bg-slate-50/50 dark:bg-primary/5">
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-primary/60 uppercase tracking-wider">
                                User</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-primary/60 uppercase tracking-wider">
                                Join Date</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-primary/60 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-primary/60 uppercase tracking-wider text-right">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-primary/5">
                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-full bg-cover bg-center border border-primary/20"
                                            data-alt="User avatar profile picture"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCuZJZdUAewKX_uMvHshSTCqMp50BiMmwmNCdlur_UJmxPlzf92ylMD8ia7298boQw1HfC8a9fEG0suImKtTFjbv2_9F20n_ig11anlUwupo0etUf8cS-jOalINpF6oJB0RHzWWd2F5ex5O9HBcbdAm8xeRKNTRixQCn-SpGteE6QVEuNYSwC_IIBZMXgCfwX63-0_5l74SvJBC1_lSTcWWZMDQbprc8AtexSDjB-aKiT6hzBEIZF48A2ozptb4VWtiWJlYijk40aQ')">
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($user->is_banned)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-500/20 text-slate-700 dark:text-slate-400 text-xs font-bold italic">
                                            <span class="size-1.5 rounded-full bg-slate-500"></span>
                                            Banned
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                            Active
                                        </span>
                                    @endif
                                </td>
                                @if ($user->id !== auth()->id())
                                @if ($user->is_banned)
                                    <form action="{{ route('admin.user.unban', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <td class="px-6 py-4 text-right">
                                            <button
                                                class="px-4 py-2 rounded-lg bg-primary/10 text-primary-dark dark:text-primary text-xs font-bold flex items-center gap-2 ml-auto hover:bg-primary/20 transition-all border border-primary/20">
                                                <span class="material-symbols-outlined text-sm">how_to_reg</span>
                                                Unban
                                            </button>
                                        </td>
                                    </form>
                                @else
                                    <form action="{{ route('admin.user.ban', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <td class="px-6 py-4 text-right">
                                            <button
                                                class="px-4 py-2 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-bold flex items-center gap-2 ml-auto hover:bg-red-100 dark:hover:bg-red-500/20 transition-all border border-transparent hover:border-red-200 dark:hover:border-red-500/30">
                                                <span class="material-symbols-outlined text-sm">person_off</span>
                                                Ban User
                                            </button>
                                        </td>
                                    </form>
                                @endif
                                @endif
                            </tr>
                            @endforeach
                            {{-- <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-full bg-cover bg-center border border-primary/20"
                                            data-alt="User avatar profile picture"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBD50PKy5sJ6ErkLfxdPzyUt8us97QpOcvMfhHxhJXQpfBHKSehKzXdroQmnqMHupN6G_vplbOaPEpLimLXBzyAiAGRHBS5jB8KeTAAi-LBWyqpAJQCltXsLz4m7_toNnakHqC8sHwS-APLk8xeoulhcLAgFOjVJOzejYQMdQXav_Y9Ulqs3qFF4H5mKz8hbMn7JTQTP6V-ZzW-2vSWKtbJHHglXpEx_JHnF4eTM8JR1NGd_Yt2nc08gyKBYGIPYbt52xD7x1DOWco')">
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">Sarah Jenkins</p>
                                            <p class="text-xs text-slate-500">s.jenkins@icloud.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium">Sep 28, 2023</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-500/20 text-slate-700 dark:text-slate-400 text-xs font-bold italic">
                                        <span class="size-1.5 rounded-full bg-slate-500"></span>
                                        Banned
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="px-4 py-2 rounded-lg bg-primary/10 text-primary-dark dark:text-primary text-xs font-bold flex items-center gap-2 ml-auto hover:bg-primary/20 transition-all border border-primary/20">
                                        <span class="material-symbols-outlined text-sm">how_to_reg</span>
                                        Unban
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-full bg-cover bg-center border border-primary/20"
                                            data-alt="User avatar profile picture"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA1kw4GOSEkxRvnBVYsVNXoC8z3D-ip7-mVR7lwT4s-gQrWjrg7GupPGkCIohglxZfItydI2OxQJ430k6zdTGqyt06COyvzMncQ3W5DrwdeSb7p_nmXzoKMihCEI2yFk0EXEagI_Tt-yi3WIyBMeNPTBrAzFRAUJzPNWVFiVtftL9_UnfM__9bgzprCSNmWL1t3y2azryiYxLYJ9VoFCgft0zpGW-u2V1lKXLbzhmGP_G-UVof2eVQIRKI3E3sn-AFcG-314yY31ig')">
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">David Chen</p>
                                            <p class="text-xs text-slate-500">d.chen@enterprise.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium">Nov 04, 2023</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="px-4 py-2 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-bold flex items-center gap-2 ml-auto hover:bg-red-100 dark:hover:bg-red-500/20 transition-all border border-transparent hover:border-red-200">
                                        <span class="material-symbols-outlined text-sm">person_off</span>
                                        Ban User
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-10 rounded-full bg-cover bg-center border border-primary/20"
                                            data-alt="User avatar profile picture"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC7nVpIucTkSj5vA0_8l5ngRiDCi5KscI0N4atsRTqIV9OEstcqUeE34MDu8Il1s6GB3R2JiWBvIo4LF1o1T7WlGgqZ93pxB9-PSjREWLXrtWEMb24Kf_VQ94WgT3zMVitKax99BDfdr1Nu90HQd3E7g05lPDKX3QqrkmbpP92H4G_Zei8N1BD4-FUFJue5LhkPlqudL2SKAIeS5NKEFdYRijqwxvIs9AFQxC6ScRVLORtBuEbooTYcSyqEfPQAAR8Hrv124yupmhM')">
                                        </div>
                                        <div>
                                            <p class="font-bold text-sm">Elena Rodriguez</p>
                                            <p class="text-xs text-slate-500">erod@univ-mail.es</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium">Dec 01, 2023</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="px-4 py-2 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 text-xs font-bold flex items-center gap-2 ml-auto hover:bg-red-100 dark:hover:bg-red-500/20 transition-all border border-transparent hover:border-red-200">
                                        <span class="material-symbols-outlined text-sm">person_off</span>
                                        Ban User
                                    </button>
                                </td>
                            </tr> --}}
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->

        </div>
    </div>
@endsection
