<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto px-4 py-6">
        <div>
            <div class="text-center font-extrabold mb-6">
                <h1>DAFTAR PRODUK</h1>
            </div>
            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Cart Section --}}
                <div class="bg-gray-100 p-4 rounded-xl border shadow-xl lg:basis-1/3 flex flex-col"
                     style="max-height: 610px;">
                    <div class="mb-4 flex items-center justify-between">
                        <form action="{{ route('cart.setCustomer') }}" method="POST" class="flex-1">
                            @csrf
                            <select name="customer_id" 
                                    class="rounded-lg border border-gray-300 w-full lg:w-auto"
                                    onchange="this.form.submit()">
                                @foreach ($customer as $c)
                                    <option value="{{ $c->id }}" {{ session('customer_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->first_name .' '. $c->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <span class="ml-4 text-lg font-extrabold font-sans tracking-wide">CART</span>
                    </div>

                    <table class="w-full text-left text-sm text-gray-900 mb-2">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 w-40">Name Product</th>
                                <th class="px-4 py-2 w-25">Price</th>
                                <th class="px-4 py-2 w-10">QTY</th>
                                <th class="px-4 py-2 w-25">Total</th>
                            </tr>
                        </thead>
                    </table>

                    @if(session('cart'))
                        <div class="overflow-y-auto pr-2 flex-grow" style="max-height: 340px;">
                            <table class="w-full">
                                <tbody>
                                    @php $grandTotal = 0; @endphp
                                    @foreach(session('cart') as $id => $item)
                                        <tr class="bg-gray-100 border-spacing-2 md:border-spacing-4">
                                            <td class="px-4 py-2 w-40">{{ $item['name'] }}</td>
                                            <td class="px-4 py-2 w-25">Rp{{ number_format($item['price']) }}</td>
                                            <td class="px-4 py-2 w-10">{{ $item['quantity'] }}</td>
                                            <td class="px-4 py-2 w-25">Rp{{ number_format($item['price'] * $item['quantity']) }}</td>
                                        </tr>
                                        @php $grandTotal += $item['price'] * $item['quantity']; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-gray-100 mt-3">
                            <table class="w-full">
                                <tbody class="text-left">
                                    <tr class="font-bold bg-gray-200">
                                        <td colspan="3" class="px-4 py-2 text-right">Grand Total</td>
                                        <td class="px-4 py-2">Rp{{ number_format($grandTotal) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center bg-gray-100 text-black flex-grow flex items-center justify-center" style="min-height: 380px;">
                            Cart kosong
                        </p>
                    @endif

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <form action="{{ route('cart.clear') }}" method="POST" class="col-span-2">
                            @csrf
                            <button type="submit" onclick="saveAlert()" class="w-full text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-bold rounded-lg text-sm px-5 py-2 dark:focus:ring-yellow-900">
                                Clear Cart
                            </button>
                        </form>
                        <form action="{{ route('cart.checkout') }}" method="POST" class="col-span-1">
                            @csrf
                            <button type="submit" onclick="saveAlert()" class="w-full bg-blue-500 text-white rounded font-bold text-sm px-5 py-2 hover:bg-blue-600">
                                Payment
                            </button>
                        </form>
                    </div>
                </div>
                {{-- END Cart Section --}}

                {{-- Product Section --}}
                <div class="bg-[#dfe4ea] p-5 rounded-xl flex-grow max-h-[585px] overflow-y-auto ">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        @foreach($produks as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden p-5 max-h-50 hover:shadow-lg hover:scale-105 transition-transform duration-200 ease-in-out cursor-pointer">
                                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" aria-label="Add {{ $product->name_product }} to cart" class="flex flex-col items-center gap-2 w-full">
                                        <img class="w-24 h-24 object-cover rounded-md mx-auto" src="{{ asset('storage/'.$product->photo) }}" alt="{{ $product->name_product }}" />
                                        <span class="mt-2 font-semibold text-lg text-center text-gray-900">{{ $product->name_product }}</span>
                                        <span class="text-gray-700">Rp{{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- END Product Section --}}
            </div>
        </div>
    </div>
</x-layout>
