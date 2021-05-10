<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Governate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class GovernateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index','governate');
        $elements = Governate::all();
        return view('backend.modules.governate.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('governate.create');
        $countries = Country::active()->get();
        return view('backend.modules.governate.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('governate.create');
        $element = Governate::create($request->all());
        if ($element) {
            return redirect()->route('backend.admin.governate.index')->with('success', trans('general.governate_added'));
        }
        return redirect()->back()->with('error', trans('general.governate_not_added'));
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
        $element = Governate::whereId($id)->first();
        $this->authorize('governate.update', $element);
        $countries = Country::active()->get();
        return view('backend.modules.governate.edit', compact('element', 'countries'));
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
        $element = Governate::whereId($id)->first();
        $updated = $element->update($request->all());
        if($updated) {
            return redirect()->route('backend.admin.governate.index')->with('success', 'Governate updated');
        }
        return redirect()->back()->with('error', 'Governate Not updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Governate::whereId($id)->first();
        if($element->delete()) {
            return redirect()->route('backend.admin.governate.index')->with('success', 'Governate deleted');
        }
        return redirect()->back()->with('error', 'Governate not deleted');
    }
}
