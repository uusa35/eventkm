<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Tag::all();
        return view('backend.modules.tag.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'name' => 'required|alpha|min:3|unique:tags,name',
            'slug_ar' => 'required|min:3',
            'slug_en' => 'required|min:3',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $element = Tag::create($request->all());
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['930', '365'], true) : null;
            return redirect()->route('backend.tag.index')->with('sucess', 'created successfully!!');
        }
        return redirect()->back()->with('error', 'not created !!');
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
        $element = Tag::whereId($id)->first();

        return view('backend.modules.tag.edit', compact('element'));
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
        $validate = validator($request->all(), [
            'name' => 'required|alpha|min:3|unique:tags,name,'.$id,
            'slug_ar' => 'required|min:3',
            'slug_en' => 'required|min:3',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = Tag::whereId($id)->first()->update($request->all());
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['930', '365'], true) : null;
            return redirect()->route('backend.tag.index')->with('success', 'created successfully!!');
        }
        return redirect()->back()->with('error', 'not created !!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Tag::whereId($id)->first()->delete()) {

            return redirect()->route('backend.tag.index')->with('success', 'successful');

        }
        return redirect()->back()->with('error', 'not successful !!');
    }
}
