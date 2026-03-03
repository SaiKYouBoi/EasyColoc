<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc | Invitation</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ecb6",
                        "background-light": "#f6f8f8",
                        "background-dark": "#10221d",
                        "slate-custom": "#64748b",
                        "navy-custom": "#0f172a"
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "1rem"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<section class="bg-white rounded-[12px] shadow-soft border border-slate-100 overflow-hidden"
    data-purpose="invitation-card">
    <!-- Content Padding -->
    <div class="p-10 text-center">
        <!-- Headline -->
        <h1 class="text-2xl md:text-3xl font-bold text-brandDark tracking-tight mb-4">
            You're invited to join {{ $invitation->colocation->name }}
        </h1>
        <!-- Invitation Message -->
        <p class="text-slate-600 text-lg leading-relaxed mb-8 max-w-sm mx-auto">
            <span class="font-semibold text-slate-900">Your friend</span> has invited you to start sharing expenses
            effortlessly.
        </p>
        <!-- Call to Action -->
        <div class="mb-10" data-purpose="action-area">
            <a href="{{ route('invitations.accept', $invitation->token) }}"
                class="inline-block bg-primary hover:opacity-90 text-brandDark font-bold py-4 px-10 rounded-[12px] transition-all duration-200 transform hover:scale-[1.02]"
                href="#" style="background-color: #13ecb6;">
                Join Colocation
            </a>
        </div>
        <!-- Secondary Info/Visual -->
        <div class="pt-8 border-t border-slate-100">
            <p class="text-sm text-slate-500 italic">
                "Managing bills shouldn't be the hardest part of living together."
            </p>
        </div>
    </div>
    
</section>

{{-- <body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col antialiased">
    <!-- Top Navigation / Logo Header -->
    <header class="w-full flex justify-center pt-12 pb-8">
        <div class="flex items-center gap-2">
            <div class="bg-primary p-2 rounded-lg flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-navy-custom text-2xl">account_balance_wallet</span>
            </div>
            <h1 class="text-navy-custom dark:text-slate-100 text-xl font-bold tracking-tight">EasyColoc</h1>
        </div>
    </header>
    <!-- Main Invitation Content -->
    <main class="flex-1 flex items-center justify-center px-6 pb-20">
        <div
            class="max-w-[480px] w-full bg-white dark:bg-slate-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 dark:border-slate-800 overflow-hidden">
            <!-- Hero Image / Location Context -->
            <div class="h-48 bg-slate-100 relative">
                <div class="absolute inset-0 bg-cover bg-center"
                    data-alt="Modern minimalist apartment interior living room" data-location="Sunnyvale"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBQwok5Ull2s6bHeDzHVmCSpXflheve4K6cuzpYaFxIXJOmUwV47O9ljTpgcvA8EJiY1ytPdEdcxQrcy6TPMtMUwcXdMUIrAYkiA_oTRXWqF39yJwlGyoEEB-MjY5-tFiwMvfWdjznDcSHnLir7fODAR28p7nozgfrok1UCAUcXQBmVjRuoi-YM_Al-jij6p9ZzG-o-vqi0S_cMky5FYGIaEkW3FBardAf8kBBanxgNmjNWPT7fq4AFhOVlqJXnHHwe-xtlg5myu64')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                <div class="absolute bottom-4 left-6 flex items-center gap-2 text-white">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    <span class="text-xs font-medium uppercase tracking-wider">Sunnyvale Apt 4B</span>
                </div>
            </div>
            <div class="p-8">
                <!-- Invitation Text -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-navy-custom dark:text-white leading-tight mb-3">You've been
                        invited to {{ $invitation->colocation->name }}</h2>
                    <p class="text-slate-custom dark:text-slate-400 text-sm leading-relaxed">
                        Join your roommates to track shared expenses, split utility bills, and manage household tasks in
                        one professional dashboard.
                    </p>
                </div>
                <!-- Inviter Details -->
                <div
                    class="flex items-center p-4 bg-background-light dark:bg-slate-800/50 rounded-xl mb-8 border border-slate-50 dark:border-slate-800">
                    <div class="relative flex -space-x-2 mr-4">
                        <img alt="Alex Johnson"
                            class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-900"
                            data-alt="Alex Johnson profile portrait"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDT85YIUiCoM5RLQsv7VSwdzSfp5WWfnMPrbnuFnggDRzVF6UL9F_H2i3HmRoKlNWbFqutJaE2FrUQUxMM27O5hTuOgQeI5eOT87kEGzdReww12mYF13kwvvriuQveM4UGKT--Bv5S5xIrxdchqQkqHQm7J9zMf6Qrn6_zmqdpZo7WswfbJg5TYkMMyWNwTBw5eEOED1BoaWcX7DfiKloKwUAMyH4QOuDjH3RKHwhx9t4qXhvqG4dWs6oMXMxMqX6s0r59oWnUMi-U" />
                        <div
                            class="flex items-center justify-center h-10 w-10 rounded-full ring-2 ring-white dark:ring-slate-900 bg-primary/20 text-xs font-bold text-navy-custom">
                            +2
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-navy-custom dark:text-slate-200">Alex Johnson <span
                                class="font-normal text-slate-custom">invited you</span></p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="flex h-2 w-2 rounded-full bg-primary"></span>
                            <p class="text-[11px] font-medium text-slate-custom uppercase tracking-wide">3 Members
                                Active</p>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('invitations.accept', $invitation->token) }}" class="w-full bg-primary hover:bg-primary/90 text-navy-custom font-bold py-4 rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                        <span>Accept Invitation</span>
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </a>
                    <button
                        class="w-full bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-custom dark:text-slate-300 font-semibold py-4 rounded-xl transition-all">
                        Decline
                    </button>
                </div>
                <!-- Security / Trust Indicator -->
                <div
                    class="mt-8 flex items-center justify-center gap-4 text-[11px] text-slate-400 dark:text-slate-500 font-medium">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>SECURE SETUP</span>
                    </div>
                    <div class="h-1 w-1 bg-slate-300 rounded-full"></div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">verified_user</span>
                        <span>PRIVACY PROTECTED</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer Description -->
    <footer class="w-full py-8 px-6 text-center">
        <p class="text-slate-custom dark:text-slate-500 text-sm max-w-md mx-auto">
            EasyColoc is a premium colocation management platform used by over 10,000 households to automate shared
            finances.
        </p>
    </footer>
</body> --}}

</html>
