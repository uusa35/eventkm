<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryLightResource;
use App\Http\Resources\UserLightResource;
use App\Models\Category;
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
        if (request()->has('is_parent') && request()->is_parent) {
            $elements = Category::active()->onlyParent()->with(['children' => function ($q) {
                return $q->active()->with(['children' => function ($q) {
                    return $q->active()->categoryGroupsWithProperties();
                }])->categoryGroupsWithProperties();
            }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
                return $q->active()->orderBy('order', 'asc');
            }])->orderBy('order', 'asc')->get();
        } elseif (request()->has('type') && !request()->has('on_home')) {
            // is_classified or is_product or is_service and not nessecary is_parent
            $elements = Category::where(request()->type, true)->active()->onHome()->with(['children' => function ($q) {
                return $q->active()->where(request()->type, true)->with(['children' => function ($q) {
                    return $q->active()->where(request()->type, true)->categoryGroupsWithProperties();
                }])->categoryGroupsWithProperties();
            }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
                return $q->active()->orderBy('order', 'asc');
            }])->orderBy('order', 'asc')->get();
        }
        elseif (request()->has('type') && request()->has('on_home')) {
//            dd(request()->type);
            $elements = Category::where(request()->type, true)->get();
//                ->active()->onHome()->with(['children' => function ($q) {
//                return $q->active()->where(request()->type, true)->with(['children' => function ($q) {
//                    return $q->active()->where(request()->type, true)->categoryGroupsWithProperties();
//                }])->categoryGroupsWithProperties();
//            }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
//                return $q->active()->orderBy('order', 'asc');
//            }])->orderBy('order', 'asc')->get();
        } elseif (request()->has('on_home') && request()->on_home && !request()->has('type')) {
            $elements = Category::active()->onHome()->with(['children' => function ($q) {
                return $q->active()->with(['children' => function ($q) {
                    return $q->active()->categoryGroupsWithProperties();
                }])->categoryGroupsWithProperties();
            }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
                return $q->active()->orderBy('order', 'asc');
            }])->orderBy('order', 'asc')->get();
        } elseif (request()->has('on_home') && request()->has('type')) {
            $elements = Category::active()->onHome()->where(request()->type, true)->get();
        } else {
            $elements = Category::active()->get();
        }
        return response()->json(CategoryLightResource::collection($elements), 200);
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
        $elements = Category::whereId($id)->active()->users()->orderBy('order', 'desc')->get();
        if ($elements->isNotEmpty()) {
            return response()->json(CategoryLightResource::collection($elements), 200);
        }
        return response()->json(['message' => trans('message.no_users'), 400]);
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
