<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Faq::all();
        return view('backend.modules.faq.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $element = Faq::create($request->all());
        if ($element) {
            return redirect()->route('backend.admin.faq.index')->with('success', trans('general.faq_added'));
        }
        return redirect()->back()->with('error', trans('general.faq_not_added'));
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
    public function edit($id)
    {
        $element = Faq::whereId($id)->first();
        return view('backend.modules.faq.edit', compact('element'));
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
        $element = Faq::whereId($id)->first();
        if ($element) {
            $element->update($request->all());
            return redirect()->route('backend.admin.faq.index')->with('success', 'Faq added');
        }
        return redirect()->back()->with('error', 'Faq is not saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Faq::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.admin.faq.index')->with('success', 'Faq deleted');
        }
        return redirect()->back()->with('error', 'Faq is not deleted.');
    }
}
