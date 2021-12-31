<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('boss.category.index',[
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boss.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->validate([
            'name'=>'required|unique:categories,name',
        ],
        [
            'name.required' => 'Cần nhập tên hàng hóa',
            'name.unique' => 'Tên hàng hóa đã tồn tại',
        ]
        )){
            $category = Category::create([
                'name' => $request->input('name'),
            ]); 
            return redirect()->route('boss.category.index')->with('alert-success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('boss.category.edit',[
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if($request->validate([
            'name'=>'required|unique:categories,name,' . $category->id, 
        ],
        [
            'name.required' => 'Cần nhập tên hàng hóa',
            'name.unique' => 'Tên hàng hóa đã tồn tại',
        ]
        )){
            $category->update([
                'name' => $request->input('name'),
            ]); 
            return redirect()->route('boss.category.index')->with('alert-success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('boss.category.index')->with('alert-success','Xóa bản ghi thành công.');
    }
}
