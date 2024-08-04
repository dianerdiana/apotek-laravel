<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index()
  {
    $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
    $categories = Category::all();

    return view('frontend.index', [
      'products' => $products,
      'categories' => $categories
    ]);
  }

  public function details(Product $product)
  {
    return view('frontend.details', [
      'product' => $product,
    ]);
  }

  public function search(Request $request)
  {
    $keyword = $request->keyword;

    $products = Product::where('name', 'LIKE', "%$keyword%")->get();
    return view('frontend.search', [
      'products' => $products,
      'keyword' => $keyword
    ]);
  }

  public function category(Category $category)
  {
    $products = Product::where('category_id', $category->id)->with('category')->get();
    return view('frontend.category', [
      'products' => $products,
      'category' => $category,
    ]);
  }
}
