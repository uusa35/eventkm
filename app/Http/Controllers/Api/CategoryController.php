<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryLightResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserLightResource;
use App\Models\Category;
use App\Services\Search\CategoryFilters;
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
            $elements = Category::active()->onHome()->where(request()->type, true)
                ->whereHas('users', function ($q) {
                    return $q->active();
                }, '>', 0)->with(['children' => function ($q) {
                    return $q->active()->where(request()->type, true)->with(['children' => function ($q) {
                        return $q->active()->where(request()->type, true)->categoryGroupsWithProperties();
                    }])->categoryGroupsWithProperties();
                }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
                    return $q->active()->orderBy('order', 'asc');
                }])->orderBy('order', 'asc')->get();
        } elseif (request()->has('type') && request()->has('on_home')) {
            $elements = Category::active()->where(request()->type, true)->whereHas('users', function ($q) {
                return $q->active();
            }, '>', 0)->onHome()->with(['children' => function ($q) {
                return $q->active()->where(request()->type, true)->with(['children' => function ($q) {
                    return $q->active()->where(request()->type, true)->categoryGroupsWithProperties();
                }])->categoryGroupsWithProperties();
            }])->categoryGroupsWithProperties()->with(['tags' => function ($q) {
                return $q->active()->orderBy('order', 'asc');
            }])->orderBy('order', 'asc')->get();
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

    public function search(CategoryFilters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $elements = Category::active()->filters($filters)->orderBy('id', 'desc')->paginate(Self::TAKE_MIN);
        if (!$elements->isEmpty()) {
            return response()->json(CategoryLightResource::collection($elements), 200);
        } else {
            return response()->json(['message' => trans('general.no_elements')], 400);
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
