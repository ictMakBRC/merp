<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\asset\AssetCategory;
use App\Models\asset\AssetSubcategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = AssetCategory::all();
        $subcategories = AssetSubcategory::with('category')->get();
        // return $subcategories;
        return view('assets.category', compact('categories', 'subcategories'));
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
    public function store(Request $request)
    {
        $request->validate(['category_name' => ['required', 'string', 'max:255', 'unique:asset_categories']]);

        AssetCategory::create($request->all());

        return redirect()->back()->with('success', 'Category Successfully Created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetCategory $category)
    {
        $request->validate([
            'category_name' => ['required', 'string'],
        ]);

        $category->update($request->all());

        return redirect()->back()->with('success', 'Category Successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
