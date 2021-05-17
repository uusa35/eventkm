<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Address::where('user_id', auth()->id())->with('country', 'governate', 'areaName')->get();
        return view('frontend.wokiee.four.modules.address.index', compact('elements'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::active()->with('areas')->get();
        return view('frontend.wokiee.four.modules.address.create', compact('countries'));
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
            'name' => 'required|min:2|max:100',
            'content' => 'nullable|min:2|max:100',
            'block' => 'nullable|min:1',
            'floor' => 'nullable|min:1',
            'building' => 'nullable|min:1',
            'apartment' => 'nullable|min:1',
            'area' => 'nullable|min:1',
            'country' => 'nullable|min:1',
            'country_id' => 'exists:countries,id|nullable',
            'governate_id' => 'exists:governates,id|nullable',
            'area_id' => 'exists:areas,id|nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $request->request->add(['user_id' => auth()->id()]);
        $element = Address::create($request->all());
        if ($element) {
            return redirect()->back()->with('success', trans('general.process_success'));
        }
        return redirect()->back()->with('error', trans('general.process_failure'));
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
        $element = Address::whereId(auth()->id())->first();
        $countries = Country::active()->with('areas')->get();
        return view('frontend.wokiee.four.modules.address.edit', compact('element', 'countries'));

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
        try {
            $validate = validator($request->all(), [
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
                return redirect()->back()->with(['error' => $validate->errors()->first()]);
            }
            $element = Address::whereId($id)->first();
            if ($element->update($request->all())) {
                return redirect()->back()->with('success', trans('general.process_success'));

            }
            return redirect()->back()->with('error', trans('general.process_failure'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Address::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->back()->with('success', trans('general.process_success'));
        }
        return redirect()->back()->with('error', trans('general.process_failure'));
    }
}
