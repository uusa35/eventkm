<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServiceCartResource;
use App\Http\Resources\ServiceExtraLightResource;
use App\Http\Resources\ServiceLightResource;
use App\Http\Resources\ServiceResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Service;
use App\Models\Timing;
use App\Services\Search\Filters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('on_home') && request()->on_home) {
            $elements = Service::active()->onHome()->available()->hasImage()->hasValidTimings()->hasAtLeastOneCategory()->activeUsers()->paginate(self::TAKE_LESS);
        } elseif (request()->has('ids')) {
//            $elements = Service::active()->hasImage()->onHome()->available()->with('product_attributes.size', 'product_attributes.color')->paginate(self::self::TAKE_LESS);
        } else {
            $elements = Service::active()->hasImage()->hasValidTimings()->hasAtLeastOneCategory()->activeUsers()->paginate(self::TAKE_LESS);
        }
        return response()->json(ServiceExtraLightResource::collection($elements), 200);
    }


    public function search(Filters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return redirect()->route('frontend.home')->withErrors($validator->messages());
        }
        $elements = Service::active()->hasImage()->hasValidTimings()->filters($filters)->hasAtLeastOneCategory()->activeUsers()->with(
            'user.country', 'images'
        )->with(['categories' => function ($q) {
            return $q->has('services', '>', 0);
        }])->orderBy('id', 'desc')->paginate(Self::TAKE_MIN);
        if (!$elements->isEmpty()) {
            return response()->json(ServiceLightResource::collection($elements), 200);
        } else {
            return response()->json(['message' => trans('general.no_services')], 400);
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
        $element = Service::active()->whereId($id)->with(['images', 'videos', 'user'])->with(['timings' => function ($q) {
            return $q->active()->available()->workingDays()->orderBy('order','asc');
        }])->with(['categories' => function ($q) {
            return $q->active()->limit(SElf::TAKE_TINY);
        }])->first();
        if ($element) {
            IncreaseElementViews::dispatch($element);
            return response(new ServiceResource($element), 200);
        }
        return response()->json(['message' => trans('general.this_product_does_not_exist')], 400);
    }

    public function getServiceForCart(Request $request)
    {
        if ($request->has('cart_id')) {
            $element = Service::whereId($request->service_id)->with(['product_attributes' => function ($q) {
                return $q->where('id', request()->product_attribute_id)->with('color', 'size');
            }])->with('user')->first();
        } else {
            $element = Service::whereId($request->service_id)->with('color', 'size', 'user')->first();
        }
        return response()->json(new ServiceCartResource($element), 200);
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
