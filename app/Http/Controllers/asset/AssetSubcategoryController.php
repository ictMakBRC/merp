<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\asset\AssetSubcategory;
use Illuminate\Http\Request;

class AssetSubcategoryController extends Controller
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
    public function store(Request $request)
    {
        $request->validate(['subcategory_name' => ['required', 'string', 'max:255', 'unique:asset_subcategories'],
            'asset_category_id' => ['required', 'numeric'], ]);

        AssetSubcategory::create($request->all());

        return redirect()->back()->with('success', 'SubCategory Successfully Created !!');
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
    public function update(Request $request, AssetSubcategory $subcategory)
    {
        //
        $request->validate([
            'category_id' => ['required'],
            'subcategory_name' => ['string'],
        ]);

        $subcategory->update($request->all());

        return redirect()->back()->with('success', 'Subcategory Successfully updated !!');
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
