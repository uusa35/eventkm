<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $elements = Coupon::with('user')->orderBy('id', 'desc')->get();
        if ($elements->isEmpty()) {
            return redirect()->back()->with('error', trans('message.no_coupons'));
        }
        return view('backend.modules.coupon.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::active()->get();
        return view('backend.modules.coupon.create', compact('users'));
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
            'is_percentage' => 'required|boolean',
            'code' => 'required|min:5',
            'value' => 'required|numeric|between:1,99',
            'minimum_charge' => 'required|numeric|between:1,999',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date|after:yesterday',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $coupon = Coupon::create($request->request->all());
        if ($coupon) {
            return redirect()->route('backend.admin.coupon.index')->with('success', trans('general.coupon_added'));
        }
        return view('backend.modules.coupon.create')->with('error', trans('general.coupon_not_added'));
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
        $element = Coupon::whereId($id)->with('user')->first();
        $users = User::active()->get();
        return view('backend.modules.coupon.edit', compact('element', 'users'));
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
            'is_percentage' => 'required|boolean',
            'code' => 'required|min:5',
            'value' => 'required|numeric|between:1,99',
            'minimum_charge' => 'required|numeric|between:1,999',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date|after:yesterday',
        ]);

        if ($validate->fails()) {
            return redirect()->route('backend.admin.coupon.edit', $id)->withErrors($validate);
        }

        $updated = Coupon::whereId($id)->first()->update($request->all());
        if ($updated) {
            return redirect()->route('backend.admin.coupon.index')->with('success', 'coupon updated');
        }
        return view('backend.modules.coupon.create')->with('error', 'not not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Coupon::whereId($id)->first();

        if ($element->forceDelete()) {
            return redirect()->route('backend.admin.coupon.index')->with('success', 'coupon deleted');
        }
        return redirect()->back()->with('error', 'coupon not deleted');
    }
}
