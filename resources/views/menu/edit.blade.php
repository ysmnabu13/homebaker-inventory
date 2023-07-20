<x-layout>
    <x-form>
        <header class="text-center">
            <h2>
                Edit Menu
            </h2>
        </header>

        <form method="POST" action="/menu/{{ $menu->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name">
                    Menu Name: 
                </label>
                <input type="text" name="name" value="{{ $menu->name }}"/>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>

            <div class="mb-6">
                <label for="price">
                    Price: 
                </label>
                <input type="text" name="price" value="{{ $menu->price }}"/>

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">
                    Category: 
                </label>
                <select name="category" id="category">
                    <option value="Rolls" @if($menu->category == 'Rolls') selected @endif>Rolls</option>
                    <option value="Drinks" @if($menu->category == 'Drinks') selected @endif>Drinks</option>
                    <option value="Bagels" @if($menu->category == 'Bagels') selected @endif>Bagels</option>
                    <option value="Others" @if($menu->category == 'Others') selected @endif>Others</option>
                </select>                
                
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="ingredients">
                    Ingredients: 
                    <br><i>Hold Ctrl if you're selecting more than one ingredient</i>
                </label>
            
            <select multiple="multiple" name="ingredients[]" multiple class="form-control" class="dropdown">
                @foreach($inventory as $product)
                    <option value="{{ $product->name }}" style="padding-left: 10px"> {{ $product->name }}</option>
                @endforeach
                </select>

                @error('ingredients')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="recipe">
                    Recipe: 
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full"
                name="recipe" rows="5">{{ $menu->recipe }}</textarea>

                @error('Recipe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="photo">
                    Photo: 
                </label>
                <input type="file" name="photo"/>

                <img class="w-48 mr-6 mb-6"
                src="{{ $menu->photo ? asset('storage/' . $menu->photo) : asset('/images/no-image.png') }}"
                alt=""/>
        
                @error('photo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
        
            </div>        
            
            <div class="mb-6">
                <button type="submit" class="submit">
                    Update
                </button>
            </div>
        </form>
    </x-form>
</x-layout>