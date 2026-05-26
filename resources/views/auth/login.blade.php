<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promise Portal Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo-promise.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen overflow-x-hidden bg-[#f8fbff] text-[#13294b] antialiased [font-family:'Outfit',sans-serif]">
    @php
    $selectedApp = old('target_app');
    @endphp

    <main class="grid min-h-screen lg:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
        <section class="relative flex items-start justify-center overflow-hidden px-5 pb-5 pt-6 sm:px-8 lg:items-center lg:py-8">
            <div class="absolute -left-28 -top-24 h-72 w-72 rounded-xs bg-blue-500/10 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-28 h-80 w-80 rounded-xs bg-sky-400/10 blur-3xl"></div>

            <div class="relative z-10 w-full max-w-[438px]">
                <div class="mb-4 flex items-center gap-3 sm:hidden">
                    <img src="{{ asset('images/logo-promise.png') }}" alt="Promise Portal logo" class="h-[4.15rem] w-auto shrink-0 object-contain">
                    <div class="min-w-0">
                        <h1 class="text-[2.1rem] font-bold leading-none tracking-[-0.04em] text-[#13294b]">Sign In</h1>
                        <p class="mt-1 text-[0.9rem] leading-[1.5] text-[#6f7da1]">
                            Welcome to Promise Portal Login SSO
                        </p>
                    </div>
                </div>

                <div class="mb-4 hidden sm:mb-5 sm:block sm:text-left">
                    <h1 class="text-[clamp(1.9rem,2.7vw,2.75rem)] font-bold leading-[1.02] tracking-[-0.04em] text-[#13294b]">Sign In</h1>
                    <p class="mt-2 max-w-[22rem] text-[0.95rem] leading-[1.65] text-[#6f7da1]">
                        Welcome to Promise Portal Login SSO
                    </p>
                </div>

                @if (session('status'))
                <div class="mb-4 rounded-xs border border-green-300/90 bg-green-100/80 px-4 py-4 text-[0.95rem] text-green-800">
                    {{ session('status') }}
                </div>
                @endif

                @if ($errors->has('nik') && !$errors->has('password'))
                <div class="mb-4 rounded-xs border border-red-300/90 bg-red-50/90 px-4 py-4 text-[0.95rem] text-red-700">
                    {{ $errors->first('nik') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" data-login-form>
                    @csrf

                    <div class="mb-3 flex items-center gap-3 text-[0.92rem] font-medium text-[#6f7da1]">
                        <div class="h-px flex-1 bg-slate-300/60"></div>
                        <span>Choose destination app</span>
                        <div class="h-px flex-1 bg-slate-300/60"></div>
                    </div>

                    <p class="mb-3 text-[0.8rem] leading-[1.45] text-[#6f7da1] sm:mb-4 sm:text-[0.82rem]">
                        Select where you want to continue. Sign-in is disabled until you choose one destination.
                    </p>

                    @error('target_app')
                    <div class="mb-4 rounded-xs border border-red-300/90 bg-red-50/90 px-4 py-4 text-[0.95rem] text-red-700">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="relative group mt-1 sm:mt-2">
                        <!-- Navigation Buttons -->
                        <button type="button" data-carousel-prev class="absolute -left-2 top-[45%] -translate-y-1/2 z-20 flex h-8 w-8 items-center justify-center rounded-full bg-white/95 shadow-md border border-slate-200/80 text-blue-600 transition-all duration-300 hover:bg-white hover:scale-110 active:scale-95 disabled:opacity-0 focus:outline-none sm:-left-4">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                        </button>

                        <div id="app-carousel" class="flex overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide gap-2 sm:gap-3 pb-2 pt-1">
                            <label class="group/item block w-[calc(55%-4px)] flex-none snap-start cursor-pointer sm:w-[calc(30%-9px)]">
                                <input type="radio" name="target_app" value="drawing" required class="peer sr-only" {{ $selectedApp === 'drawing' ? 'checked' : '' }}>
                                <div class="flex h-[106px] flex-col items-center justify-center rounded-xs border border-slate-300/70 bg-slate-50/90 px-2 py-3 text-center transition-all duration-200 group-hover/item:border-blue-500/55 peer-checked:border-blue-500/55 peer-checked:bg-gradient-to-b peer-checked:from-blue-50/95 peer-checked:to-blue-100/70 sm:px-3 sm:py-4">
                                    <div class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-xs bg-gradient-to-br from-blue-600/15 to-blue-600/10 text-blue-600 peer-checked:bg-gradient-to-br peer-checked:from-blue-600 peer-checked:to-blue-500 peer-checked:text-white sm:mb-2.5 sm:h-9 sm:w-9">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M4 7.5L12 4L20 7.5L12 11L4 7.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <path d="M4 12.5L12 16L20 12.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M4 17L12 20L20 17" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-[0.76rem] font-semibold leading-tight text-[#13294b] sm:text-[0.9rem]">Drawing</div>
                                </div>
                            </label>

                            <label class="group/item block w-[calc(55%-4px)] flex-none snap-start cursor-pointer sm:w-[calc(30%-9px)]">
                                <input type="radio" name="target_app" value="inventory" class="peer sr-only" {{ $selectedApp === 'inventory' ? 'checked' : '' }}>
                                <div class="flex h-[106px] flex-col items-center justify-center rounded-xs border border-slate-300/70 bg-slate-50/90 px-2 py-3 text-center transition-all duration-200 group-hover/item:border-blue-500/55 peer-checked:border-blue-500/55 peer-checked:bg-gradient-to-b peer-checked:from-blue-50/95 peer-checked:to-blue-100/70 sm:px-3 sm:py-4">
                                    <div class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-xs bg-gradient-to-br from-indigo-600/15 to-indigo-600/10 text-indigo-600 peer-checked:bg-gradient-to-br peer-checked:from-indigo-600 peer-checked:to-indigo-500 peer-checked:text-white sm:mb-2.5 sm:h-9 sm:w-9">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M3.75 7.75L12 4L20.25 7.75L12 11.5L3.75 7.75Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <path d="M3.75 7.75V16.25L12 20V11.5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <path d="M20.25 7.75V16.25L12 20" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-[0.76rem] font-semibold leading-tight text-[#13294b] sm:text-[0.9rem]">Inventory</div>
                                </div>
                            </label>

                            <label class="group/item block w-[calc(55%-4px)] flex-none snap-start cursor-pointer sm:w-[calc(30%-9px)]">
                                <input type="radio" name="target_app" value="npc" class="peer sr-only" {{ $selectedApp === 'npc' ? 'checked' : '' }}>
                                <div class="flex h-[106px] flex-col items-center justify-center rounded-xs border border-slate-300/70 bg-slate-50/90 px-2 py-3 text-center transition-all duration-200 group-hover/item:border-blue-500/55 peer-checked:border-blue-500/55 peer-checked:bg-gradient-to-b peer-checked:from-blue-50/95 peer-checked:to-blue-100/70 sm:px-3 sm:py-4">
                                    <div class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-xs bg-gradient-to-br from-emerald-600/15 to-emerald-600/10 text-emerald-600 peer-checked:bg-gradient-to-br peer-checked:from-emerald-600 peer-checked:to-emerald-500 peer-checked:text-white sm:mb-2.5 sm:h-9 sm:w-9">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <rect x="6" y="6" width="12" height="12" rx="2.5" stroke="currentColor" stroke-width="1.7" />
                                            <path d="M9 3.75V6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M15 3.75V6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M9 18V20.25" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M15 18V20.25" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M18 9H20.25" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M18 15H20.25" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M3.75 9H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M3.75 15H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                            <path d="M9.5 9.5H14.5V14.5H9.5V9.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-[0.76rem] font-semibold leading-tight text-[#13294b] sm:text-[0.9rem]">NPC</div>
                                </div>
                            </label>

                            <label class="group/item block w-[calc(55%-4px)] flex-none snap-start cursor-pointer sm:w-[calc(30%-9px)]">
                                <input type="radio" name="target_app" value="management" class="peer sr-only" {{ $selectedApp === 'management' ? 'checked' : '' }}>
                                <div class="flex h-[106px] flex-col items-center justify-center rounded-xs border border-slate-300/70 bg-slate-50/90 px-2 py-3 text-center transition-all duration-200 group-hover/item:border-blue-500/55 peer-checked:border-blue-500/55 peer-checked:bg-gradient-to-b peer-checked:from-blue-50/95 peer-checked:to-blue-100/70 sm:px-3 sm:py-4">
                                    <div class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-xs bg-gradient-to-br from-violet-600/15 to-violet-600/10 text-violet-600 peer-checked:bg-gradient-to-br peer-checked:from-violet-600 peer-checked:to-violet-500 peer-checked:text-white sm:mb-2.5 sm:h-9 sm:w-9">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <rect x="2" y="7" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-[0.76rem] font-semibold leading-tight text-[#13294b] sm:text-[0.9rem]">Management</div>
                                </div>
                            </label>

                            <label class="group/item block w-[calc(55%-4px)] flex-none snap-start cursor-pointer sm:w-[calc(30%-9px)]">
                                <input type="radio" name="target_app" value="all_dashboard" class="peer sr-only" {{ $selectedApp === 'all_dashboard' ? 'checked' : '' }}>
                                <div class="flex h-[106px] flex-col items-center justify-center rounded-xs border border-slate-300/70 bg-slate-50/90 px-2 py-3 text-center transition-all duration-200 group-hover/item:border-blue-500/55 peer-checked:border-blue-500/55 peer-checked:bg-gradient-to-b peer-checked:from-blue-50/95 peer-checked:to-blue-100/70 sm:px-3 sm:py-4">
                                    <div class="mb-2 inline-flex h-8 w-8 items-center justify-center rounded-xs bg-gradient-to-br from-amber-600/15 to-amber-600/10 text-amber-600 peer-checked:bg-gradient-to-br peer-checked:from-amber-600 peer-checked:to-amber-500 peer-checked:text-white sm:mb-2.5 sm:h-9 sm:w-9">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <rect width="7" height="9" x="3" y="3" rx="1" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <rect width="7" height="5" x="14" y="3" rx="1" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <rect width="7" height="9" x="14" y="12" rx="1" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                            <rect width="7" height="5" x="3" y="16" rx="1" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="text-[0.76rem] font-semibold leading-tight text-[#13294b] sm:text-[0.9rem]">All Dashboard</div>
                                </div>
                            </label>
                        </div>

                        <button type="button" data-carousel-next class="absolute -right-2 top-[45%] -translate-y-1/2 z-20 flex h-8 w-8 items-center justify-center rounded-full bg-white/95 shadow-md border border-slate-200/80 text-blue-600 transition-all duration-300 hover:bg-white hover:scale-110 active:scale-95 disabled:opacity-0 focus:outline-none sm:-right-4">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </button>
                    </div>

                    <div class="mb-3 hidden items-center gap-3 text-[0.92rem] font-medium text-[#6f7da1] sm:flex">
                        <div class="h-px flex-1 bg-slate-300/60"></div>
                        <div class="h-px flex-1 bg-slate-300/60"></div>
                    </div>

                    <div class="mb-4">
                        <label for="nik" class="mb-2 block text-[0.9rem] font-semibold text-[#13294b]">NIK <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input
                                id="nik"
                                type="text"
                                name="nik"
                                value="{{ old('nik') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your NIK"
                                class="h-[3.15rem] w-full rounded-xs border border-[#cdd5e3] bg-white/95 px-4 text-[0.95rem] font-medium text-[#13294b] outline-none transition focus:border-blue-600/65 placeholder:font-normal placeholder:text-slate-400">
                        </div>
                        @error('nik')
                        <p class="mt-2 text-[0.84rem] font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2 block text-[0.9rem] font-semibold text-[#13294b]">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="h-[3.15rem] w-full rounded-xs border border-[#cdd5e3] bg-white/95 px-4 text-[0.95rem] font-medium text-[#13294b] outline-none transition focus:border-blue-600/65 placeholder:font-normal placeholder:text-slate-400">
                            <button type="button" class="absolute right-3 top-1/2 inline-flex h-8.5 w-8.5 -translate-y-1/2 items-center justify-center rounded-xs bg-blue-600/8 text-[#7182aa] transition hover:bg-blue-600/14 hover:text-blue-600" data-password-toggle aria-label="Show password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2 12C3.8 8.5 7.4 6 12 6C16.6 6 20.2 8.5 22 12C20.2 15.5 16.6 18 12 18C7.4 18 3.8 15.5 2 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-2 text-[0.84rem] font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <label for="remember_me" class="inline-flex cursor-pointer items-center gap-3 text-[0.9rem] font-medium text-[#13294b]">
                            <input id="remember_me" type="checkbox" name="remember" class="h-[1.15rem] w-[1.15rem] rounded-xs border border-slate-400/70 text-blue-600 focus:ring-blue-500" {{ old('remember') ? 'checked' : '' }}>
                            <span>Keep me logged in</span>
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="submit-button relative h-[3.3rem] w-full overflow-hidden rounded-xs bg-gradient-to-br from-blue-600 to-blue-500 text-[0.95rem] font-bold tracking-[-0.01em] text-white transition hover:brightness-[1.03] disabled:cursor-not-allowed disabled:opacity-[0.7] disabled:hover:translate-y-0 disabled:hover:brightness-100"
                        {{ $selectedApp ? '' : 'disabled' }}>
                        <span class="pointer-events-none relative z-10 inline-flex items-center justify-center gap-2">
                            <svg class="submit-spinner hidden h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.28" stroke-width="2.2"></circle>
                                <path d="M12 3C16.9706 3 21 7.02944 21 12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"></path>
                            </svg>
                            <span class="submit-label">Sign In</span>
                        </span>
                        <span class="submit-progress pointer-events-none absolute inset-x-0 bottom-0 hidden h-1 bg-white/25">
                            <span class="block h-full w-1/3 animate-[loading-bar_1.1s_ease-in-out_infinite] rounded-full bg-white"></span>
                        </span>
                    </button>
                </form>
            </div>
        </section>

        <aside class="relative hidden overflow-hidden px-12 py-12 text-white lg:flex lg:items-center lg:justify-center">
            <div class="absolute inset-0 bg-gradient-to-b from-[#123b96] to-[#0f2f7a]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(59,130,246,0.18),transparent_18rem),radial-gradient(circle_at_80%_85%,rgba(14,165,233,0.16),transparent_16rem)]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.07)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.07)_1px,transparent_1px)] bg-[size:52px_52px] opacity-55"></div>
            <div class="absolute right-[5.5rem] top-[2.8rem] h-[52px] w-[52px] bg-white/8"></div>
            <div class="absolute right-[8.75rem] top-[5.95rem] h-[52px] w-[52px] bg-white/8"></div>
            <div class="absolute bottom-24 left-[6.25rem] h-[52px] w-[52px] bg-white/8"></div>
            <div class="absolute bottom-[2.8rem] left-[9.5rem] h-[52px] w-[52px] bg-white/8"></div>

            <div class="relative z-10 w-full max-w-[32rem] text-center">
                <div class="mx-auto mb-5 flex items-center justify-center">
                    <img src="{{ asset('images/logo-promise.png') }}" alt="Promise Portal logo" class="h-[7rem] w-auto object-contain xl:h-[7.5rem]">
                </div>

                <h2 class="text-[clamp(2.2rem,4vw,3.45rem)] font-bold leading-[1.05] tracking-[-0.04em]">Promise Portal</h2>
                <p class="mx-auto mt-4 max-w-[27rem] text-[1.05rem] leading-[1.75] text-slate-200/80">
                    Secure single sign-on for Summit Adyawinsa internal applications with a cleaner, more focused, and more modern experience.
                </p>

                <div class="mt-9 grid grid-cols-3 gap-4">
                    <div class="rounded-xs border border-white/10 bg-white/7 p-4 text-left">
                        <strong class="block text-[1.05rem] font-bold">01</strong>
                        <span class="mt-1 block text-[0.88rem] leading-[1.45] text-slate-200/75">One portal for everyday internal access.</span>
                    </div>
                    <div class="rounded-xs border border-white/10 bg-white/7 p-4 text-left">
                        <strong class="block text-[1.05rem] font-bold">02</strong>
                        <span class="mt-1 block text-[0.88rem] leading-[1.45] text-slate-200/75">Cleaner layout for a faster sign-in flow.</span>
                    </div>
                    <div class="rounded-xs border border-white/10 bg-white/7 p-4 text-left">
                        <strong class="block text-[1.05rem] font-bold">03</strong>
                        <span class="mt-1 block text-[0.88rem] leading-[1.45] text-slate-200/75">Responsive and comfortable on smaller screens.</span>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('[data-login-form]');
            const toggleButton = document.querySelector('[data-password-toggle]');
            const passwordInput = document.getElementById('password');
            const appOptions = document.querySelectorAll('input[name="target_app"]');
            const submitButton = document.querySelector('.submit-button');
            const submitSpinner = submitButton ? submitButton.querySelector('.submit-spinner') : null;
            const submitLabel = submitButton ? submitButton.querySelector('.submit-label') : null;
            const submitProgress = submitButton ? submitButton.querySelector('.submit-progress') : null;
            let isSubmitting = false;

            if (toggleButton && passwordInput) {
                toggleButton.addEventListener('click', function() {
                    const isHidden = passwordInput.type === 'password';
                    passwordInput.type = isHidden ? 'text' : 'password';
                    toggleButton.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                });
            }

            if (submitButton && appOptions.length) {
                const syncSubmitState = function() {
                    const hasSelection = Array.from(appOptions).some(function(option) {
                        return option.checked;
                    });

                    submitButton.disabled = !hasSelection;
                };

                appOptions.forEach(function(option) {
                    option.addEventListener('change', syncSubmitState);
                });

                syncSubmitState();
            }

            // Carousel Navigation logic
            const carousel = document.getElementById('app-carousel');
            const prevBtn = document.querySelector('[data-carousel-prev]');
            const nextBtn = document.querySelector('[data-carousel-next]');

            if (carousel && prevBtn && nextBtn) {
                const updateButtons = () => {
                    const scrollLeft = carousel.scrollLeft;
                    const maxScroll = carousel.scrollWidth - carousel.clientWidth;

                    prevBtn.style.visibility = scrollLeft <= 0 ? 'hidden' : 'visible';
                    nextBtn.style.visibility = scrollLeft >= maxScroll - 1 ? 'hidden' : 'visible';
                };

                prevBtn.addEventListener('click', () => {
                    carousel.scrollBy({
                        left: -200,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener('click', () => {
                    carousel.scrollBy({
                        left: 200,
                        behavior: 'smooth'
                    });
                });

                carousel.addEventListener('scroll', updateButtons);
                window.addEventListener('resize', updateButtons);

                // Initial check
                setTimeout(updateButtons, 100);
            }

            if (loginForm && submitButton) {
                loginForm.addEventListener('submit', function(event) {
                    if (isSubmitting) {
                        event.preventDefault();
                        return;
                    }

                    isSubmitting = true;
                    submitButton.disabled = true;
                    submitButton.classList.remove('hover:-translate-y-0.5');

                    if (submitSpinner) {
                        submitSpinner.classList.remove('hidden');
                    }

                    if (submitLabel) {
                        submitLabel.textContent = 'Signing In...';
                    }

                    if (submitProgress) {
                        submitProgress.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
    <style>
        @keyframes loading-bar {
            0% {
                transform: translateX(-140%);
            }

            100% {
                transform: translateX(320%);
            }
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</body>

</html>