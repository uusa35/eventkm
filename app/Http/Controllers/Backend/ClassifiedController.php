<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ClassifiedStore;
use App\Http\Requests\Backend\ClassifiedUpdate;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Classified;
use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ClassifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', 'classified');
        if (auth()->user()->isAdminOrABove) {
            $elements = Classified::with('user', 'slides','category.categoryGroups','properties')->orderBy('id', 'desc')->get();
        } else {
            $elements = request()->has('type')
                ? Classified::active()->myItems()->where([request('type') => true])->with('user', 'slides','category.categoryGroups','properties')->orderBy('id', 'desc')->get()
                : Classified::active()->myItems()->with('user', 'slides','category.categoryGroups','properties')->orderBy('id', 'desc')->get();
        }
        return view('backend.modules.classified.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('classified.create');
        $categories = Category::active()->where('is_classified',true)->with(['children' => function ($q) {
            return $q->where('is_classified', true)->with(['children' => function ($q) {
                return $q->where('is_classified', true);
            }]);
        }])->get();
        $tags = Tag::active()->get();
        $brands = Brand::active()->get();
        $users = User::active()->get();
        $areas = auth()->user()->isAdminOrAbove ? Area::active()->get() : Area::active()->where('country_id', auth()->user()->country_id)->with('country')->get();
        return view('backend.modules.classified.create', compact('categories', 'tags', 'brands', 'users', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassifiedStore $request)
    {
        $element = Classified::create($request->except(['_token', 'image', 'images', 'tags', 'areas','expired_at','categories']));
        if ($element) {
            $element->tags()->sync($request->tags);
            $element->categories()->sync($request->categories);
            $request->has('expired_at') ? $element->update(['expired_at' => Carbon::parse(str_replace('-', '', $request->expired_at))->toDateTimeString()]) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            if ($element->category->categoryGroups->isEmpty()) {
                return redirect()->route('backend.classified.index')->with('success', trans('general.classified_saved'));
            }
            return redirect()->route('backend.property.attach', ['id' => $element->id])->with('success', trans('general.classified_saved'));
        }
        return redirect()->back()->with('error', trans('general.classified_not_saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Classified::whereId($id)->with('area', 'tags', 'category')->first();
        $this->authorize('classified.update', $element);
        $categories = Category::active()->where('is_classified',true)->with(['children' => function ($q) {
            return $q->where('is_classified', true)->with(['children' => function ($q) {
                return $q->where('is_classified', true);
            }]);
        }])->get();
        $tags = Tag::active()->get();
        $brands = Brand::active()->get();
        $users = User::active()->get();
        $areas = auth()->user()->isAdminOrAbove ? Area::active()->get() : Area::active()->where('country_id', auth()->user()->country_id)->with('country')->get();
        return view('backend.modules.classified.edit', compact('element', 'categories', 'tags', 'brands', 'users', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassifiedUpdate $request, $id)
    {
        $element = Classified::whereId($id)->first();
        $updated = $element->update($request->except(['_token', 'image', 'images','tags','expired_at','categories']));
        if ($updated) {
            $element->tags()->sync($request->tags);
            $element->categories()->sync($request->categories);
            $request->has('expired_at') ? $element->update(['expired_at' => Carbon::parse(str_replace('-', '', $request->expired_at))->toDateTimeString()]) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            return redirect()->route('backend.classified.index')->with('success', trans('general.classified_saved'));
        }
        return redirect()->back()->with('error', trans('general.classified_not_saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Classified::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.classified.index')->with('success', trans('message.success_classified_delete'));
        }
        return redirect()->back()->with('error', trans('message.failure_classified_delete'));
    }

    public function trashed()
    {
        $this->authorize('isSuper');
        $elements = Classified::onlyTrashed()->paginate(100);
        return view('backend.modules.classified.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isSuper');
        $element = Classified::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }
}
