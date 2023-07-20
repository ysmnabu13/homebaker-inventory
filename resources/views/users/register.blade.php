<x-layout>
    <x-form>
        <header class="text-center">
            <h2 >
                Register Your Outlet!
            </h2>
        </header>

        <form method="POST" action="/users">
            @csrf
            <div class="mb-6">
                <label for="outletID">
                    Outlet ID: 
                </label>
                <input type="text" name="outletID" value="{{ old('outletID') }}" />

                @error('outletID')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="name">
                    Outlet Name: 
                </label>
                <input type="text" name="name" value="{{ old('name') }}" />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="managerID">
                    Manager ID: 
                </label>
                <input type="text" name="managerID" value="{{ old('managerID') }}"/>
                
                @error('managerID')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>

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
                <label for="contact">
                    Contact Number: 
                </label>
                <input type="text" name="contact" value="{{ old('contact') }}"/>
                
                @error('contact')
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
                <label for="password_confirmation">
                    Confirm Password: 
                </label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"/>

                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <a href="/login" class="account">Already have an account?</a>
                <button type="submit" class="submit">
                    Register
                </button>
            </div>
        </form>
    </x-form>
</x-layout>