<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ProductController extends Controller
{
    //
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('id');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');
        $brand = $request->input('brand');

        $price_from = $request->input('price_from'); //filter price
        $price_to = $request->input('price_to'); //filter price

        if ($id) {
            $product = Product::with(['category', 'galleries', 'brand'])->find($id);
            if ($product) {
                return ResponseFormatter::success($product, 'Data produk berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data produk Tidak Ada', 404);
            }
        }
        $product = Product::with(['category', 'galleries', 'brand']);

        if ($name) {
            $product->where('name', 'like', '%' . $name . '%');
        }
        if ($description) {
            $product->where('description', 'Like', '%' . $description . '%');
        }
        if ($tags) {
            $product->where('tags', 'Like', '%' . $tags . '%');
        }
        if ($price_from) {
            $product->where('price', '>=', $price_from);
        }
        if ($price_to) {
            $product->where('price', '<=', $price_to);
        }
        if ($categories) {
            $product->where('categories', $categories);
        }
        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data Produk berhasil diambil',
        );
    }
}
