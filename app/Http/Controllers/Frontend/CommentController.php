<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
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
            'commentable_id' => 'required|numeric',
            'commentable_type' => 'required|alpha',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:200|min:5',
            'content' => 'required|max:600|min:5'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $className = '\App\Models\\' . Str::title($request->commentable_type);
        $item = new $className();
        $item = $item->withoutGlobalScopes()->whereId($request->commentable_id)->first();
        $element = $item->comments()->create($request->request->all());
        if ($element) {
            return redirect()->back()->with('success', trans("message.store_success"));
        }
        return redirect()->back()->with('error', trans('message.store_error'));
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
        $element = Comment::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->back()->with('success', trans('message.item_deleted'));
        }
        return redirect()->back()->with('success', trans('message.item_not_deleted'));
    }
}
