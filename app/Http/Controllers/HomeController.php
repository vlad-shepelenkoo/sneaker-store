<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $request->session()->put('user', $user);
        $slides = Slide::where('status', 1)->get()->take(3);
        $categories = Category::orderBy('name')->get();
        $sproducts = Product::saleProducts()->take(8);
        $fproducts = Product::featuredProducts()->take(8);
        $categoriesBanner = Product::categoriesBanner()->take(2);
        return view('index', compact('slides', 'categories', 'sproducts', 'fproducts', 'categoriesBanner'));
    }

    public function contact(){
        return view('contact');
    }

    public function contact_store(ContactRequest $request){
        $validatedContact = $request->validated();
        Contact::create($validatedContact);
        return redirect()->back()->with('success', 'Your message has been sent successfully');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);
        return response()->json($results);
    }

    public function about(){
        return view('about');
    }

    public function store_location(){
        return view('store-location');
    }

    public function privacy_policy(){
        return view('privacy-policy');
    }
}
