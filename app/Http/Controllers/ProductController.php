<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    // Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('detailproduct.index', compact('product'));
    }

    // Membuat produk baru
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->extension();
            $targetFolder = $request->category_id == 1 ? 'in' : 'out';
            $request->image->move(public_path("assets/images/$targetFolder"), $imageName);

            Product::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'category_id' => $validated['category_id'],
                'image_url' => "/assets/images/$targetFolder/" . $imageName,
            ]);

            return redirect()->back()->with('success', 'Product berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Mengupdate produk berdasarkan ID
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');

    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function showIndoor()
    {
        $products = Product::where('category_id', 1)->get(); // 1 = Indoor
        return view('productint.index', compact('products'));
    }

    public function showOutdoor()
    {
        $products = Product::where('category_id', 2)->get(); // 2 = Outdoor
        return view('productext.index', compact('products'));
    }

}