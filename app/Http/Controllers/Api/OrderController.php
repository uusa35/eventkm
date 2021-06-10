<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Setting;
use App\Models\User;
use App\Services\CartTrait;
use App\Services\Traits\OrderTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use OrderTrait, CartTrait;

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
        $order = $this->checkCart($request); // check cart then create order
        if (is_string($order)) {
            return response()->json(['message' => $order], 400);
        } else {
            return response()->json(['url' => route('frontend.invoice.show', ['id' => $order->id])], 200);
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
        //
    }

    public function calculateDeliveryChargeForApi(Request $request)
    {
        $validate = validator($request->all(), [
            'pickups' => 'array',
            'merchant_id' => 'exists:users,id',
            'country_id' => 'required|exists:countries,id',
            'cart_items_no' => 'required',
            'receive_on_branch' => 'required|boolean',
        ]);
        if ($validate->fails()) {
            print_r('case 1');
            return response()->json(['message' => $validate->errors()->first()], 400);
        }
        $settings = Setting::first();
        $country = Country::whereId($request->country_id)->first();
        if ($request->receive_on_branch && $settings->receive_on_branch && $country->is_local) {
            print_r('case 2');
            return response()->json(0.0, 200);
        } else {
            if ($settings->shipment_fixed_rate) { // fixed Rate enabled
                if (!$settings->multi_cart_merchant && $settings->global_custome_delivery && $request->has('merchant_id')) { // Signle Vendor
                    $user = User::whereId($request->merchant_id)->first();
                    if ($user && $user->custome_delivery && $user->custome_delivery_fees > 0) {
                        print_r('case 3');
                        return response()->json($user->custome_delivery_fees, 200);
                    }
                    print_r('case 1');
                    return response()->json((double)$country->fixed_shipment_charge, 200);
                } else {
                    if (env('MIRSAL_ENABLED') && $request->has('pickups')) {
                        $cost = $this->calculateDeliveryMultiPointsForMirsal($request->pickups);
                        $cost = $cost > 1 ? $cost : (double)$country->fixed_shipment_charge;
                        print_r('case 4');
                        return response()->json((double)$cost, 200);
                    }
                    print_r('case 5');
                    return response()->json((double)$country->fixed_shipment_charge, 200);

                }
            } else if ($request->has('total_weight')) {
                $shipmentPackage = $country->shipment_packages()->first();
                print_r('case 6');
                return response()->json((float)($request->total_weight * (double)$shipmentPackage->charge), 200);
            }
            print_r('case 7');
            return response()->json((double)$country->fixed_shipment_charge, 200);
        }
        print_r('case 8');
        return response()->json(['message' => trans('shipment_package_fee') . trans('general.failure'), 400]);
    }
}
