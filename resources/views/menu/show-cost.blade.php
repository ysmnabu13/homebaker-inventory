<x-layout>
    <div class="mx-auto w-1/2">
        <div class="rounded-lg shadow-lg p-6" style="background-color: #506050; color: white;">
            <div class="flex flex-col items-center justify-center text-center">
                <h1 class="text-3xl font-bold mb-4">Standard Portion Cost & Profit</h3>
                <img
                    class="w-64 mr-6"
                    src="{{ $menu->photo ? asset('storage/' . $menu->photo) : asset('/images/no-image.png') }}"
                    alt=""
                />

                <h3 class="text-2xl mb-2">{{ $menu->name }}</h3>
                <div class="text-xl font-bold mb-4">RM{{ $menu->price }}</div>
                <hr class="border border-gray-200 w-full mb-6" />
                <div>
                    <div class="text-lg leading-relaxed space-y-6">
                        @php
                            $ingredients = json_decode($menu->ingredients);
                            $costPerPortion = 0;
                        @endphp
                        @foreach ($ingredients as $ingredient)
                            @foreach ($inventory as $product)
                                @if ($product->name === $ingredient)
                                    <h3 class="text-xl font-bold mb-4">{{ $ingredient }}</h3>
                                    <table>
                                        
                                        <tr>
                                            <td><b>Product Cost</b></td>
                                            <td class="pl-10">RM{{ $product->cost }}</td>
                                        </tr>  
                                        <tr>
                                        <td><b>Unit Per Case</b></td>
                                        <td class="pl-10">{{ $product->unitPerCase }} {{ $product->unit }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Unit Per Portion</b></td>
                                            <td class="pl-10">{{ $product->unitPerPortion }} {{ $product->unit }}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $costPerUnit = ($product->cost / $product->unitPerCase)
                                            @endphp
                                        <td><b>Cost Per Unit</b></td>
                                        <td class="pl-10">RM{{ number_format($costPerUnit, 2) }} / {{ $product->unit }}</td>
                                        </tr>
                                    </table>
                                    @php
                                        $costPerPortion += $costPerUnit;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                        
                        <h3 class="text-xl font-bold mb-4">Standard Portion Cost</h3>
                        <table>
                            <tr>
                                <td><b>Cost Per Portion</b></td>
                                <td class="pl-10">RM{{ number_format($costPerPortion, 2) }}</td>
                            </tr>  
                            <tr>
                                @php
                                    $profitPerPortion = ($menu->price - $costPerPortion)
                                @endphp
                                <td><b>Profit Per Portion</b></td>
                                <td class="pl-10">RM{{ number_format($profitPerPortion, 2) }}</td>
                            </tr>  
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
