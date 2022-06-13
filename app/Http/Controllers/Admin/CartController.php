<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\PackageList;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
	public function store( Request $request )
	{
		$request->validate( [
			'product_id' => 'required|exists:products,id'
		] );
		
		$id = $request->product_id;
		
		$user = auth()->user();
		$user_id = $user->id;
		
		$product = Product::where( 'id', $id )->first();
		
		if ( $product ) {
			if ( auth()->user()->carts()->count() ) {
				$lastProduct = auth()->user()->carts->first()->product;

//                if ($lastProduct->sendDay == Product::sendDay_AMADE && $product->sendDay == Product::sendDay_AMADE) {
				if ( !auth()->user()->carts()->where( 'product_id', $id )->exists() ) {
					Cart::create( [
						'user_id' => $user_id,
						'product_id' => $id,
						'qty' => 1,
					] );
					
					alert()->success( "با موفقیت به سبد خرید اضافه گردید." );
				}
//                }
			} else {
				Cart::create( [
					'user_id' => $user_id,
					'product_id' => $id,
					'qty' => 1,
				] );
				
				alert()->success( "با موفقیت به سبد خرید اضافه گردید." );
			}
		}
		return redirect()->back();
	}
	
	public function count( $cart_id, $count )
	{
		Cart::where( 'id', $cart_id )->update( [
			'qty' => $count
		] );
		
		$carts = Cart::where( 'user_id', auth()->user()->id )->get();
		
		$total_cart = 0;
		$total_weight = 0;
		foreach ( $carts as $cart ) {
			if ( auth()->check() && auth()->user()->hasPlan( $cart->product->categories()->first()->id ) )
				$total_cart += ( $cart->product->discount - $cart->product->commission() ) * $cart->qty;
			else
				$total_cart += $cart->product->discount * $cart->qty;
			
			$total_weight += $cart->qty * $cart->product->limit_weight;
		}
		
		$cart = new Cart();
		$cart = $cart->where( 'id', $cart_id )->with( 'product' )->first();
		$cart->product->commission = 0;
		if ( auth()->check() && auth()->user()->hasPlan( $cart->product->categories()->first()->id ) )
			$cart->product->commission = $cart->product->commission();
		
		return compact( 'cart', 'total_cart', 'total_weight' );
	}
	
	public function destroy( $delete_id )
	{
		$Cart_destroy = new Cart();
		$Cart_destroy = $Cart_destroy->where( 'id', $delete_id )->first();
		$Cart_destroy->delete();
		
		$user_id = auth()->user()->id;
		$cart = new Cart();
		$cart = $cart->where( 'user_id', $user_id )->get();
		
		$total_cart = 0;
		$total_weight = 0;
		foreach ( $cart as $total ) {
			if ( auth()->check() && auth()->user()->hasPlan( $total->product->categories()->first()->id ) )
				$total_cart += ( $total->product->discount - $total->product->commission() ) * $total->qty;
			else
				$total_cart += $total->product->discount * $total->qty;
			
			$total_weight += $total->qty * $total->product->limit_weight;
		}
		
		return compact( 'cart', 'total_cart', 'total_weight' );
	}
}
