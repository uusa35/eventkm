<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validate = validator($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with(['user_id' => $request->user_id])->withErrors($validate);
        }
        $elements = Address::whereUserId($request->user_id)->with('areaName', 'country','user')->get();
        return view('backend.modules.address.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::active()->get();
        return view('backend.modules.address.create', compact('countries'));
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:2|max:100',
            'content' => 'min:2|max:100',
            'block' => 'min:1',
            'floor' => 'min:1',
            'building' => 'min:1',
            'apartment' => 'min:1',
            'area' => 'min:1',
            'country' => 'min:1',
            'country_id' => 'exists:countries,id|nullable',
            'governate_id' => 'exists:governates,id|nullable',
            'area_id' => 'exists:areas,id|nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = Address::create($request->all());
        if ($element) {
            return redirect()->route('backend.admin.address.index', ['user_id' => $element->user_id])->with('success', trans('general.addresss_saved'));
        }
        return redirect()->route('backend.admin.user.index')->with('error', 'addresss not saved .. unknown error');
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
        $element = Address::whereId($id)->with('areaName','governate','country')->first();
        $countries = Country::active()->get();
        return view('backend.modules.address.edit', compact('element','countries'));
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required|min:2|max:100',
            'content' => 'min:2|max:100',
            'block' => 'min:1',
            'floor' => 'min:1',
            'building' => 'min:1',
            'apartment' => 'min:1',
            'area' => 'min:1',
            'country' => 'min:1',
            'country_id' => 'exists:countries,id|nullable',
            'governate_id' => 'exists:governates,id|nullable',
            'area_id' => 'exists:areas,id|nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = Address::whereId($id)->first();
        if ($element) {
            $element->update($request->all());
            return redirect()->route('backend.admin.address.index', ['user_id' => $element->user_id])->with('success', 'addresss updated');
        }
        return redirect()->route('backend.admin.user.index')->with('error', 'addresss did not update .. unknown error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Address::whereId($id)->with('  currency', 'branches')->first();
        if (is_null($element->currency) && $element->branches->isEmpty()) {
            if ($element->delete()) {
                return redirect()->route('backend.address.index')->with('success', 'addresss deleted successfully');
            }
        }
        return redirect()->route('backend.address.index')->with('error', 'addresss can not be delete as long as it has currency or branch!!');
    }
}
