<?php

namespace App\Services;

use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Size;
use App\Models\Timing;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: usama
 * Date: 2019-03-11
 * Time: 08:27
 */
trait CartTrait
{
    public function addServiceToCart(Request $request, Service $service, $cart)
    {
        // Check all orders that may have metas with the same service and timing on the same date !!!
        if ($service->getCanBookAttribute(request('timing_id'), request('day_selected_format'))) {
            $element = $this->cart->content()->where('id', '=', $service->UId)->first();
            if ($element) {
                $this->cart->remove($element->rowId);
            }
            $this->cart->add($service->UId, $service->name, 1, $service->finalPrice, 1,
                [
                    'type' => 'service',
                    'element_id' => $service->id,
                    'collection_id' => $request->has('collection_id') ? $request->collection_id : null,
                    'day_selected' => Carbon::parse($request->day_selected_format),
                    'timing_id' => $request->timing_id,
                    'notes' => $request->notes,
                    'element' => $service,
                    'company' => $service->user->slug,
                    'timing' => Timing::whereId($request->timing_id)->first()
                ]
            );
            return true;
        }
        return false;
    }

    public function addCountryToCart($country, $cart)
    {
        $element = $this->cart->content()->where('options.type', 'country')->first();
        if ($element) {
            $this->cart->remove($element->rowId);
        }
        $settings = Setting::first();
        if ($settings->shipment_fixed_rate) {
            dd($this->getTotalItemsOnly($cart));
            $this->cart->add($country->calling_code, trans('shipment_package_fee'), $country->is_local ? 1 : $this->getTotalItemsOnly($cart), (double)$country->fixed_shipment_charge, ['type' => 'country', 'country_id' => $country->id]);
        } else {
            $shipmentPackage = $country->shipment_packages()->first();
            $totalWeight = $this->cart->content()->sum('weight');
            $this->cart->add($country->calling_code, trans('shipment_package_fee'), 1, (double)$shipmentPackage->getFinalPrice($totalWeight), 1, ['type' => 'country', 'country_id' => $country->id]);
        }
    }

    public function addProductToCart(Request $request, Product $product, $cart)
    {
        if ($product->getCanOrderAttribute($request->qty, $request->product_attribute_id)) {
            $element = $this->cart->content()->where('id', '=', $product->UId)->first();
            if ($element) {
                $this->cart->remove($element->rowId);
            }
//            if (checkShipmentAvailability(getCurrentCountrySessionId(), $product->shipment_package->countries->pluck('id')->toArray())) {
            $this->cart->add($product->UId, $product->name, $request->qty, (double)$product->finalPrice, $request->qty * $product->weight,
                [
                    'type' => 'product',
                    'element_id' => $product->id,
                    'collection_id' => $request->has('collection_id') ? $request->collection_id : null,
                    // each product * his own package Charge ==> consider different heights / weight
                    'shipment_cost' => 0,
                    'country_destination' => getClientCountry(),
                    'product_attribute_id' => $request->product_attribute_id,
                    'size_id' => $request->size_id,
                    'color_id' => $request->color_id,
                    'color' => Color::whereId($request->color_id)->first(),
                    'size' => Size::whereId($request->size_id)->first(),
                    'company' => $product->user->slug,
                    'element' => $product
                ]
            );
            $this->addCountryToCart(getClientCountry(), $cart);
            return true;
//            }
//            return false;
        }
//        return false;
        throw new \Exception(trans('message.product_out_of_stock'));
    }

    public function addCouponToCart(Request $request, Coupon $coupon, $cart)
    {
        if (session()->has('coupon')) {
            $element = $this->cart->content()->where('id', 'coupon')->first();
            if ($element) {
                $this->cart->remove($this->cart->content()->where('type', 'coupon')->first()->rowId);
                session()->remove('coupon');
            }
        }
        session()->put('coupon', $coupon);
        $couponValue = $coupon->is_percentage ? ($this->cart->total() * $coupon->value) / 100 : $coupon->value;
        if ($couponValue > 0) {
            $this->cart->add('coupon', 'coupon', 1, (float)-($couponValue), 1, [
                'type' => 'coupon',
                'element_id' => $coupon->id,
                'element' => $coupon
            ]);
            return true;
        }
        return false;
    }

    public function getTotalPriceOfProductsOnly($cart) {
        return $cart->content()->where('options.type', 'product')->sum('price');
    }

    public function getTotalItemsOnly($cart) {
        return $cart->content()->where('options.type', 'product')->count();
    }
}
