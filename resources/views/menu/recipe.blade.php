<x-layout>
    <div class="mx-auto w-1/2">
        <div class="rounded-lg shadow-lg p-6" style="background-color: #506050; color: white;">
            <div class="flex flex-col items-center justify-center text-center">
                <h1 class="text-3xl font-bold mb-4">Recipe Guide & Ingredients</h3>
                <img
                    class="w-64 mr-6 mb-6"
                    src="{{ $menu->photo ? asset('storage/' . $menu->photo) : asset('/images/no-image.png') }}"
                    alt=""
                />

                <h3 class="text-2xl mb-2">{{ $menu->name }}</h3>
                <div class="text-xl font-bold mb-4">RM{{ $menu->price }}</div>
                <hr class="border border-gray-200 w-full mb-6" />

                <div>
                    <h3 class="text-3xl font-bold mb-4">Ingredients</h3>
                    <div class="text-lg leading-relaxed space-y-6">
                        @php
                            $ingredients = json_decode($menu->ingredients)
                        @endphp
                        @foreach ($ingredients as $ingredient)
                            {{ $ingredient }} <br>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-3xl font-bold mb-4">Recipe</h3>
                    <div class="text-lg leading-relaxed space-y-6">{!! nl2br(e($menu->recipe)) !!}</div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
