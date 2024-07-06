<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $prod = Product::orderBy('price');

        if ($request->has('filter')) {
            $prod->where('name', 'like', '%' . $request->filter . '%');
        }

        $prod = $prod->paginate(5);

        return view('product.index', compact('prod'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create_product'), code: 403);

        // dd($request);
        $fields = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric']
        ]);

        $product = Product::create($fields);

        if ($product->save()) {
            return redirect()->back()->with('success', 'Product Successfully added.');
        }
    }

    public function update(Request $request, Product $product)
    {
        abort_if(Gate::denies('update_product'), code: 403);

        $fields = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required']
        ]);

        // $product = Product::findOrFail($product);
        $product->update($fields);

        return redirect()->back()->with('update', 'Product Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('delete_product'), code: 403);

        $product->delete();

        return redirect()->back()->with('delete', 'Product deleted successfully.');
    }
}
