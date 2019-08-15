@extends('layouts.index')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

@section('content')
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header" id="top">
				<h2 class="pageheader-title">All Users </h2>
				<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Admin</a></li>
							<li class="breadcrumb-item active" aria-current="page">All Users</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<!-- ============================================================== -->
		<!-- basic table  -->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			
			@include('partials.success')

			<div class="card">
				<h5 class="card-header">Users Table</h5>
				<div class="card-body">
					<div class="table-responsive">
						<a class="btn btn-sm btn-info float-right ml-3" href="{{ route('users.create') }}">
							Add New User
						</a>
						<table class="table table-striped table-bordered first">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">First Name</th>
									<th class="text-center">Last Name</th>
									<th class="text-center">Username</th>
									<th class="text-center">Email</th>
									<th class="text-center">Role</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									<tr>
										<td class="text-center">{{ $user->id }}</td>
										<td class="text-center">{{ $user->first_name }}</td>
										<td class="text-center">{{ $user->last_name }}</td>
										<td class="text-center">{{ $user->username }}</td>
										<td class="text-center">{{ $user->email }}</td>
										<td class="text-center">
											<span class="badge badge-pill {{ $user->role->id == 1 ? 'badge-success' : 'badge-warning' }}">
												{{ $user->role->name }}
											</span>
										</td>
										<td class="text-center">
											<a class="btn btn-sm btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
										</td>
										<td class="text-center">
											<form action="{{ route('users.destroy', $user->id) }}" method="POST">
												@method('DELETE')
												@csrf
												<button class="btn btn-sm btn-danger" type="submit">Delete</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- end basic table  -->
		<!-- ============================================================== -->
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js') }}"></script>
@endsection
