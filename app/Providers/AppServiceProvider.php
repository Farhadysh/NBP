<?php

namespace App\Providers;

use App\Cart;
use App\Category;
use App\Checkout;
use App\Comment;
use App\Contact;
use App\DiscountCart;
use App\Order;
use App\Ticket;
use App\User;
use App\VisitCart;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		Schema::defaultStringLength( 191 );
		
		$this->app->bind( 'path.public', function () {
			return base_path( 'public_html' );
		} );
	}
	
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$categories = new Category();
		$categories = $categories->where( 'active', 1 )
			->with( [ 'children' => function ( $q ) {
				return $q->where( 'active', 1 );
			} ] )
			->where( 'parent_id', 0 )->get();
		
		$contact = new Contact();
		$contact = $contact->where( 'seen', 0 )->count();
		
		view()->composer( 'marketing.section.cart', function ( $view ) {
			
			if ( auth()->check() ) {
				$carts = Cart::where( 'user_id', auth()->user()->id )->get();
				
				$total_cart = 0;
				$total_weight = 0;
				
				foreach ( $carts as $cart ) {
					
					if ( auth()->check() && auth()->user()->hasPlan( $cart->product->categories()->first()->id ) ) {
						$total_cart += ($cart->product->discount - $cart->product->commission()) * $cart->qty;
					} else {
						$total_cart += $cart->product->discount * $cart->qty;
					}
					
					$total_weight += $cart->qty * $cart->product->limit_weight;
				}
			} else {
				$carts = '';
				$total_cart = '';
				$total_weight = '';
			}
			
			
			//...with this variable
			$view->with( [
				'carts' => $carts,
				'total_cart' => $total_cart,
				'total_weight' => $total_weight
			] );
		} );
		
		view()->composer( 'profile.section.sidebar', function ( $view ) use ( $categories ) {
			$user = auth()->user();
			$view->with( [
				'user' => $user
			] );
		} );
		
		$discountCount = new DiscountCart();
		$discountCount = $discountCount->where( 'seen', 0 )->where( 'status', 'success' )->count();
		
		$checkout = new Checkout();
		$checkout = $checkout->where( 'status', 'init' )->whereHas( 'user', function ( $q ) {
			$q->where( 'level', '<>', 'seller' );
		} )->count();
		
		
		$checkoutSeller = new Checkout();
		$checkoutSeller = $checkoutSeller->where( 'status', 'init' )->whereHas( 'user', function ( $q ) {
			$q->where( 'level', 'seller' );
		} )->count();
		
		$visitCart = new VisitCart();
		$visitCart = $visitCart->where( 'seen', 0 )->count();
		
		$newOrder = new Order();
		$newOrder = $newOrder->where( 'send_status', 'init' )->where( 'status', 'success' )->count();
		
		view()->composer( 'section.nav', function ( $view ) use ( $categories ) {
			$view->with( [
				'category_nav' => $categories
			] );
		} );
		
		view()->composer( 'marketing.section.*', function ( $view ) use ( $categories ) {
			if ( auth()->check() ) {
				$cart_count = Cart::where( 'user_id', auth()->user()->id )->count();
			} else {
				$cart_count = 0;
			}
			
			$view->with( [
				'category_nav' => $categories,
				'cart_count' => $cart_count
			] );
		} );
		
		view()->composer( 'admin.section.*', function ( $view ) use ( $checkoutSeller, $newOrder, $visitCart, $discountCount, $contact, $checkout ) {
			$view->with( [
				'contact' => $contact,
				'discountCount' => $discountCount,
				'ticketsCount' => Ticket::where( 'status', '<>', Ticket::STATUS_CLOSED )->count(),
				'visitCartCount' => $visitCart,
				'newOrder' => $newOrder,
				'checkout' => $checkout,
				'checkoutSeller' => $checkoutSeller,
				'commentsCount' => Comment::where( 'approved', null )->count(),
				'contactsCount' => Contact::where( 'seen', 0 )->count(),
			] );
		} );
		
		view()->composer( 'panel.section.*', function ( $view ) {
			$view->with( [
				'commentCount' => Comment::whereHas( 'product', function ( $q ) {
					$q->where( 'user_id', auth()->user()->id );
				} )->where( 'sellerView', 0 )->count(),
				
				'replyCount' => Ticket::where( 'user_id', auth()->user()->id )->whereHas( 'replies', function ( $q ) {
					$q->where( 'sellerView', 0 );
				} )->count()
			] );
		} );
	}
}
