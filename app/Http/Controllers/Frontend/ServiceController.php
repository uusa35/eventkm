<?php

namespace App\Http\Controllers\Frontend;

use App\Jobs\IncreaseElementViews;
use App\Models\Category;
use App\Models\Day;
use App\Models\Service;
use App\Models\Timing;
use App\Services\Search\Filters;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Filters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return redirect()->route('frontend.home')->withErrors($validator->messages());
        }
        $elements = $this->service->active()->hasImage()->serveCountries()->hasValidTimings()->filters($filters)->activeUsers()->with(
            'tags', 'user.country', 'images', 'user.areas', 'favorites'
        )->with(['categories' => function ($q) {
            return $q->has('services', '>', 0)->with('services');
        }])->orderBy('id', 'desc')->paginate(self::TAKE);
        $tags = $elements->pluck('tags')->flatten()->unique('id')->sortKeysDesc();
        $categoriesList = $elements->pluck('categories')->flatten()->unique('id')->sortKeysDesc();
        $vendors = $elements->pluck('user')->unique('id')->flatten();
        $areas = $elements->pluck('user.areas')->flatten()->unique('id');
        if ($elements->isNotEmpty()) {
            $this->saveMainSearchFormElements();
            return view('frontend.wokiee.four.modules.service.index', compact(
                'elements', 'tags', 'areas',
                'categoriesList', 'vendors'
            ));
        } else {
            return redirect()->route('frontend.home')->with('error', trans('message.no_items_found'));
        }
    }

    public function search(Filters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return redirect()->route('frontend.home')->withErrors($validator->messages());
        }
        $elements = $this->service->active()->hasImage()->serveCountries()->hasValidTimings()->filters($filters)->activeUsers()->with(
            'tags', 'user.country', 'images', 'user.areas', 'favorites'
        )->with(['categories' => function ($q) {
            return $q->has('services', '>', 0)->with('services');
        }])->orderBy('id', 'desc')->paginate(self::TAKE);
        $tags = $elements->pluck('tags')->flatten()->unique('id')->sortKeysDesc();
        $categoriesList = $elements->pluck('categories')->flatten()->unique('id')->sortKeysDesc();
        $vendors = $elements->pluck('user')->unique('id')->flatten();
        $areas = $elements->pluck('user.areas')->flatten()->unique('id');
        if ($elements->isNotEmpty()) {
            $this->saveMainSearchFormElements();
            return view('frontend.wokiee.four.modules.service.index', compact(
                'elements', 'tags', 'areas',
                'categoriesList', 'vendors'
            ));
        } else {
            return redirect()->route('frontend.home')->with('error', trans('message.no_items_found'));
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
        $element = Service::whereId($id)->with('categories', 'images', 'tags', 'user')->with(['timings' => function ($q) {
            return $q->active()->workingDays()->available()->with('days');
        }])->first();
        IncreaseElementViews::dispatch($element);
        $workingDays = $element->timings->pluck('day', 'day_no')->keys()->unique()->toArray();
        $dayOff = $element->timings->where('is_off', true)->first();
        $relatedItems = $element->getRelatedItems($element);
        return view('frontend.wokiee.four.modules.service.show', compact('element', 'relatedItems', 'workingDays', 'dayOff'));
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

    public function setDateAndArea()
    {
        $this->saveMainSearchFormElements();
        return redirect()->back()->with('success', trans('message.set_date_and_area'));
    }

    public function saveMainSearchFormElements()
    {
        if (request()->has('save') && request()->save && !session()->has('day_selected_format')) {
            session()->put('day_selected_format', request()->day_selected_format);
            session()->put('day_selected', request()->day_selected);
            session()->put('area_id', request()->area_id);
            session()->put('timing_value', request()->timing_value);
        }
    }

    public function getClearSearch()
    {
        session()->remove('day_selected_format');
        session()->remove('day_selected');
        session()->remove('timing_value');
        return redirect()->route('frontend.service.search')->with('warning', trans('message.search_parameters_clear'));
    }
}
