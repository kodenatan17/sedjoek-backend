<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $show_category = $request->input('show_category');

        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);
            if ($category) {
                return ResponseFormatter::success($category, 'Data Kategori berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data Kategori tidak ada', 404);
            }
        }
        $category = ProductCategory::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%');
        }
        if ($show_category) {
            $category->with('products');
        }
        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data Kategori berhasil diambil'
        );
    }
}
