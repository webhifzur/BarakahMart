<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\City;
use App\Models\User;
use App\Models\Offer;
use App\Models\Product;
use App\Models\MainSlider;
use App\Models\SubCategory;
use App\Models\OrderDetails;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class FrontendController extends Controller
{
    use PasswordValidationRules;
    public function index(){
        return view('frontend.index',[
            'categories' => ShopCategory::all(),
            'products' => Product::where('status',1)->latest()->limit(16)->get(),
            'sliders' => MainSlider::latest()->get(),
            'offers' => Offer::latest()->get(),
        ]);
    }

    public function singleproduct($slug){
        
        $product = Product::Where('slug', $slug)->first();
        $releted_product = Product::Where('status', 1)->Where('shop_type', $product->shop_type)->Where('id', '!=', $product->id)->latest()->paginate(16);

        $orders = DB::table('orders')->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')->where('user_id', Auth::id())->where('payment_status', 1)->where('status', 2)->exists();

        $product_id = DB::table('orders')->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')->where('user_id', Auth::id())->where('product_id', $product->id)->where('payment_status', 1)->where('status', 2)->whereNull('review')->exists();

        $orderdetails_id = DB::table('orders')->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')->where('user_id', Auth::id())->where('product_id', $product->id)->where('payment_status', 1)->where('status', 2)->whereNull('review')->first();

        $reviews = OrderDetails::where('product_id', $product->id)->whereNotNull('review')->get();
        $stars = OrderDetails::where('product_id', $product->id)->whereNotNull('stars')->sum('stars');

        return view('frontend.single_product',[
            'product' => $product,
            'categories' => ShopCategory::all(),
            'releted_product' => $releted_product,
            'orders' => $orders,
            'product_id' => $product_id,
            'orderdetails_id' => $orderdetails_id,
            'reviews' => $reviews,
            'stars' => $stars,
        ]);

    }

    public function productreview(Request $request)
    {
        OrderDetails::where('id', $request->orderdetail_id)->update([
            'review' => $request->review,
            'stars' => $request->stars,
            'review_date' => Carbon::now(),
        ]);
        return back();
    }

    public function singlecategory($slug)
    {
        $shopcategory = ShopCategory::Where('slug', $slug)->first();
        $subcategory = SubCategory::Where('shop_type', $shopcategory->id)->count();
        
        if($subcategory != 0){
            $subcategory = SubCategory::Where('shop_type', $shopcategory->id)->get();
            return view('frontend.category', [
                'categories' => ShopCategory::all(),
                'shopcategory' => $shopcategory,
                'subcategories' => $subcategory,
            ]);
        }else{
            $product = Product::Where('shop_type', $shopcategory->id)->Where('status',1)->latest()->paginate(24);
            return view('frontend.single_category', [
                'products' => $product,
                'categories' => ShopCategory::all(),
                'shopcategory' => $shopcategory,
            ]);
        }

    }

    public function singlesubcategory($slug)
    {
        $subcategory = SubCategory::Where('slug', $slug)->first();
        $product = Product::Where('subcategory', $subcategory->id)->Where('status',1)->latest()->paginate(24);
        return view('frontend.single_subcategory', [
            'products' => $product,
            'categories' => ShopCategory::all(),
            'subcategory' => $subcategory,
        ]);
    }

    public function productpage()
    {
        return view('frontend.product', [
            'categories' => ShopCategory::all(),
            'products' => Product::where('status', 1)->latest()->paginate(24),
        ]);
    }

    public function cart()
    {
        return view('frontend.cart', [
            'categories' => ShopCategory::all(),
        ]);
    }

    public function checkout()
    {
        return view('frontend.checkout', [
            'categories' => ShopCategory::all(),
            'cities' => City::all(),
        ]);
    }

    public function login()
    {
        return view('frontend.login', [
            'categories' => ShopCategory::all(),
        ]);
    }

    public function signup()
    {
        return view('frontend.signup', [
            'categories' => ShopCategory::all(),
        ]);
    }

    public function customerregister(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'city' => ['required'],
            'area' => ['required'],
            'password' => $this->passwordRules(),
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'city' => $request->city,
            'area' => $request->area,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('registersuccess', 'add successfully');
    }

    public function productsearch(Request $request)
    {
        $search = $request->input('searchValue');
        $result = DB::table('products')
        ->where('status',1)
        ->where('name', 'LIKE', '%' . $search . '%')
            ->get();
        return $result;
    }
}
