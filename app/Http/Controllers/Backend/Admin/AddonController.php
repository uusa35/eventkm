<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\PrimaryController;
use App\Core\Services\Image\PrimaryImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AddonStore;
use App\Models\Addon;
use App\Models\AddonGroup;
use App\Models\Item;
use App\Models\Tag;
use App\Src\Addon\AddonRepository;
use App\Http\Requests\Backend\AddonUpdate;
use App\Http\Requests\Backend\AddonCreate;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Addon::active()->with('services','items')->get();
        return view('backend.modules.addon.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::active()->get();
        return view('backend.modules.addon.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddonCreate $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddonStore $request)
    {
        $element = Addon::create($request->except('image', 'items'));
        if ($element) {
            $request->has('items') ? $element->items()->sync($request->items) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.addon.index')->with('success', 'addon created.');
        }
        return redirect()->route('backend.admin.addon.index')->with('error', 'addon error.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Addon::whereId($id)->with('items')->first();
        $items = Item::active()->get();
        return view('backend.modules.addon.edit', compact('element', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddonUpdate $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddonUpdate $request, $id)
    {
        $element = Addon::whereId($id)->first();
        $updated = $element->update($request->except('image', 'items'));
        if ($updated) {
            $request->has('items') ? $element->items()->sync($request->items) : null;
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.addon.index')->with('success', 'addon created.');
        }
        return redirect()->route('backend.admin.addon.index')->with('error', 'addon error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Addon::whereId($id)->first();
            if ($element->delete()) {
                return redirect()->route('backend.admin.addon.index')->with('success', 'Addon Removed successfully!');
            }
//        }
        return redirect()->back()->with('error', 'Addon not deleted !! please remove elements attached to it first.');
    }

    public function trashed()
    {
        $this->authorize('isSuper');
        $elements = Addon::onlyTrashed()->paginate(Self::TAKE);
        return view('backend.modules.addon.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isSuper');
        $element = Addon::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }
}
