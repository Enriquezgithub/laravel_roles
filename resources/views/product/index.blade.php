<x-app-layout>
    <div class="p-6 relative">
        <div class="absolute right-8 top-3">
            <form action="/products" method="GET">
                <input type="text" class="border border-slate-200 rounded" placeholder="Search" name="filter">
                <button type="submit"
                    class="bg-blue-300 text-blue-600 py-2 px-2 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Search</button>
            </form>
        </div>
        <div class="bg-white mt-9">
            <div class="flex p-2 justify-between items-center">
                <div class="text-xl font-bold tracking-wider">Product List</div>
                <button class="bg-green-400 text-green-800 p-2 rounded font-bold">Export Excel</button>
            </div>

            @if (Session::has('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            @if (Session::has('update'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p>{{ Session::get('update') }}</p>
                </div>
            @endif

            @if (Session::has('delete'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                    <p>{{ Session::get('delete') }}</p>
                </div>
            @endif

        </div>

        <div class="max-h-[55vh] overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200 mt-8 ">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product
                            Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                        </th>
                        @can('update_product')
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($prod as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap w-[20%]">{{ $product->price }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-4">
                                @can('update_product')
                                    <button onclick="openEdit({{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 text-blue-700 hover:scale-125 transition ease-linear duration-150">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>

                                    </button>
                                @endcan
                                @can('delete_product')
                                    <button
                                        onclick="document.getElementById('deleteTrigger{{ $product->id }}').classList.remove('hidden')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 text-red-700 hover:scale-125 transition ease-linear duration-150">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        {{-- <div class="bg-white absolute top-[9.5rem] w-[96.9%] p-4 text-center border-t border-gray-200">
                            No Record Available
                        </div> --}}
                        <tr>
                            <td colspan="4" class="text-center py-4">No Record Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $prod->links() }}
        </div>

        @can('create_product')
            <button class="bg-blue-600 bg-opacity-50 p-3 w-[3%] rounded-full fixed right-10 bottom-20 font-bold"
                onclick="document.getElementById('trigger').classList.remove('hidden')">+</button>
        @endcan


    </div>

    @include('product.create-product-modal')

    @foreach ($prod as $product)
        @include('product.edit-product-modal', ['product' => $product])
    @endforeach

    @foreach ($prod as $product)
        @include('product.delete-product-modal', ['product' => $product])
    @endforeach

    <script>
        function openEdit(productId) {
            document.getElementById(`editTrigger${productId}`).classList.remove('hidden');

            document.getElementById(`nameError${productId}`).innerHTML = '';
            document.getElementById(`descError${productId}`).innerHTML = '';
            document.getElementById(`priceError${productId}`).innerHTML = '';
        }
    </script>

</x-app-layout>
