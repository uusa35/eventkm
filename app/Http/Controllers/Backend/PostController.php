<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Post::all();
        return view('backend.modules.post.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::active()->get();
        return view('backend.modules.post.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->request->all(), [
            'title_ar' => 'required|min:3:max:100',
            'title_en' => 'required|min:3:max:100',
            'slug_ar' => 'required|min:3:max:100',
            'slug_en' => 'required|min:3:max:100',
            'caption_ar' => 'min:3:max:100',
            'caption_en' => 'min:3:max:100',
            'content_ar' => 'required|min:100',
            'content_en' => 'required|min:100',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        $element = Post::create($request->request->all());
        if ($element) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            return redirect()->route('backend.post.index')->with('success', 'post saved.');
        }
        return redirect()->back()->with('error', 'error .. please try again');
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
        $element = Post::whereId($id)->first();
        $users = User::active()->get();
        return view('backend.modules.post.edit', compact('element','users'));
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
        $validate = validator($request->request->all(), [
            'title_ar' => 'required|min:3:max:100',
            'title_en' => 'required|min:3:max:100',
            'slug_ar' => 'required|min:3:max:100',
            'slug_en' => 'required|min:3:max:100',
            'caption_ar' => 'min:3:max:100',
            'caption_en' => 'min:3:max:100',
            'content_ar' => 'required|min:100',
            'content_en' => 'required|min:100',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }
        $element = Post::whereId($id)->first();
        $updated = $element->update($request->request->all());
        if ($updated) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1080', '1440'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            return redirect()->route('backend.post.index')->with('success', 'post updated.');
        }
        return redirect()->back()->with('error', 'error .. please try again');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Post::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->back()->with('success', 'post deleted');
        }
        return redirect()->back()->with('success', 'post is not deleted.');
    }
}
