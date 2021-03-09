<?php

namespace App\Http\Controllers\Backend;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Services\Search\Filters;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Order::query();
        if (request()->has('status')) {
            $elements = $elements->where(['status' => request()->status])
                ->with('order_metas.product.product_attributes', 'order_metas.product_attribute.size', 'order_metas.product_attribute.color', 'order_metas.service')
                ->whereHas('order_metas.product', function ($q) {
                    return $q->where('user_id', auth()->id());
                })
                ->orderBy('id', 'desc')->paginate(parent::TAKE);
        } else if (request()->has('paid')) {
            $elements = $elements->where('paid', true)
                ->with('order_metas.product.product_attributes', 'order_metas.product_attribute.size', 'order_metas.product_attribute.color', 'order_metas.service')
                ->whereHas('order_metas.product', function ($q) {
                    return $q->where('user_id', auth()->id());
                })
                ->orderBy('id', 'desc')->paginate(parent::TAKE);
        } else {
            $elements = $elements->with('order_metas.product.product_attributes', 'order_metas.product_attribute.size', 'order_metas.product_attribute.color', 'order_metas.service')
                ->whereHas('order_metas.product', function ($q) {
                    return $q->where('user_id', auth()->id());
                })
                ->orderBy('created_at', 'desc')
                ->paginate(parent::TAKE);
        }

        return view('backend.modules.order.index', compact('elements'));
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
        $element = Order::whereId($id)->with('order_metas.product.product_attributes','user.country')->first();
        if ($element->order_metas->first()->isQuestionnaireType) {
            $markdown = new Markdown(view(), config('mail.markdown'));
            return $markdown->render('emails.order-complete', ['order' => $element, 'user' => $element->user]);
        }
        return view('backend.modules.order.show', compact('element'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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

    }

    public function changeStatus(Request $request)
    {

        $status = Order::whereId($request->id)->first()->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'status changed successfully');

    }

    public function addOrderTrackId(Request $request)
    {
        $order = Order::whereId($request->id)->first();

        $order->update([
            'status' => 'shipped',
            'track_id' => ($request->trackId != '' ? $request->trackId : NULL)
        ]);

        $email = new OrderShipped($order);
        Mail::to($order->user->email)->send($email);

        return redirect()->back()->with('success', 'status changed successfully');
    }

    public function ordersBetweenDates(Request $request)
    {
        $orders = Order::with('user', 'order_metas', 'country')->whereBetween('created_at', array(Carbon::createFromFormat('m/d/Y', $request->from)->toDateString(), Carbon::createFromFormat('m/d/Y', $request->to)->toDateString()))->orderBy('created_at', 'desc')->get();

        return view('backend.modules.order.index', compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Order::whereId($id)->first();
        if ($element->delete()) {
            return redirect()->route('backend.order.index')->with('success', 'order deleted');
        }
        return redirect()->route('backend.order.index')->with('error', 'order not deleted');
    }
}
