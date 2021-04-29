<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\CheckCartItems;
use App\Jobs\OrderSuccessProcessJob;
use App\Jobs\sendSuccessOrderEmail;
use App\Models\Country;
use App\Models\Order;
use App\Models\Setting;
use App\Services\CartTrait;
use App\Services\Traits\OrderTrait;
use Barryvdh\DomPDF\Facade as PDF;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;

class OrderController extends Controller
{
    use OrderTrait, CartTrait;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart->instance('shopping');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements = Order::where(['user_id' => auth()->user()->id, 'status' => 'success'])->with('order_metas.product', 'order_metas.service')->paginate(self::TAKE);
//        $ids = $orders->pluck('order_metas')->flatten()->unique()->pluck('product.id')->toArray();
//        $elements = Product::whereIn('id', $ids)->paginate(12);
        return view('frontend.wokiee.four.modules.order.index', compact('elements'));
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


    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'country_id' => 'required|exists:countries,id',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error', trans('general.country_is_required'));
        }
        $country = Country::whereId($request->country_id)->first();
        CheckCartItems::dispatchNow($country);
        $this->addCountryToCart($country, $request->has('branch_id') && $request->pickup_from_branch);
        $user = $this->createUser($request);
        if (isset($user->id) && $country) {
            $order = $this->createWebOrder($request, $user, $this->cart);
            if (is_subclass_of($order, 'Illuminate\Database\Eloquent\Model')) {
                auth()->login($user);
                $elements = $this->cart->content();
                return view('frontend.wokiee.four.modules.cart.show', compact('elements', 'order'))->with('success', trans('message.register_account_password_is_your_mobile'));
            } else {
                return redirect()->route('frontend.cart.index')->with('error', trans('please_check_your_information_again'));
            }
        } else {
            return redirect()->route('frontend.cart.index')->with('error', trans('please_check_your_information_again'));
        }
        return redirect()->route('frontend.cart.index')->with('error', trans('please_check_your_information_again'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::whereId($id)->with('order_metas.product', 'order_metas.product_attribute.color', 'order_metas.product_attribute.size')->first();
        $coupon = session('coupon') ? session('coupon') : null;
        return view('frontend.modules.order.show', compact('order', 'coupon'));
    }

    public function viewInvoice($id)
    {
        $order = Order::whereId($id)->with('order_metas.product', 'order_metas.product_attribute.color', 'order_metas.product_attribute.size', 'services')->first();
        $markdown = new Markdown(view(), config('mail.markdown'));
        return $markdown->render('emails.order-complete', ['order' => $order, 'user' => $order->user]);
    }

    public function pdfInvoice($id)
    {
        $order = Order::whereId($id)->with('order_metas.product', 'order_metas.product_attribute.color', 'order_metas.product_attribute.size', 'services')->first();
        $markdown = new Markdown(view(), config('mail.markdown'));
        $final = $markdown->render('emails.order-complete', ['order' => $order, 'user' => $order->user]);
//        $pdf = PDF::loadView('emails.order-complete', ['order' => $order, 'user' => $order->user])->setPaper('a4', 'landscape');
        $pdf = PDF::loadHTML($final)->setPaper('a4', 'portrait');
        return $pdf->save('invoice.pdf', 'storage/public/uploads/files', 'UTF-8')->stream('download.pdf');
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

    public function cashOnDeliveryReceived(Request $request)
    {
        $order = Order::whereId($request->id)->with('order_metas.product.product_attributes.size','order_metas.product.product_attributes.color','order_metas.service','user')->first();
        if ($order->cash_on_delivery) {
            $contactus = Setting::first();
            if (env('BITS')) {
                $order->update(['paid' => true]);
                if($order->paid) {
                    $this->decreaseQty($order);
                    OrderSuccessProcessJob::dispatch($order, $order->user)->delay(now()->addSeconds(15));
                    $markdown = new Markdown(view(), config('mail.markdown'));
                    session()->forget('cart');
                    return $markdown->render('emails.order-complete', ['order' => $order, 'user' => $order->user]);
                }
                throw new \Exception('Order is not complete');
            } else {
                dispatch(new sendSuccessOrderEmail($order, $order->user, $contactus))->delay(now()->addSeconds(10));
                session()->forget('cart');
                return redirect()->route('frontend.home')->with('success', trans('message.we_received_your_order_order_shall_be_reviewed_thank_your_for_choosing_our_service'));
            }
        }
        return redirect()->route('frontend.home')->with('error', 'Order is not complete');
    }
}
