<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('parent_id', 'asc')->latest()->paginate(9);
        return view('Admin.modun.categories.index', ['title' => 'Category'], compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('Admin.modun.categories.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên này đã sử dụng',
        ];

        $this->validate($request, [
            'name' => 'required|unique:categories'
        ], $messages);


        $category = new Category;
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->slug = $request->input('slug');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Thêm Danh Mục thành công');
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
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::where('id', '<>', $id)->pluck('name', 'id')->toArray();
        return view('Admin.modun.categories.edit', compact('category', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $id
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Cập nhật Danh Mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (count($category->products) > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Danh mục đang được sử dụng, xóa Danh Mục không thàn công');
        } else {
            $category->delete();
            return redirect()->route('categories.index')
                ->with('success', 'Xóa Danh Mục thành công!');
        }
    }
}
