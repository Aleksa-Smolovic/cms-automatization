<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index() {
		return view('dashboard.index');
	}

	public function finance() {
		return view('dashboard.finance');
	}

	public function sales() {
		return view('dashboard.sales');
	}

	public function products() {
		return view('dashboard.products');
	}

	public function productSingle() {
		return view('dashboard.product-single');
	}

	public function productCheckout() {
		return view('dashboard.product-checkout');
	}

	public function influencer() {
		return view('dashboard.influencer');
	}

	public function influencerFinder() {
		return view('dashboard.influencer-finder');
	}

	public function influencerProfile() {
		return view('dashboard.influencer-profile');
	}
}
