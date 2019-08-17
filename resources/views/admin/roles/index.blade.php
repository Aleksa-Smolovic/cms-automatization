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
<div class="container-fluid">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Roles </h2>
					<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Roles</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				@include('partials.error', ['name' => 'aborted'])
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Roles Table</h5>
					<div class="card-body">
						<div class="table-responsive">
							<a class="btn btn-sm btn-info float-right ml-3" href="{{ route('roles.create') }}">
								Add New Role
							</a>
							<table class="table table-striped table-bordered first">
								<thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">Role</th>
										<th class="text-center">Users</th>
										<th class="text-center">Edit</th>
										<th class="text-center">Delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach($roles as $role)
										<tr>
											<td class="text-center">{{ $role->id }}</td>
											<td class="text-center">{{ $role->name }}</td>
											<td class="text-center">
												@foreach($role->users as $user)
													<a href="{{ route('users.edit', $user->id) }}">
														{{ $user->username }}
													</a>
													<span class="text-danger">|</span>
												@endforeach
												{{-- {!! $role->users->implode('username', '<span class="text-danger"> | </span>') !!} --}}
											</td>
											<td>
												<a class="btn btn-sm btn-info" href="{{ route('roles.edit', $role->id) }}">Edit</a>
											</td>
											<td class="text-center">
												<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
													@method('DELETE')
													@csrf

													<button class="btn btn-danger btn-sm" type="submit">Delete</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<a class="btn btn-sm btn-warning" href="{{ route('roles.deleted') }}">Deleted Roles</a href="{{ route('roles.deleted') }}">
					</div>
				</div>
			</div>
		</div>
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