<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Page;
use App\Models\Country;
use App\Models\Field;
use App\Models\Group;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Role;
use App\Models\ShipmentPackage;
use App\Models\Size;
use App\Models\Slide;
use App\Models\Timing;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\View\View;

class ViewComposers
{


    public function getCart(View $view)
    {
        $cart = Cart::instance('shopping')->content();
        return $view->with(compact('cart'));
    }

    public function getCartCount(View $view)
    {
        $cartCount = Cart::instance('shopping')->count();
        return $view->with(compact('cartCount'));
    }

    public function getCurrency(View $view)
    {
        $currency = session()->has('currency') ? session()->get('currency') : Currency::whereHas('country', function ($q) {
            return $q->where('is_local', true);
        })->first();
        return $view->with(compact('currency'));
    }

    public function getCurrencies(View $view)
    {
        $currencies = Currency::active()->with('country')->get();
        return $view->with(compact('currencies'));
    }

    public function getSliders(View $view)
    {
        $sliders = Slide::active()->onHome()->get();
        return $view->with(compact('sliders'));
    }

    public function getCategories(View $view)
    {
        $categories = Category::active()->onlyParent()->with(['children' => function ($q) {
            return $q->active()->with(['children' => function ($q) {
                return $q->active();
            }]);
        }])->get();
        return $view->with(compact('categories'));
    }

    public function getRoles(View $view)
    {
        $roles = Role::where('id', '!=', 1)->get();
        return $view->with(compact('roles'));
    }

    public function getActiveVisibleRoles(View $view)
    {
        $roles = Role::where(['is_visible' => true, 'active' => true, 'is_super' => false, 'is_admin' => false])->get();
        return $view->with(compact('roles'));
    }

    public function getCountries(View $view)
    {
        $countries = Country::active()->with(['governates' => function ($q) {
            return $q->with('areas')->orderby('order', 'asc');
        }])->get();
        return $view->with(compact('countries'));
    }

    public function getSettings(View $view)
    {
        $settings = Setting::first();
        return $view->with(compact('settings'));
    }

    public function getSizes(View $view)
    {
        $sizes = Size::all();
        return $view->with(compact('sizes'));
    }

    public function getColors(View $view)
    {
        $colors = Color::all();
        return $view->with(compact('colors'));
    }

    public function getPages(View $view)
    {
        $pages = Page::active()->orderBy('order', 'asc')->get();
        return $view->with(compact('pages'));
    }

    public function getShipmentPackages(View $view)
    {
        $packages = ShipmentPackage::active()->get();
        return $view->with(compact('packages'));
    }

    public function getBranches(View $view)
    {
        $branches = Branch::active()->with('country')->get();
        return $view->with(compact('branches'));
    }

    public function getActiveColors(View $view)
    {
        $colors = Color::active()->get();
        return $view->with(compact('colors'));
    }

    public function getActiveSizes(View $view)
    {
        $sizes = Size::active()->get();
        return $view->with(compact('sizes'));
    }

    public function getBrands(View $view)
    {
        $brands = Brand::active()->has('products', '>', 0)->take(8)->get();
        return $view->with(compact('brands'));
    }

    public function getAllTimingsAvailable(View $view)
    {
        $timings = Timing::orderBy('start', 'asc')->get()->pluck('startTime', 'id')->unique();
        return $view->with(compact('timings'));
    }

    public function getCountriesWorld(View $view)
    {

        if (!Cache::has('countriesWorld')) {
            Cache::rememberForever('countriesWorld', function () {
                return config('countriesWorld');
            });
        }
        $countriesWorld = Cache::get('countriesWorld');
        return $view->with(compact('countriesWorld'));
    }

    public function getFaqs(View $view) {
        $faqs = Faq::active()->get();
        return $view->with(compact('faqs'));
    }
}

