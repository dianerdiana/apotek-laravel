<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = Auth::user();
    $myCarts = $user->carts()->with('product')->get();

    return view('frontend.carts', [
      'myCarts' => $myCarts
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $product_id = $request->product_id;
    $user = Auth::user();
    $existingCartItem = Cart::where('user_id', $user->id)->where('product_id', $product_id)->first();

    if ($existingCartItem) {
      return redirect()->route('carts.index');
    }

    DB::beginTransaction();

    try {
      $cart = Cart::updateOrCreate([
        "user_id" => $user->id,
        'product_id' => $product_id
      ]);

      $cart->save();
      DB::commit();

      return redirect()->route('carts.index');
    } catch (Exception $e) {
      DB::rollBack();

      $error = ValidationException::withMessages([
        'system_error' => ('System Error! ' . $e->getMessage())
      ]);
      throw $error;
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Cart $cart)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Cart $cart)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Cart $cart)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Cart $cart)
  {
    try {
      $cart->delete();

      return redirect()->back();
    } catch (Exception $e) {
      DB::rollBack();

      $error = ValidationException::withMessages([
        'system_error' => ('System Error! ' . $e->getMessage())
      ]);
      throw $error;
    }
  }
}
