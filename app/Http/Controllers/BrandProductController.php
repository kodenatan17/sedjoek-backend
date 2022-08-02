<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProductRequest;
use App\Models\BrandCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = BrandCategory::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a class="inline-block border border-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none
                hover:bg-gray-800 focus:outline-none focus:shadow-outline" href="' . route('dashboard,category.edit', $item->id) . '">Edit</a>
                <form class="inline-block" action="' . route('dashboard.category.destroy', $item->id) . '" method="POST">
                <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                Delete
                </button>
                ' . method_field('delete') . csrf_field() . '
                </form>
                ';
                })
                ->rowColumn(['action'])
                ->make();
        }
        return view('pages.dashboard.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandProductRequest $request)
    {
        $data = $request->all();
        BrandCategory::create($data);

        return redirect()->route('dashboard.brand.index')->with('success', 'Brand has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BrandCategory $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandCategory $brand)
    {
        return view('pages.dashboard.brand.edit', [
            'item' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function update(BrandProductRequest $request, BrandCategory $brand)
    {
        $data = $request->all();
        $brand->update($data);
        return redirect()->route('dashboard.brand.index')->with('success', 'Brand has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandCategory $brand)
    {
        $brand->delete();
        return redirect()->route('dashboard.brand.index')->with('success', 'Brand has been deleted');
    }
}
