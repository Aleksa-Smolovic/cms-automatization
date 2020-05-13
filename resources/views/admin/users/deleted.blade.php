@extends('layouts.index')

@section('css')
@endsection

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Korisnici</h2>			
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Korisnici</h5>
					<div class="card-body">
						<div class="table-responsive">
							@if($users->count() > 0)
								<table class="table table-striped table-bordered first">
									<thead>
										<tr>
											<th class="text-center">ID</th>
											<th class="text-center">Ime i prezime</th>
											<th class="text-center">Email</th>
											<th class="text-center">Korisnička uloga</th>
											<th class="text-center">Povrati</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
											<tr>
												<td class="text-center">{{ $user->id }}</td>
												<td class="text-center">{{ $user->full_name }}</td>
												<td class="text-center">{{ $user->email }}</td>
												<td class="text-center">
													<span class="badge badge-pill
														@if($user->role->id == 1)
															{{ 'badge-success' }}
														@elseif($user->role->id == 2)
															{{ 'badge-warning' }}
														@else
															{{ 'badge-info' }}
														@endif">
														{{ $user->role->name }}
													</span>
												</td>
												<td class="text-center">
													<form action="{{ route('users/restore', $user->id) }}" method="POST">
														@csrf
														@method('PUT')
														<button class="btn btn-sm btn-info" type="submit">Povrati</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								<a class="btn btn-sm btn-warning" href="{{ route('users') }}"> Korisnici</a href="{{ route('users') }}">
							@else
								<h2>Nema obrisanih korisnika, <a class="text-primary" href="{{ route('users') }}">idi nazad.</a></h2>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection