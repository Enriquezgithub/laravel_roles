<div class="fixed inset-0 flex items-center -mt-10 justify-center bg-gray-800 bg-opacity-50 @if ($errors->any() && old('form_type') == 'delete' && old('product_id') == $product->id) @else hidden @endif"
    id="deleteTrigger{{ $product->id }}">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-xl font-bold text-gray-900">Delete - {{ $product->name }}</h3>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this Product? <br>
                        {{ $product->name }} -- {{ $product->description }}
                    </p>
                </div>
                <div class="mt-5 sm:mt-6 flex gap-3">
                    <button type="submit"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-2 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Submit</button>
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-2 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:text-sm"
                        onclick="document.getElementById('deleteTrigger{{ $product->id }}').classList.add('hidden') ">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
