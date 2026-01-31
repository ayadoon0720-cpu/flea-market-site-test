<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'low') {
                $query->orderBy('price', 'asc');
            }
        }

        $products = $query->paginate(6)->withQueryString();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('products.show', compact('product', 'seasons'));
    }

    public function create()
    {
        $seasons = Season::all();

        return view('/products/register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $path,
            'description' => $request->description,
        ]);

        $product->seasons()->attach($request->season_id);

        return redirect('/products');
    }

    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();

        return view('/products/{productId}/update', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $productId)
    {
        DB::beginTransaction();

         $product = Product::findOrFail($productId);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image,
        ]);

        $product->seasons()->sync($request->season_id);

        try {
        DB::commit();

        return redirect('/products/' . $productId);

        } catch (\Exception $e) {
        DB::rollBack();

        return back()->withErrors('更新に失敗しました');
        }
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        $product->seasons()->detach();
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect('/products');
    }


}