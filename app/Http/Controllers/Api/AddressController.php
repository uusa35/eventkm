<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
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
        //
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
        $validate = validator($request->all(), [
            'name' => 'required|min:2|max:100',
            'content' => 'required|min:2|max:100',
            'block' => 'required|min:1',
            'floor' => 'min:1|nullable',
            'building' => 'min:1|nullable',
            'apartment' => 'min:1|nullable',
            'area' => 'required|min:1',
            'country' => 'min:1|nullable',
            'country_id' => 'exists:countries,id|nullable',
            'governate_id' => 'exists:governates,id|nullable',
            'area_id' => 'exists:areas,id|nullable',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $element = $request->user()->addresses()->create($request->all());
        return response()->json(AddressResource::make($element), 200);
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
        $validate = validator($request->all(), [
            'name' => 'required|min:2|max:100',
            'content' => 'required|min:2|max:100',
            'block' => 'required|min:1',
            'floor' => 'min:1|nullable',
            'building' => 'min:1|nullable',
            'apartment' => 'min:1|nullable',
            'area' => 'required|min:1',
            'country' => 'min:1|nullable',
            'country_id' => 'exists:countries,id|nullable',
            'governate_id' => 'exists:governates,id|nullable',
            'area_id' => 'exists:areas,id|nullable',
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $request->user()->addresses()->whereId($id)->update($request->all());
        $element = Address::whereId($id)->first();
        return response()->json(AddressResource::make($element), 200);
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
        if ($element) {
            $element->delete();
            return response()->json(['message', trans('message.address_deleted_successfully')], 200);
        }
        return response()->json(['message' => trans('message.address_is_not_deleted')], 400);
    }
}
