<x-layout>
    <x-form>
        <header class="text-center">
            <h2>
                Add New Menu
            </h2>
        </header>

        <form method="POST" action="/menus" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name">
                    Menu Name: 
                </label>
                <input type="text" name="name" value="{{ old('name') }}"/>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>

            <div class="mb-6">
                <label for="price">
                    Price: 
                </label>
                <input type="text" name="price" value="{{ old('price') }}"/>

                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">
                    Category: 
                </label>
                <select name="category" id="category">
                    <option value="rolls">Rolls</option>
                    <option value="drinks">Drinks</option>
                    <option value="bagels">Bagels</option>
                    <option value="others">Others</option>
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
                name="recipe" rows="5">{{ old('recipe') }}</textarea>

                @error('Recipe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="photo">
                    Photo: 
                </label>
                <input type="file" name="photo"/>
        
                @error('photo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
        
            </div>        
            
            <div class="mb-6">
                <button type="submit" class="submit">
                    Add
                </button>
            </div>
        </form>
    </x-form>
</x-layout>