<?php

namespace App\Http\Controllers\Backend;

use App\Models\ShipmentPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShipmentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = ShipmentPackage::all();
        return view('backend.modules.shipment_package.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.shipment_package.create');
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
            'name' => 'required|unique:shipment_packages,name',
            'slug_ar' => 'required',
            'slug_en' => 'required',
            'charge' => 'required|numeric|min:1|max:99',
            'charge_one' => 'required|numeric|min:1|max:99',
            'charge_two' => 'required|numeric|min:1|max:99',
            'charge_three' => 'required|numeric|min:1|max:99',
            'charge_four' => 'required|numeric|min:1|max:99',
            'charge_five' => 'nullable|numeric|min:1|max:99',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $element = ShipmentPackage::create($request->all());
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
            return redirect()->route('backend.package.index')->with('success', 'package created');
        }
        return redirect()->back()->with('error', 'package not created');

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
        $element = ShipmentPackage::whereId($id)->first();
        return view('backend.modules.shipment_package.edit', compact('element'));
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
            'name' => 'required|unique:shipment_packages,name,' . $id,
            'slug_ar' => 'required',
            'slug_en' => 'required',
            'charge' => 'required|numeric|min:1|max:99',
            'charge_one' => 'required|numeric|min:1|max:99',
            'charge_two' => 'required|numeric|min:1|max:99',
            'charge_three' => 'required|numeric|min:1|max:99',
            'charge_four' => 'required|numeric|min:1|max:99',
            'charge_five' => 'nullable|numeric|min:1|max:99',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = ShipmentPackage::whereId($id)->update($request->except('_token', '_method'));
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], false) : null;
            return redirect()->route('backend.package.index')->with('success', 'package updated');
        }
        return redirect()->back()->with('error', 'package not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = ShipmentPackage::whereId($id)->first()->delete();
        if ($element) {
            return redirect()->route('backend.package.index')->with('success', 'package deleted');
        }
        return redirect()->route('backend.package.index')->with('error', 'package not deleted');
    }
}
