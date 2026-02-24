<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Login Screen</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
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
                        "primary-dark": "#0ea682", // Darker shade for hover states or text
                        "background-light": "#f6f8f8",
                        "background-dark": "#10221d",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a332d",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'card': '0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025)',
                    }
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display text-slate-900 dark:text-slate-100">
    <!-- Header / Nav (Simplified for Login Context) -->
    <header class="w-full px-6 py-4 flex items-center justify-between fixed top-0 left-0 z-50">
        <div class="flex items-center gap-2 cursor-pointer">
            <div class="size-8 text-primary flex items-center justify-center rounded-lg bg-primary/10">
                <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
            </div>
            <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">EasyColoc</h2>
        </div>
    </header>
    <main class="flex-1 flex items-center justify-center p-6 mt-16">
        <div
            class="max-w-[520px] w-full bg-white dark:bg-slate-900 rounded-xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="h-2 bg-primary"></div>
            <div class="p-8 md:p-12 text-center">
                <div class="mb-8 flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full"></div>
                        <div
                            class="relative size-20 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-4xl"
                                style="font-variation-settings: 'wght' 300;">lock_person</span>
                        </div>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Account Access Restricted</h2>
                <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed mb-8">
                    To maintain the integrity of the EasyColoc community, your account has been temporarily suspended
                    due to activity that appears to violate our <a
                        class="text-primary hover:underline underline-offset-4" href="#">Terms of Service</a>.
                </p>
                <div
                    class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-6 mb-8 text-left border border-slate-100 dark:border-slate-800">
                    <div class="flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">What does this mean?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">During this review period, you
                                will be unable to access your roommate listings, messages, or payment history.</p>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col gap-3">
                    <button
                        class="w-full py-3.5 px-6 bg-primary text-background-dark font-bold rounded-lg hover:brightness-105 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">support_agent</span>
                        Contact Support Team
                    </button>
                    <a href="{{ route('login') }}">
                    <button
                        class="w-full py-3.5 px-6 text-slate-600 dark:text-slate-400 font-semibold rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                        Log out
                    </button>
                    </a>
                </div>
            </div>
            <div class="px-8 pb-8 text-center">
                <p class="text-xs text-slate-400 dark:text-slate-500">
                    If you believe this is a mistake, please reach out to our compliance department. Reviews typically
                    take 24-48 business hours.
                </p>
            </div>
        </div>

    </main>
 <div class="mb-8 flex justify-center gap-6 text-slate-400 dark:text-slate-600">
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors"
                    href="#">Privacy Policy</a>
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors" href="#">Terms
                    of Service</a>
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors" href="#">Help
                    Center</a>
            </div>
</body>

</html>
