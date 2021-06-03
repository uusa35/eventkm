<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostLightResource;
use App\Http\Resources\PostResource;
use App\Jobs\IncreaseElementViews;
use App\Models\Post;
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
        $elements = Post::active()->orderBy('order', 'asc')->with('comments', 'user')->paginate(SELF::TAKE_MID);
        if ($elements->isNotEmpty()) {
            return response()->json(new PostCollection($elements), 200);
        }
        return response()->json(['message' => trans('empty')], 400);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = Post::active()->with('images', 'user')->with(['comments' => function ($q) {
            return $q->active()->with('owner');
        }])->find($id);
        if ($element) {
            $comments = $element->comments()->paginate(SELF::TAKE_MID);
            $this->dispatchNow(new IncreaseElementViews($element));
            return response()->json(PostLightResource::make($element), 200);
        }
        return response()->json(['message', trans('message.post_does_not_exist'), 400]);
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
