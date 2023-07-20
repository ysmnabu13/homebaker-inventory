<x-layout>
    <x-form>
        <header class="text-center">
            <h2>
                Edit Product
            </h2>
        </header>

        <form method="POST" action="/inventory/{{ $inventory->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name">
                    Product Name: 
                </label>
                <input type="text" name="name" value="{{ $inventory->name }}"/>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>
            
            <div class="mb-6">
                <label for="cost">
                    Cost: 
                </label>
                <input type="text" name="cost" value="{{ $inventory->cost }}"/>

                @error('cost')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unit">
                    Unit: 
                </label>
                <select name="unit" id="unit">
                    <option value="Pieces" @if($inventory->unit == 'Pieces') selected @endif>Pieces</option>
                    <option value="Litres" @if($inventory->unit == 'Millilitres') selected @endif>Millilitres</option>
                    <option value="Grams" @if($inventory->unit == 'Grams') selected @endif>Grams</option>
                </select>                
                
                @error('unit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unitPerCase">
                    Unit Per Case: 
                </label>
                <input type="text" name="unitPerCase" value="{{ $inventory->unitPerCase }}"/>

                @error('unitPerCase')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unitPerPortion">
                    Unit Per Portion: 
                </label>
                <input type="text" name="unitPerPortion" value="{{ $inventory->unitPerPortion }}"/>

                @error('unitPerPortion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="quantity">
                    Quantity: 
                </label>
                <input type="text" name="quantity" value="{{ $inventory->quantity }}"/>

                @error('quantity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="Rolls" @if($inventory->category == 'Rolls') selected @endif>Rolls</option>
                    <option value="Drinks" @if($inventory->category == 'Drinks') selected @endif>Drinks</option>
                    <option value="Bagels" @if($inventory->category == 'Bagels') selected @endif>Bagels</option>
                    <option value="Toppings" @if($inventory->category == 'Toppings') selected @endif>Toppings</option>
                    <option value="Others" @if($inventory->category == 'Others') selected @endif>Others</option>
                </select>                        
                
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="restockPoint">
                    Restocking Point: 
                </label>
                <input type="text" name="restockPoint" value="{{ $inventory->restockPoint }}"/>

                @error('restockPoint')
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