<div class="fixed inset-0 flex items-center -mt-10 justify-center bg-gray-800 bg-opacity-50 @if ($errors->any()) @else hidden @endif"
    id="trigger">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-xl font-bold text-gray-900">Create Product</h3>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                    <div class="mb-2">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" class="w-full rounded"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-600" id="nameError">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description">Product Description</label>
                        <textarea name="description" id="description" cols="30" rows="2" class="w-full rounded">{{ Request::old('description') }}</textarea>
                        @error('description')
                            <div class="text-red-600" id="descError">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="price">Product Price</label>
                        <input type="number" id="price" name="price" class="w-full rounded"
                            value="{{ old('price') }}">
                        @error('price')
                            <div class="text-red-600" id="priceError">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    </p>
                </div>
                <div class="mt-5 sm:mt-6 flex gap-3">
                    <button type="submit"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-2 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Submit</button>
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-2 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm"
                        onclick="closeCreateProductModal()">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function closeCreateProductModal() {
        document.getElementById('trigger').classList.add('hidden');

        document.getElementById('nameError').innerHTML = '';
        document.getElementById('descError').innerHTML = '';
        document.getElementById('priceError').innerHTML = '';
    }
</script>
