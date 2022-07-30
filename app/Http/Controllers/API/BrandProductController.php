<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BrandCategory;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('id');
        $show_brand = $request->input('show_brand');

        if ($id) {
            $brand = BrandCategory::with(['brands'])->find($id);
            if ($brand) {
                return ResponseFormatter::success($brand, 'Data Brand Berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data brand tidak ada', 404);
            }
        }
        $brand = BrandCategory::query();

        if ($name) {
            $brand->where('name', 'like', '%' . $name . '%');
        }
        if ($show_brand) {
            $brand->with('brands');
        }
        return ResponseFormatter::success(
            $brand->paginate($limit),
            'Data Brand berhasil diambil'
        );
    }
}
