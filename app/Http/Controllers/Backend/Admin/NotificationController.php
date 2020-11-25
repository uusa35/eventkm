<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Classified;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use App\Services\Traits\NotificationHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class NotificationController extends Controller
{
    use NotificationHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Notification::all();
        return view('backend.modules.notification.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::active()->notClients()->get();
        $products = Product::active()->available()->hasImage()->serveCountries()->hasStock()->hasAtLeastOneCategory()->get();
        $classifieds = Classified::active()->notExpired()->hasImage()->onHome()->available()->get();
        return view('backend.modules.notification.create', compact('users', 'products', 'classifieds'));
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
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'notificationable_type' => 'nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }
        try {
            if ($request->has('notificationable_type') && $request->notificationable_type !== '0') {
                $modal = $request->notificationable_type === 'designer' || $request->notificationable_type === 'company' || $request->notificationable_type === 'shopper' ? 'user' : $request->notificationable_type;
                if($modal === 'product') {
                    $id = $request->product_id;
                } elseif($modal === 'classified') {
                    $id = $request->classified_id;
                } else {
                    $id = $request->user_id;
                }
                $className = '\App\Models\\' . Str::title($modal);
                $element = new $className();
                $item = $element->whereId($id)->first();
                if(!$item) {
                    throw new \Exception('Choose Notification Type Item');
                }
                $element = $item->notificationAlerts()->create([
                    'title' => strip_tags($request->title),
                    'description' => strip_tags($request->description),
                    'type' => $request->notificationable_type,
                    "url" => $request->has('type') && isset($item) ? env('APP_DEEP_LINK') . $request->type . '/' . $item->id : null,
                    'notificationable_type' => $className,
                    'notificationable_id' => $item->id
                ]);
            } else {
                $element = Notification::create([
                    'title' => strip_tags($request->title),
                    'description' => strip_tags($request->description),
                    'notificationable_type' => 0,
                    'notificationable_id' => 0
                ]);
            }
            $url = $request->has('notificationable_type') && isset($item) ? env('APP_DEEP_LINK') . $request->notificationable_type . '/' . $item->id : null;
            if ($element) {
                $request->hasFile('image') ? $this->saveMimes($element, $request, ['image'], ['1905', '750'], true) : null;
                $this->notify($request->title, $request->description, $url, $request);
                return redirect()->route('backend.admin.notification.index')->with('success', 'Notification added');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Notification is not saved. '. $e->getMessage());
        }
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
        $element = Notification::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.notification.index')->with('success', 'aboutus deleted');
        }
        return redirect()->back()->with('error', 'aboutus is not deleted.');
    }
}
