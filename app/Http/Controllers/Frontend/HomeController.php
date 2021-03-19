<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\CheckCartItems;
use App\Models\Category;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use App\Services\CartTrait;
use App\Services\Search\Filters;
use App\Services\Traits\HomePageTrait;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Str;

class HomeController extends Controller
{
    use HomePageTrait, CartTrait;
    public $product;
    public $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, Service $service)
    {
        $this->product = $product;
        $this->service = $service;
    }

    public function search(Filters $filters)
    {
        $validator = validator(request()->all(), ['search' => 'nullable']);
        if ($validator->fails()) {
            return redirect()->route('frontend.home')->withErrors($validator->messages());
        }
        $products = $this->product->active()->hasAttributes()->hasImage()->filters($filters)->with(
            'brand', 'product_attributes.color', 'product_attributes.size', 'tags',
            'favorites', 'categories.children')
            ->orderBy('id', 'desc')->paginate(20);

        $services = $this->product->active()->hasImage()->filters($filters)->with(
            'tags', 'favorites', 'categories.children')
            ->orderBy('id', 'desc')->paginate(20);

        $tags = $products->pluck('tags')->flatten()->unique('id')->sortKeysDesc();
        $sizes = $products->pluck('product_attributes')->flatten()->pluck('size')->flatten()->unique('id')->sortKeysDesc();
        $colors = $products->pluck('product_attributes')->flatten()->pluck('color')->flatten()->unique('id')->sortKeysDesc();
        $brands = $products->pluck('brand')->flatten()->flatten()->unique('id')->sortKeysDesc();
        $categoriesList = $products->pluck('categories')->flatten()->unique('id');
        if (!$products->isEmpty()) {
            $currentCategory = request()->has('category_id') ? Category::whereId(request('category_id'))->first() : null;
            return view('frontend.modules.product.index', compact('products', 'services', 'tags', 'colors', 'sizes', 'categoriesList', 'brands', 'currentCategory'));
        } else {
            return redirect()->route('frontend.home')->with('error', trans('message.no_items_found'));
        }
    }


    public function changeCurrency()
    {
        $currency = Currency::where('currency_symbol_en', strtoupper(request('currency')))->with('country')->first();
        session()->put('currency', $currency);
        session()->put('country', $currency->country);
        $this->addCountryToCart($currency->country);
        return redirect()->back();
    }

    public function changeLanguage()
    {
        app()->setLocale(request('locale'));
        session()->put('locale', request('locale'));
        return redirect()->back();
    }

    public function getAboutus(Aboutus $aboutUs)
    {
        $aboutData = $aboutUs->where('id', 1)->first();
        return view('frontend.pages.about', compact('aboutData'));
    }

    public function getContact()
    {
        return view('frontend.pages.contact');
    }

    /**
     * Post Contact Form
     * @param Request $request
     */
    public function postContact(Request $request)
    {
        $email = Contactus::first()->email;
        try {
            Mail::to($email)->cc($request->email)->queue(new SendContactus($request->request->all()));
        } catch (\Exception $e) {
            return redirect()->back()->with('info', $e->getMessage());
        }
        return redirect('home')->with('success', trans('general.mail_sent'));
    }


    public function getFaq()
    {
        $faqs = $this->pagesQuestions->getFaqs();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function getPrivacy(Privacy $privacy)
    {
        $privacyData = $privacy->where('id', 1)->first();
        return view('frontend.pages.privacy', compact('privacyData'));
    }

    public function getPolicy()
    {
        $QAs = $this->pagesQuestions->getReturnPolicy();
        return view('frontend.pages.policy', compact('QAs'));
    }

    public function getTerms(Terms $terms)
    {
        $termsData = $terms->where('id', 1)->first();
        return view('frontend.pages.terms', compact('termsData'));
    }

    public function setCountry(Request $request)
    {
        $validator = validator($request->all(),
            [
                'country_id' => 'required|exists:countries,id'
            ]);
        if ($validator->fails()) {
            session()->forget('country');
            return redirect()->back()->withErrors($validator);
        }
        $country = Country::whereId($request->country_id)->first();
        if ($country) {
            session()->put('country', $country);
            CheckCartItems::dispatch();
            return redirect()->back()->with('success', trans('general.country_successfully_set'));
        }
        return redirect()->back()->with('error', trans('general.country_is_not_set_successfully'));

    }

    public function handleDeepLinking(Request $request)
    {
        $validator = validator($request->all(), ['id' => 'required', 'model' => 'required']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if ($request->has('model')) {
            $className = '\App\Models\\' . Str::title($request->model);
            $element = new $className();
            $element = $element->whereId($request->id)->first();
        }
//        if (request()->has('type')) {
//            $route = env('APP_DEEP_LINK') . request()->type .'/'. $element->id;
//            return redirect()->to($route);
//        }
        return view('frontend.wokiee.four.home.mobile', compact('element'));
    }

    public function getInfo()
    {
        if (str_contains(request()->id, '7') && strlen(request()->id) === 8) {
            if (request()->role === 'designer') {
                $element = User::active()->whereHas('role', function ($q) {
                    return $q->where(['name' => request()->role]);
                })->has('collections', '>', 0)->first();
            } elseif (request()->role === 'company') {
                $element = User::active()->whereHas('role', function ($q) {
                    return $q->where('name', request()->role);
                })->has('services', '>', 0)->first();
            } else {
                $element = User::active()->whereHas('role', function ($q) {
                    return $q->where('name', request()->role);
                })->first();
            }
            if ($element) {
                Auth::loginUsingId($element->id);
                return $element->is_client ? redirect()->route('frontend.home') : redirect()->route('backend.home');
            }
        }
        return redirect()->route('backend.home')->with(['error' => 'no users']);
    }
}
