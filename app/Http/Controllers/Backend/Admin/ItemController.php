<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Core\PrimaryController;
use App\Core\Services\Image\PrimaryImageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ItemStore;
use App\Models\Item;
use App\Src\Item\ItemRepository;
use App\Http\Requests\Backend\ItemUpdate;
use App\Http\Requests\Backend\ItemCreate;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Item::active()->get();
        return view('backend.modules.item.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::active()->get();
        return view('backend.modules.item.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ItemCreate $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStore $request)
    {
        $element = Item::create($request->except('image'));
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.item.index')->with('success', 'item created.');
        }
        return redirect()->route('backend.admin.item.index')->with('error', 'item error.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Item::whereId($id)->with('items')->first();
        $items = Item::active()->get();
        return view('backend.modules.item.edit', compact('element', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ItemUpdate $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdate $request, $id)
    {
        $element = Item::whereId($id)->first();
        $updated = $element->update($request->except('image'));
        if ($updated) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            return redirect()->route('backend.admin.item.index')->with('success', 'item created.');
        }
        return redirect()->route('backend.admin.item.index')->with('error', 'item error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Item::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.admin.item.index')->with('success', 'Item Removed successfully!');
        }
//        }
        return redirect()->back()->with('error', 'Item not deleted !! please remove elements attached to it first.');
    }

    public function trashed()
    {
        $this->authorize('isSuper');
        $elements = Item::onlyTrashed()->paginate(SELF::TAKE);
        return view('backend.modules.item.index', compact('elements'));
    }

    public function restore($id)
    {
        $this->authorize('isSuper');
        $element = Item::withTrashed()->whereId($id)->first();
        $element->restore();
        return redirect()->back()->with('success', 'element restored');
    }
}
