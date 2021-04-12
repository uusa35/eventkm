<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserStore;
use App\Http\Requests\Backend\UserUpdate;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Nexmo\Laravel\Facade\Nexmo;

class UserController extends Controller
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
    public function store(UserStore $request)
    {
        //
    }

    /**
     * Description : Edit Profile Page for a user
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $element = User::whereId($id)->with('orders.order_metas.product','country','role','products')->first();
        $this->authorize('user.update', $element);
        return view('backend.modules.user.show', compact('element'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = User::whereId($id)->first();
        $this->authorize('user.update', $element);
        $countries = Country::active()->get();
        $roles = Role::active()->get();
        $categories = Category::active()->where('is_user',true)->with(['children' => function ($q) {
            return $q->where('is_user', true)->with(['children' => function ($q) {
                return $q->where('is_user', true);
            }]);
        }])->get();
        $products = Product::active()->available()->hasImage()->serveCountries()->hasStock()->get();
        return view('backend.modules.user.edit', compact('element', 'roles', 'countries', 'categories','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, $id)
    {
        $element = User::whereId($id)->with('categories')->first();
        $this->authorize('user.update', $element);
        $updated = $element->update($request->except('image', 'bg', 'banner', 'path', 'categories','surveys'));
        $country = request()->has('country_id') ? Country::whereId(request('country_id'))->first() : null;
        if ($updated) {
            $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1000', '1000'], true) : null;
            $request->has('images') ? $this->saveGallery($element, $request, 'images', ['1080', '1440'], true) : null;
            $request->hasFile('bg') ? $this->saveMimes($element, $request, ['bg'], ['1080', '1440'], true) : null;
            $request->hasFile('banner') ? $this->saveMimes($element, $request, ['banner'], ['1080', '350'], true) : null;
            $request->hasFile('path') ? $this->savePath($request, $element) : null;
            $request->has('categories') ? $element->categories()->sync($request->categories) : null;
            $request->has('products') ? $element->productGroup()->sync($request->products) : null;
            $country ? $element->update(['country_name' => $country->slug]) : null;
            $element->surveys()->sync($request->surveys);
            return redirect()->route('backend.home')->with('success', trans('general.user_added'));
        }
        return redirect()->route('backend.user.create')->with('error', trans('general.user_not_added'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = User::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->back()->with('success', 'User deleted.');
        }
        return redirect()->back()->with('error', 'user not deleted !!!');
    }

    public function getResetPassword(Request $request)
    {
        $validator = validator(request()->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $email = $request->email;
        return view('backend.modules.user.reset', compact('email'));

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postResetPassword(Request $request)
    {
        $validator = validator(request()->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'error occurred')->withInputs();
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = bcrypt(request()->password);
            $user->save();
            return redirect()->route('backend.home')->with('success', 'password changed');
        }
        return redirect()->back()->with('error', 'error occurred')->withInputs();
    }

}
