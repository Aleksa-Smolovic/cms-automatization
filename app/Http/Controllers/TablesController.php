<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
	public function dataTables() {
		return view('tables.data-tables');
	}

	public function generalTables() {
		return view('tables.general-tables');
	}
}
