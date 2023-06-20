<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogCategoryRequest;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blog_category;

    public function __construct(CategoryBlog $blog_category)
    {
        $this->blog_category = $blog_category;
    }

    public function index()
    {
        return view('Admin.modun.blog.index');
    }

    public function category_index()
    {
        $category_blogs = $this->blog_category->latest()->paginate(5);
        return view('Admin.modun.blog.blog_category.index', compact('category_blogs'));
    }
    public function category_add()
    {
        return view('Admin.modun.blog.blog_category.add');
    }
    public function category_store(CreateBlogCategoryRequest $request)
    {
        $dataCreate = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $dataCreate['image'] = $imageName;
        }

        $this->blog_category->create($dataCreate);

        return redirect()->route('admin.blog.category')->with(['message' => 'Create new Blog Category successfully']);
    }

    public function category_edit($id)
    {
        $blog_category = $this->blog_category->findOrFail($id);
        return view('Admin.modun.blog.blog_category.edit', compact('blog_category'));
    }

    public function category_update(Request $request, $id)
    {

        $dataUpdate = $request->all();
        $blog_category = $this->blog_category->findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $dataUpdate['image'] = $imageName;
        }

        $blog_category->update($dataUpdate);

        return redirect()->route('admin.blog.category')->with('success', 'Blog Category updated successfully.');
    }

    public function category_destroy($id)
    {

        $blog_category = $this->blog_category->findOrFail($id);

        $blog_category->delete();

        return redirect()->route('admin.blog.category')->with('success', 'Blog Category deleted successfully.');
    }
}
