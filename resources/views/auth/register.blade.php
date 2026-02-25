<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Registration Screen</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ecb6",
                        "primary-dark": "#0ea682",
                        "background-light": "#f8fafc",
                        "background-dark": "#10221d",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a332d",
                        "accent-indigo": "#4338ca", // Deep indigo for accents as requested
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
    class="bg-background-light dark:bg-background-dark font-display min-h-screen flex flex-col antialiased text-slate-900 dark:text-slate-100">
    <header class="w-full px-6 py-4 flex items-center justify-between fixed top-0 left-0 z-50">
        <div class="flex items-center gap-2 cursor-pointer">
            <div class="size-8 text-primary flex items-center justify-center rounded-lg bg-primary/10">
                <span class="material-symbols-outlined text-[24px]">account_balance_wallet</span>
            </div>
            <h2 class="text-slate-900 dark:text-white text-xl font-bold tracking-tight">EasyColoc</h2>
        </div>
        <a href="{{ route('login') }}">
        <button
            class="hidden sm:flex h-10 px-6 items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            Sign In
        </button>
        </a>
    </header>
    <main class="flex-1 flex flex-col items-center justify-center px-4 py-20 w-full relative overflow-hidden">
        <div
            class="absolute top-[-20%] right-[-10%] w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div class="w-full max-w-[480px] flex flex-col">
            <div
                class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-card p-8 sm:p-10 w-full border border-slate-100 dark:border-slate-800/50">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2 tracking-tight">Create an account
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-base">Start managing shared expenses today.</p>
                </div>
                <button
                    class="w-full flex items-center justify-center gap-3 h-12 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-750 transition-colors mb-6 group">
                    <img alt="Google Logo" class="w-5 h-5" data-alt="Google G Logo"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCfG_JkwqHUlv3PYERnHch2IFTwDKgWvB_pIwiq74TqfdJwHgg5Dwk4H23eB6ktaWsLuTSmk5ByP3ldEkjoDyjMiVL3ikTbbIO2brBjqE9jKT_xgV4uL9HrKTjSmnA9ikQeiNx4vNraT03MXXgo9U7_ZzVNy3UBrj-4RWj_a7wV75MyZw_MFvuD3DgebnBwUpR8lOd9w04-qxG1LcGxMeydEYDUbRZvueKtJfl7cKM_kc3fT7je-0cEebTHAUfHweXtKi1t8YHuk4" />
                    <span
                        class="text-slate-700 dark:text-slate-200 font-medium text-sm group-hover:text-slate-900 dark:group-hover:text-white">Sign
                        up with Google</span>
                </button>
                <div class="relative flex py-2 items-center mb-6">
                    <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
                    <span
                        class="flex-shrink-0 mx-4 text-slate-400 dark:text-slate-500 text-xs uppercase font-medium tracking-wider">Or
                        register with email</span>
                    <div class="flex-grow border-t border-slate-200 dark:border-slate-700"></div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                    @csrf
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1" for="name">Full
                            Name</label>
                        <div class="relative group">
                            <span
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">person</span>
                            </span>
                            <input
                                class="w-full h-11 pl-10 pr-4 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm"
                                id="name" placeholder="John Doe" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex flex-col gap-1.5 mt-4">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1"
                            for="email">Email address</label>
                        <div class="relative group">
                            <span
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">mail</span>
                            </span>
                            <input
                                class="w-full h-11 pl-10 pr-4 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm"
                                id="email" placeholder="name@company.com" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex flex-col gap-1.5 mt-4">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1"
                            for="password">Password</label>
                        <div class="relative group">
                            <span
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </span>
                            <input
                                class="w-full h-11 pl-10 pr-10 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm"
                                id="password" placeholder="Create a password" type="password" name="password" required
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <button
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors focus:outline-none"
                                type="button">

                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5 mt-4">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 ml-1"
                            for="password_confirmation">Confirm Password</label>
                        <div class="relative group">
                            <span
                                class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </span>
                            <input
                                class="w-full h-11 pl-10 pr-10 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all text-sm"
                                id="password_confirmation" placeholder="Create a password" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            <button
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors focus:outline-none"
                                type="submit">
                            </button>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <button
                        class="w-full h-11 mt-4 bg-primary hover:bg-opacity-90 active:scale-[0.98] text-slate-900 font-bold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2 group"
                        type="submit">
                        <span>Create Account</span>
                        <span
                            class="material-symbols-outlined text-[18px] group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-500 dark:text-slate-400">
                    Already have an account?
                    <a class="font-semibold text-primary-dark dark:text-primary hover:underline" href="{{ route('login') }}">Log
                        in</a>
                </p>
            </div>
            <div class="mt-8 flex justify-center gap-6 text-slate-400 dark:text-slate-600">
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors"
                    href="#">Privacy Policy</a>
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors"
                    href="#">Terms
                    of Service</a>
                <a class="text-xs hover:text-slate-600 dark:hover:text-slate-400 transition-colors"
                    href="#">Help
                    Center</a>
            </div>
        </div>
    </main>

</body>

</html>
