<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserLightResource;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
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
        $validate = validator(request()->all(), [
            'member_id' => 'exists:users,id',
            'product_id' => 'exists:products,id',
            'value' => 'required|numeric'
        ]);
        if ($validate->fails()) {
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $element = Rating::updateOrCreate([
            'user_id' => $request->user()->id,
            'member_id' => $request->has('member_id') ? $request->member_id : null,
            'product_id' => $request->has('product_id') ? $request->product_id : null,
        ]);
        $element->value = $request->value * 20;
        $element->save();
        return response()->json(['message' => trans('general.rating_success')], 200);
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
}
