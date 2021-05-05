<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\OrderMeta;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = ProductAttribute::all();
        return view('backend.modules.product_attributes.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validate = validator(request()->all(), ['product_id' => 'required|integer|exists:products,id']);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'no product id');
        }
        $element = Product::whereId(\request('product_id'))->with('product_attributes.size','product_attributes.color')->first();
        return view('backend.modules.product.attribute.create', compact('element'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $element = ProductAttribute::withTrashed()->where(['product_id' => $request->product_id, 'size_id' => $request->size_id, 'color_id' => $request->color_id])->first();
        if($element) {
            $element->forceDelete();
        }
        $validate = validator($request->all(),
            [
                'qty' => 'required|numeric|min:1|max:999',
                'product_id' => 'required|exists:products,id',
                'size_id' => 'required|integer|exists:sizes,id',
                'color_id' => 'required|integer|exists:colors,id|',
            ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = ProductAttribute::create($request->all());
        return redirect()->route('backend.attribute.create', ['product_id' => $element->product_id,'type' => $request->type])->with('success', 'saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $element = ProductAttribute::whereId($id)->first();
        $sizes = Size::active()->get();
        $colors = Color::active()->get();
        return view('backend.modules.product.attribute.edit', compact('element', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator($request->all(),
            [
                'qty' => 'required|numeric|min:0|max:999',
                'product_id' => 'required|exists:products,id',
                'size_id' => 'required|integer|exists:sizes,id',
                'color_id' => 'required|integer|exists:colors,id',
            ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $updated = ProductAttribute:: updateOrCreate(
            [
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
            ],
            [
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
                'qty' => $request->qty,
                'notes_ar' => $request->notes_ar,
                'notes_en' => $request->notes_en,
            ]
        );
        if ($updated) {
            return redirect()->route('backend.product.index')->with('success', 'product attribute saved');
        }
        return redirect()->back()->with('error', 'unknown error while updating product attribute');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = ProductAttribute::where('id', $id)->first();
        $orderMeta = OrderMeta::where('product_attribute_id', $id)->first();
        if (!$orderMeta) {
            $element->delete();
            return redirect()->back()->with('success', 'element deleted');
        }
        return redirect()->back()->with('error', 'not deleted - some orders are relying on such attributes - cant be deleted');
    }

    public function trashed() {
        $elements = ProductAttribute::onlyTrashed()->get();
        return view('backend.modules.product_attributes.trashed', compact('elements'));
    }
}
