<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\PrimaryController;
use App\Core\Services\Image\PrimaryImageService;
use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryStore;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Tag;
use App\Src\Category\CategoryRepository;
use App\Http\Requests\Backend\CategoryUpdate;
use App\Http\Requests\Backend\CategoryCreate;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Category::onlyParent()->with('children.children')->get();
        event(new MyEvent('testing pusher event from category.index', 5));
        return view('backend.modules.category.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::active()->get();
        $categoryGroups = CategoryGroup::active()->get();
        return view('backend.modules.category.create', compact('tags', 'categoryGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreate $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStore $request)
    {
        $element = Category::create($request->except('image', 'tags', 'categoryGroups'));
        if ($element) {
            $request->has('tags') ? $element->tags()->sync($request->tags) : null;
            $request->has('categoryGroups') ? $element->categoryGroups()->sync($request->categoryGroups) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.category.index')->with('success', 'category created.');
        }
        return redirect()->route('backend.admin.category.index')->with('error', 'category error.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Category::whereId($id)->with('children', 'tags')->first();
        $tags = Tag::active()->get();
        $categoryGroups = CategoryGroup::active()->get();
        return view('backend.modules.category.edit', compact('element', 'tags', 'categoryGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdate $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdate $request, $id)
    {
        $element = Category::whereId($id)->first();
        $updated = $element->update($request->except('image', 'tags', 'categoryGroups'));
        if ($updated) {
            $request->has('tags') ? $element->tags()->sync($request->tags) : null;
            $request->has('categoryGroups') ? $element->categoryGroups()->sync($request->categoryGroups) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.category.index')->with('success', 'category created.');
        }
        return redirect()->route('backend.admin.category.index')->with('error', 'category error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Category::whereId($id)->with('products','classifieds','services')->first();
        // later we should check if this category is related to that modal or not !!!
//        if($element->products->isEmpty() && $element->services->isEmpty() && $element->classifieds->isEmpty()) {
            if ($element->delete()) {
                return redirect()->route('backend.admin.category.index')->with('success', 'Category Removed successfully!');
            }
//        }
        return redirect()->back()->with('error', 'Category not deleted !! please remove elements attached to it first.');
    }

    public function trashed()
    {
        $this->authorize('isAdminOrAbove');
        $elements = Category::onlyTrashed()->paginate(100);
        return view('backend.modules.category.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isAdminOrAbove');
        $element = Category::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }
}
