<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    private $slider;
    private $product;
    private $category;
    public function __construct(Slider $slider, Category $category, Product $product) {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    public function index() {
        $sliderProp = $this->slider->latest()->get();
        $productProp = $this->product->latest()->take(5)->get();
        $productRecommend = $this->product->latest('views_count', 'desc')->take(3)->get();
        $categoryProp = $this->category->where('parent_id', 0)->get();
        $categoryLimit = $this->category->where('parent_id', 0)->take(3)->get();
        return view('client.home.index', ['slider' => $sliderProp, 'category' => $categoryProp, 'product' => $productProp, 'productRecommend' => $productRecommend, 'categoryLimit' => $categoryLimit]);
    }
}
