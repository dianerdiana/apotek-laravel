<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductTransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = Auth::user();
    if ($user->hasRole('buyer')) {
      $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
    } else {
      $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
    }

    return view('admin.product_transactions.index', [
      "product_transactions" => $product_transactions
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
    $user = Auth::user();

    $validated = $request->validate([
      'address' => 'required|string|max:255',
      'city' => 'required|string|max:255',
      'notes' => 'required|string|max:60000',
      'post_code' => 'required|integer',
      'phone_number' => 'required|integer',
      'proof' => 'required|image|mimes:png,jpg,jpeg',
    ]);

    DB::beginTransaction();


    try {
      $subTotalCents = 0;
      $deliveryFeeCents = 10000 * 100;

      $cartItems = $user->carts;

      foreach ($cartItems as $cartItem) {
        $subTotalCents += $cartItem->product->price * 100;
      }

      $taxCents = (int)round(11 * $subTotalCents / 100);
      $insuranceCents = (int)round(23 * $subTotalCents / 100);

      $grandTotalCents = $subTotalCents + $deliveryFeeCents + $taxCents + $insuranceCents;
      $grandTotal = $grandTotalCents / 100;

      $validated['user_id'] = $user->id;
      $validated['total_amount'] = $grandTotal;
      $validated['is_paid'] = false;

      if ($request->hasFile('proof')) {
        $proofPath = $request->file('proof')->store('payment_proofs', 'public');
        $validated['proof'] = $proofPath;
      }

      $newTransaction = ProductTransaction::create($validated);

      foreach ($cartItems as $cartItem) {
        TransactionDetail::create([
          'product_transaction_id' => $newTransaction->id,
          'product_id' => $cartItem->product->id,
          'price' => $cartItem->product->price,
        ]);

        $cartItem->delete();
      }

      DB::commit();

      return redirect()->route('product_transactions.index');
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
  public function show(ProductTransaction $productTransaction)
  {
    $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
    return view('admin.product_transactions.details', [
      'productTransaction' => $productTransaction
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ProductTransaction $productTransaction)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ProductTransaction $productTransaction)
  {
    $productTransaction->update([
      "is_paid" => true
    ]);

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ProductTransaction $productTransaction)
  {
    //
  }
}
