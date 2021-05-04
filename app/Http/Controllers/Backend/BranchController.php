<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Area;
use App\Models\User;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->user()->isAdminOrAbove) {
            $elements = Branch::latest()->get();
        } else {
            $elements = Branch::where(['user_id' => auth()->id()])->get();
        }
        return view('backend.modules.branch.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::active()->get();
        $areas = Area::active()->get();
        $users = User::active()->get();
        return view('backend.modules.branch.create', compact('countries', 'areas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'phone' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $element = Branch::create($request->all());
        if ($element) {
            return redirect()->route('backend.branch.index')->with('success', trans('general.branch_added'));
        }
        return redirect()->route('backend.branch.index')->with('error', trans('general.branch_not_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = Branch::whereId($id)->first();
        $users = User::active()->notAdmins()->notClients()->get();
        $countries = Country::all();
        return view('backend.modules.branch.edit', compact('element', 'countries','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = validator($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'phone' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = Branch::whereId($id)->first()->update($request->all());
        if ($element) {
            return redirect()->route('backend.branch.index')->with('success', 'branch created');
        }
        return redirect()->route('backend.branch.index')->with('error', 'branch not created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Branch::whereId($id)->with('orders')->first();
        if ($element->orders->isEmpty()) {
            $element->forceDelete();
            return redirect()->route('backend.branch.index')->with('success', 'branch deleted');
        }
        return redirect()->route('backend.branch.index')->with('error', 'some orders depend on such branch . it can not be  deleted');
    }
}
