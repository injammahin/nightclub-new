<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Al's Night Club</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#050102] text-white">
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 h-72 w-72 rounded-full bg-red-600/20 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-red-800/20 blur-3xl"></div>
    </div>

    <main class="relative min-h-screen flex items-center justify-center px-5 py-10">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <h1 class="font-display text-4xl tracking-wide">
                    AL'S <span class="text-red-500">Admin</span>
                </h1>
                <p class="mt-3 text-sm text-white/50">
                    Manage website content, media and homepage sections.
                </p>
            </div>

            <div class="rounded-3xl border border-white/10 bg-white/[.04] p-7 shadow-2xl backdrop-blur-xl">
                @if (session('error'))
                    <div class="mb-5 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-100">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div
                        class="mb-5 rounded-xl border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-100">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs uppercase tracking-[.18em] text-white/50 mb-2">
                            Username
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-red-500"
                            required autofocus>
                        @error('username')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-[.18em] text-white/50 mb-2">
                            Password
                        </label>
                        <input type="password" name="password"
                            class="w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3 text-white outline-none focus:border-red-500"
                            required>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="flex items-center gap-3 text-sm text-white/60">
                        <input type="checkbox" name="remember"
                            class="rounded border-white/20 bg-black/30 text-red-600 focus:ring-red-600">
                        Remember me
                    </label>

                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-red-600 to-red-900 px-5 py-4 text-sm font-black uppercase tracking-[.18em] shadow-lg shadow-red-900/30 transition hover:-translate-y-0.5">
                        Login
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-white/35">
                Protected admin area.
            </p>
        </div>
    </main>
</body>

</html>