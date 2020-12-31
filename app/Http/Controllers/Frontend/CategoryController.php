<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesList = [];
        $vendors = [];
        $areas = [];
        $tags = [];
        if (env('MALLR')) {
            $elements = Category::active()->onlyProducts()->paginate(self::TAKE_MIN);
        } elseif (env('EVENTKM')) {
            $elements = Category::active()->onlyForServices()->paginate(self::TAKE);
            $services = Service::active()->hasImage()->serveCountries()->hasValidTimings()->with(
                'tags', 'user.country', 'images', 'user.areas', 'favorites'
            )->with(['categories' => function ($q) {
                return $q->has('services', '>', 0)->with('services');
            }])->orderBy('id', 'desc')->paginate(self::TAKE);
            $tags = $services->pluck('tags')->flatten()->unique('id')->sortKeysDesc();
            $categoriesList = $services->pluck('categories')->flatten()->unique('id')->sortKeysDesc();
            $vendors = $services->pluck('user')->unique('id')->flatten();
            $areas = $services->pluck('user.areas')->flatten()->unique('id');
            return view('frontend.wokiee.four.modules.category.index', compact('elements', 'categoriesList', 'vendors', 'areas', 'tags'));
        } elseif(env('ESCRAP') && request()->parent_id) {
            $parent = Category::where('parent_id', request()->parent_id)->first();
            $elements = $parent->children()->onlyForUsers()->paginate(self::TAKE_MID);
            return view('frontend.wokiee.four.modules.category.sub_category.index', compact('elements'));
        } elseif (env('HOMEKEY')) {
            $elements = Category::active()->onlyForServices()->paginate(self::TAKE);
            return view('frontend.wokiee.four.modules.category.homekey.index', compact('elements', 'categoriesList', 'vendors', 'areas', 'tags'));
        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Category::whereId($id)->with('users')->first();
        $elements = Category::whereId($id)->first()->users()->paginate();
        $isUsers = true;
        return view('frontend.wokiee.four.modules.category.show', compact('element', 'elements', 'isUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
