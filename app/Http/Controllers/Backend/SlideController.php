<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Str;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', 'slide');
        if (request()->has('slidable_id') && request()->has('slidable_type') && !auth()->user()->isAdminOrAbove) {
            $validate = validator(request()->all(), [
                'slidable_id' => 'required|numeric',
                'slidable_type' => 'required|alpha'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors());
            }
            $className = '\App\Models\\' . Str::title(request()->slidable_type);
            $item = new $className();
            $item = $item->withoutGlobalScopes()->whereId(request()->slidable_id)->whereHas('slides', function ($q) {
                return $q->active();
            })->with('slides')->get();
            $elements = $item->pluck('slides')->unique()->flatten();
        } elseif (auth()->user()->isAdminOrAbove) {
            $elements = Slide::all();
        }
        if (isset($elements) && $elements->isNotEmpty()) {
            return view('backend.modules.slide.index', compact('elements'));
        }
        return redirect()->back()->with('error', trans('message.no_slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('slide.create');
        $validate = validator(request()->all(), [
            'slidable_id' => 'required|numeric',
            'slidable_type' => 'required|alpha',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }
        return view('backend.modules.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'slidable_id' => 'required|numeric',
            'slidable_type' => 'required|alpha',
            'image' => "image|dimensions:max_width=1900,max_height=1900,min_height=720|max:".env('MAX_IMAGE_SIZE').'"',
//            'image' => 'required|image|dimensions:width=1900,height=1000'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $className = '\App\Models\\' . Str::title($request->slidable_type);
        $item = new $className();
        $item = $item->withoutGlobalScopes()->whereId($request->slidable_id)->first();
        $element = $item->slides()->create($request->request->all());
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], [$request->is_intro ? '900' : '1900'], true) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            return redirect()->route('backend.slide.index', ['slidable_id' => $element->slidable_id, 'slidable_type' => request('slidable_type')])->with('success', trans('message.store_success'));
        }
        return redirect()->back()->with('error', trans('message.store_error'));
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
        $element = Slide::whereId($id)->first();
        $this->authorize('slide.update', $element);
        return view('backend.modules.slide.edit', compact('element'));
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
        $validate = validator($request->all(), [
            'image' => "image|dimensions:max_width=1900,max_height=1900,min_height=720|max:".env('MAX_IMAGE_SIZE').'"',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }
        $element = Slide::whereId($id)->first();
        $updated = $element->update($request->request->all());
        if ($updated) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], [$request->is_intro ? '900' : '1900'], true) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            return redirect()->route('backend.slide.index', ['slidable_id' => $element->slidable_id, 'slidable_type' => $element->type])->with('success', trans('message.update_success'));
        }
        return redirect()->back()->with('error', trans('message.update_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Slide::whereId($id)->first();
        if ($element) {
            $element->delete();
            return redirect()->route('backend.slide.create',['slidable_id' => $id,'slidable_type' => $element->type])->with('success', trans('message.delete_success'));
        }
        return redirect()->route('backend.home')->with('error', trans('message.delete_error'));
    }
}
