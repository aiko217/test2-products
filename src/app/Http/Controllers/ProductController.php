<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' .$request->keyword. '%');
        }

        if ($request->sort === 'high') {
                $query->orderBy('price', 'desc');
        }
        elseif ($request->sort === 'low') {
                $query->orderBy('price', 'asc');
        }
        
        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    public function store(ProductRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('products.index');
        }
        $imagePath = $request->file('image')->store('products', 'public');
        
        $product = Product::create([
            'name' =>$request->name,
            'price' =>$request->price,
            'description' =>$request->description,
            'image' => $imagePath,
        ]);
       
        $product->seasons()->attach($request->seasons);
        
        return redirect()->route('products.index')
        ->with('success','商品を登録しました');
    }

    public function create()
    {
        $seasons = Season::all();

        return view('products.create', compact('seasons'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $path = $request->file('image')->store('products', 'public');
        $product->image_path = $path;

    $product->name = $request->name;
    $product->price = $request->price;
    $product->season = implode(',', $request->seasons);
    $product->description = $request->description;
    $product->save();

    return redirect()->route('products.index');
}

    public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index');
}

}
