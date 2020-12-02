<?php

namespace App\Http\Controllers\Backend;

use App\Events\MyEvent;
use App\Http\Requests\Backend\ServiceStore;
use App\Http\Requests\Backend\ServiceUpdate;
use App\Models\Addon;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Timing;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', 'service');
        if (auth()->user()->isAdminOrABove) {
            $elements = Service::with('user', 'slides','addons.items','items')->get();
        } else {
            $elements = request()->has('type')
                ? Service::active()->myItems()->where([request('type') => true])->with('user', 'slides','addons.items','items')->orderBy('id', 'desc')->get()
                : Service::active()->myItems()->with('user', 'slides','addons.items','items')->orderBy('id', 'desc')->get();
        }
        return view('backend.modules.service.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('service.create');
        $categories = Category::active()->where('is_service', true)->with(['children' => function ($q) {
            return $q->where('is_service', true)->with(['children' => function ($q) {
                return $q->where('is_service', true);
            }]);
        }])->get();
        $tags = Tag::active()->get();
        $videos = Video::active()->get();
        $brands = Brand::active()->get();
        $users = User::active()->notAdmins()->notClients()->get();
        $timings = Timing::active()->available()->workingDays()->orderBy('day_no', 'asc')->get()->groupBy('day_no');
        $areas = auth()->user()->isAdminOrAbove ? Area::active()->get() : Area::active()->where('country_id', auth()->user()->country_id)->with('country')->get();
        $addOns = Addon::active()->whereHas('items' ,function ($q) {
            return $q->active();
        }, '>', 0)->get();
        $items = Item::active()->get();
        return view('backend.modules.service.create', compact('categories', 'tags', 'brands', 'users', 'areas', 'videos', 'timings', 'addOns', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStore $request)
    {
        $end_sale = $request->has('end_sale') ? Carbon::parse(str_replace('-', '', $request->end_sale))->toDateTimeString() : null;
        $start_sale = $request->has('start_sale') ? Carbon::parse(str_replace('-', '', $request->start_sale))->toDateTimeString() : null;
        $start_date = $request->has('start_date') ? Carbon::parse(str_replace('-', '', $request->start_date))->toDateTimeString() : null;
        $end_date = $request->has('end_date') ? Carbon::parse(str_replace('-', '', $request->end_date))->toDateTimeString() : null;
        $element = Service::create($request->except(['_token', 'image', 'images', 'categories', 'start_sale', 'start_date','end_date','end_sale', 'tags', 'areas', 'videos', 'timings','addons','items']));
        if ($element) {
            $start_sale ? $element->update(['start_sale' => $start_sale]) : null;
            $end_sale ? $element->update(['end_sale' => $end_sale]) : null;
            $start_date ? $element->update(['start_date' => $start_date]) : null;
            $end_date ? $element->update(['end_date' => $end_date]) : null;
            $element->categories()->sync($request->categories);
            $element->tags()->sync($request->tags);
            $element->videos()->sync($request->videos);
            $element->timings()->sync($request->timings);
            $request->has_addons ? $element->addons()->sync($request->addons) : $element->addons()->sync([]);
            $request->has_only_items ? $element->items()->sync($request->items) : $element->items()->sync([]);
            $request->has_only_items ? $element->addons()->sync([]) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            !is_null($request->areas) && $request->areas[0] === 'all' ? $element->areas()->sync($element->user->country->areas->pluck('id')->toArray()) : $element->areas()->sync($request->areas);
            return redirect()->route('backend.service.index')->with('success', trans('general.service_saved'));
        }
        return redirect()->back()->with('error', trans('general.service_not_saved'));
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
        $element = Service::whereId($id)->with('areas', 'tags', 'categories.children','addons','items')->first();
        $this->authorize('service.update', $element);
        $categories = Category::active()->where('is_service', true)->with(['children' => function ($q) {
            return $q->where('is_service', true)->with(['children' => function ($q) {
                return $q->where('is_service', true);
            }]);
        }])->get();
        $tags = Tag::active()->get();
        $videos = Video::active()->get();
        $brands = Brand::active()->get();
        $users = User::active()->notAdmins()->get();
        $areas = auth()->user()->isAdminOrAbove ? Area::active()->get() : Area::active()->where('country_id', auth()->user()->country_id)->with('country')->get();
        $timings = Timing::active()->available()->workingDays()->orderBy('day_no', 'asc')->get()->groupBy('day_no');
        $addOns = Addon::active()->whereHas('items' ,function ($q) {
            return $q->active();
        }, '>', 0)->get();
        $items = Item::active()->get();
        return view('backend.modules.service.edit', compact('element', 'categories', 'tags', 'brands', 'users', 'areas', 'videos', 'timings','addOns','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdate $request, $id)
    {
        $end_sale = $request->has('end_sale') ? Carbon::parse(str_replace('-', '', $request->end_sale))->toDateTimeString() : null;
        $start_sale = $request->has('start_sale') ? Carbon::parse(str_replace('-', '', $request->start_sale))->toDateTimeString() : null;
        $start_date = $request->has('start_date') ? Carbon::parse(str_replace('-', '', $request->start_date))->toDateTimeString() : null;
        $end_date = $request->has('end_date') ? Carbon::parse(str_replace('-', '', $request->end_date))->toDateTimeString() : null;
        $element = Service::whereId($id)->first();
        $updated = $element->update($request->except(['_token', 'image', 'images', 'categories', 'start_sale','start_date','end_date' ,'end_sale', 'tags', 'areas', 'videos', 'timings', 'items']));
        if ($updated) {
            $start_sale ? $element->update(['start_sale' => $start_sale]) : null;
            $end_sale ? $element->update(['end_sale' => $end_sale]) : null;
            $start_date ? $element->update(['start_date' => $start_date]) : null;
            $end_date ? $element->update(['end_date' => $end_date]) : null;
            $element->categories()->sync($request->categories);
            $element->tags()->sync($request->tags);
            $element->videos()->sync($request->videos);
            $element->timings()->sync($request->timings);
            $request->has_addons ? $element->addons()->sync($request->addons) : $element->addons()->sync([]);
            $request->has_only_items ? $element->items()->sync($request->items) : $element->items()->sync([]);
            $request->has_only_items ? $element->addons()->sync([]) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            if ($request->areas && $request->areas[0] === 'all') {
                $element->areas()->sync($element->user->country->areas->pluck('id')->toArray());
            } else {
                $element->areas()->sync($request->areas);
            }
            return redirect()->route('backend.service.index')->with('success', trans('general.service_saved'));
        }
        return redirect()->back()->with('error', trans('general.service_not_saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Service::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.service.index')->with('success', trans('message.success_service_delete'));
        }
        return redirect()->back()->with('error', trans('message.failure_service_delete'));
    }

    public function trashed()
    {
        $this->authorize('isAdminOrAbove');
        $elements = Service::onlyTrashed()->paginate(100);
        return view('backend.modules.service.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isAdminOrAbove');
        $element = Service::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }
}
