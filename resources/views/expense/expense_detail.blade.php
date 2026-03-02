@extends('layouts.main')
@section('content')
    <div class="p-8 max-w-5xl mx-auto w-full">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-slate-500 text-sm font-medium mb-6">
            <a class="hover:text-primary transition-colors" href="#">Expenses</a>
            <span class="material-symbols-outlined text-base">chevron_right</span>
            <span class="text-slate-900 dark:text-white">{{ $expense->title }}</span>
        </nav>
        <!-- Header Info -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">{{ $expense->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 text-slate-500">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">calendar_today</span>
                        <span>{{ $expense->created_at->format('F d, Y') }}</span>
                    </div>
                    <div class="size-1 bg-slate-300 rounded-full"></div>
                    <div
                        class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-sm"></span>
                        {{ $expense->category->name }}
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
               <a href="{{ route('colocations.show', $expense->colocation_id) }}">
                <button
                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-bold text-sm hover:bg-slate-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">arrow_circle_left</span>
                    Back
                </button>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Primary Card: Payer & Amount -->
            <div class="lg:col-span-1 flex flex-col gap-6">
                <div
                    class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 group-hover:bg-primary/10 transition-colors">
                    </div>
                    <p class="text-slate-500 text-sm font-semibold uppercase tracking-widest mb-6">Payer</p>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="size-14 rounded-full border-2 border-primary/20 p-1">
                            <div
                                class="size-full rounded-full bg-slate-50 bg-primary/20 flex items-center justify-center text-lg font-bold text-primary uppercase">
                                {{ ucfirst(substr($expense->payer->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">
                                {{ $expense->payer->name }}</h3>
                            <p class="text-slate-500 text-sm">Full amount paid</p>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-slate-500 text-sm font-medium mb-1">Total Paid</p>
                        <div class="flex items-baseline gap-1">
                            <span
                                class="text-4xl font-black text-slate-900 dark:text-white">{{ number_format($expense->amount, 2) }}</span>
                            <span class="text-xl font-bold text-primary italic tracking-tight">MAD</span>
                        </div>
                    </div>
                </div>
                <!-- Category Breakdown (Small Secondary card) -->
                <div class="bg-slate-900 text-white p-6 rounded-2xl shadow-lg shadow-slate-200/50 relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Merchant</span>
                            <span class="material-symbols-outlined text-primary">verified</span>
                        </div>
                        <p class="text-lg font-bold mb-1">Carrefour Market</p>
                        <p class="text-slate-400 text-xs mb-4">Downtown Branch • #49281</p>
                        <div class="h-2 w-full bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-primary w-3/4"></div>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-2 italic font-medium">75% of monthly grocery budget used</p>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10">
                        <span class="material-symbols-outlined text-8xl">receipt</span>
                    </div>
                </div>
            </div>
            <!-- Members involved -->
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">groups</span>
                            Members involved
                        </h2>

                    </div>
                    <div class="divide-y divide-slate-50 dark:divide-slate-800">
                        @foreach ($expense->splits as $split)
                            <!-- Member Row 1 -->
                            <div
                                class="p-6 flex items-center justify-between hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="size-14 rounded-full border-2 border-primary/20 p-1">
                                        <div
                                            class="size-full rounded-full bg-slate-50 bg-primary/20 flex items-center justify-center text-lg font-bold text-primary uppercase">
                                            {{ ucfirst(substr($split->debtor->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 dark:text-white">{{ $split->debtor->name }}</h4>
                                        @if ($split->user_id === $expense->payer_id)
                                            (You)
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-8">
                                    <div class="text-right">
                                        <p class="text-slate-900 dark:text-white font-bold">
                                            {{ number_format($split->amount, 2) }} MAD</p>
                                        @if ($split->status == 'paid')
                                            <span
                                                class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                                                <span class="material-symbols-outlined text-xs">check_circle</span>
                                                Paid</span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                                                <span class="material-symbols-outlined text-xs">schedule</span>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                    @php
                                        $isOwner = auth()->id() === $expense->payer_id;
                                        $isSelf = auth()->id() === $split->debtor_id;
                                    @endphp
                                    @if ($split->status === 'paid')
                                        <button
                                            class="h-10 w-24 rounded-xl text-slate-400 font-bold text-sm cursor-not-allowed">
                                            Settled
                                        </button>
                                    @else
                                        @if ($isOwner || $isSelf)
                                            <form method="POST" action="{{ route('splits.markPaid', $split->id) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    class="h-10 w-24 rounded-xl bg-primary text-slate-900 font-bold text-sm hover:brightness-105 transition-all shadow-md shadow-primary/20">
                                                    Mark Paid
                                                </button>
                                            </form>
                                        @else
                                            <button
                                                class="h-10 w-24 rounded-xl text-slate-400 font-bold text-sm cursor-not-allowed">
                                                Pending
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        {{-- <!-- Member Row 2 -->
                        <div
                            class="p-6 flex items-center justify-between hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <div class="flex items-center gap-4">
                                <img alt="Marc" class="size-11 rounded-full bg-slate-100"
                                    data-alt="Avatar for roommate Marc"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4tA0obkZMIph3fv4r-SGGh_TiR4RzNM3sGH-lFI3WdvMkM7u3arnEMa4jWDtyRtXItTODJqU3L1V_e2nJxHZ3NGPfYPk4x-QC1RaFtT0ZX0rCRLhb8T3yIzO40jr69Ri0Qff9nAipVDNcQh-xvYEKxJ-RzG2tJ6q6U97X2M13f_NzAf1Fd3H57EZRjQdMpBdXxy79jw2lw2ITZpQz7ENp3EAWprPFImVQ1QJZiGI-CKLmmra4A89lDFtRmasz5S5QqeSLSxIC5dI" />
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white">Marc Haddad</h4>
                                    <p class="text-slate-500 text-xs">Equal split (1/3)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-8">
                                <div class="text-right">
                                    <p class="text-slate-900 dark:text-white font-bold">166.66 DH</p>
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                                        <span class="material-symbols-outlined text-xs">schedule</span>
                                        Pending
                                    </span>
                                </div>
                                <button
                                    class="h-10 w-24 rounded-xl bg-primary text-slate-900 font-bold text-sm hover:brightness-105 transition-all shadow-md shadow-primary/20">
                                    Pay
                                </button>
                            </div>
                        </div>

                        <!-- Member Row 3 (Payer - doesn't pay self) -->
                        <div class="p-6 flex items-center justify-between bg-slate-50/30 dark:bg-slate-800/10">
                            <div class="flex items-center gap-4 opacity-60">
                                <img alt="Alex" class="size-11 rounded-full bg-slate-100 border-2 border-primary/40"
                                    data-alt="Avatar for payer Alex Johnson"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGN_GKAR27yU9P6vuMTcrnVT-Fiqxp-CosLf0o-oS3j7MjlgyaEs1gf87bXJXCGnaOXGqwjkdV8pJa-ky53q5XEQmBMDs_1xmKiZF7mNfMrc3XyzkIg0USVDS5_iEBex9b3pGuyBa3kw_VmZ6mdvBWWV8_UozFraAc6iIy5Y9jrR962mO6EIAFD6IPM19y3rHJ6Xj7pa9Rv8IdIWcHkgwlYkhFlOiPjPjUECYvJfaa_yM9hzRsf12z-vG89dmEytfPm5fwH8uVjQU" />
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white">Alex Johnson (You)</h4>
                                    <p class="text-slate-500 text-xs">Payer's share</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-8">
                                <div class="text-right opacity-60">
                                    <p class="text-slate-900 dark:text-white font-bold">166.68 DH</p>
                                    <span
                                        class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full">
                                        Self
                                    </span>
                                </div>
                                <div class="w-24 text-center">
                                    <span class="material-symbols-outlined text-slate-300">account_balance_wallet</span>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="p-6 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-400">info</span>
                                <p class="text-slate-500 text-xs font-medium">Automatic settlement will trigger once all
                                    roommates pay their share.</p>
                            </div>
                            <button class="text-primary text-xs font-bold hover:underline">Remind all</button>
                        </div>
                    </div>
                </div>
                <!-- Split Details Info Card -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-start gap-4">
                        <div class="bg-indigo-50 dark:bg-indigo-900/30 p-3 rounded-xl text-indigo-600">
                            <span class="material-symbols-outlined">pie_chart</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Split Logic</h4>
                            <p class="text-slate-500 text-xs mt-1">Split equally among everyone. Tax (2.5%) was included in
                                the final amount.</p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-start gap-4">
                        <div class="bg-primary/10 p-3 rounded-xl text-primary">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Receipt Note</h4>
                            <p class="text-slate-500 text-xs mt-1">Bought weekly supplies for the kitchen, laundry
                                detergents, and coffee pods.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
