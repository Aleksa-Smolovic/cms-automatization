@extends('layouts.index')

@section('css')

@endsection

@section('content')
<div class="container-fluid ">
	<div class="dashboard-content">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Obrisani objekti </h2>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
				@include('partials.success')

				<div class="card">
					<h5 class="card-header">Objekti</h5>
					<div class="card-body">
						<div class="table-responsive">
							@if($objects->count() > 0)
								<table class="table table-striped table-bordered first">
									<thead>
										<tr>
										<th class="text-center">Redni broj</th>
										<!-- Marker Table Heading -->
										<th class="text-center">Povrati</th>
										</tr>
									</thead>
									<tbody>
									@foreach($objects as $object)
										<tr>
											<td class="text-center">{{ $object->id }}</td>
											<!-- Marker Table Content -->
											<td class="text-center">
												<form action="{{ route('tableNameMarker/restore', $object->id) }}" method="POST">
													@method('PUT')
													@csrf
													<button class="btn btn-sm btn-info" type="submit">Povrati</button>
												</form>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
								<a class="btn btn-sm btn-warning" href="{{ route('admin/tableNameMarker') }}"> Objekti</a href="{{ route('admin/tableNameMarker') }}">
							@else
								<h2>Nema obrisanih objekata, <a class="text-primary" href="{{ route('admin/tableNameMarker') }}">idi nazad</a></h2>
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