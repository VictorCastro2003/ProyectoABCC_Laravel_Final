<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" required autofocus autocomplete="username">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control" required autocomplete="new-password">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="text-decoration-underline small text-secondary" href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>
