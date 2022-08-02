<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandProductRequest;
use App\Models\BrandCategory;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandProductRequest $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandCategory $brand)
    {
        //
    }
}
