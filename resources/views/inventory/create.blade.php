<x-layout>
    <x-form>
        <header class="text-center">
            <h2>
                Add New Product In Inventory
            </h2>
        </header>

        <form method="POST" action="/inventories" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name">
                    Product Name: 
                </label>
                <input type="text" name="name" value="{{ old('name') }}"/>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror                
            </div>

            <div class="mb-6">
                <label for="cost">
                    Cost (RM): 
                </label>
                <input type="text" name="cost" value="{{ old('cost') }}"/>

                @error('cost')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unit">
                    Unit: 
                </label>
                <select name="unit" id="unit">
                    <option value="Pieces">Pieces</option>
                    <option value="Millilitres">Millilitres</option>
                    <option value="Grams">Grams</option>
                </select>                
                
                @error('unit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unitPerCase">
                    Unit Per Case: 
                </label>
                <input type="text" name="unitPerCase" value="{{ old('unitPerCase') }}"/>

                @error('unitPerCase')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="unitPerPortion">
                    Unit Per Portion: 
                </label>
                <input type="text" name="unitPerPortion" value="{{ old('unitPerPortion') }}"/>

                @error('unitPerPortion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="quantity">
                    Quantity: 
                </label>
                <input type="text" name="quantity" value="{{ old('quantity') }}"/>

                @error('quantity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">
                    Category: 
                </label>
                <select name="category" id="category">
                    <option value="Rolls">Rolls</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Bagels">Bagels</option>
                    <option value="Toppings">Toppings</option>
                    <option value="Others">Others</option>
                </select>                
                
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="restockPoint">
                    Restocking Point: 
                </label>
                <input type="text" name="restockPoint" value="{{ old('restockPoint') }}"/>

                @error('restockPoint')
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