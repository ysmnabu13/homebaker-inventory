<x-layout>
    <x-form>
        <header class="text-center">
            <h2>
                Login
            </h2>
        </header>

        <form method="POST" action="/users/authenticate">
            @csrf

            <div class="mb-6">
                <label for="email">
                    E-mail Address: 
                </label>
                <input type="email" name="email" value="{{ old('email') }}"/>
                
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>

            <div class="mb-6">
                <label for="password">
                    Password:
                </label>
                <input type="password" name="password" value="{{ old('password') }}"/>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <a href="/register" class="account">Don't have an account?</a>
                <button type="submit" class="submit">
                    Login
                </button>
            </div>
        </form>
    </x-form>
</x-layout>