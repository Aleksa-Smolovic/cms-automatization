<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
	public function c3Charts() {
		return view('chart.c3-charts');
	}
	
	public function chartistCharts() {
		return view('chart.chartist-charts');
	}
	
	public function chart() {
		return view('chart.chart');
	}
	
	public function morris() {
		return view('chart.morris');
	}
	
	public function sparkline() {
		return view('chart.sparkline');
	}

	public function guage() {
		return view('chart.guage');
	}
}
