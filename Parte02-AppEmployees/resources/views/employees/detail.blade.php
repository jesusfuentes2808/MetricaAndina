@extends('layout.template')

@section('title', 'Inicio')

@section('content')
    <div class="col-md-2"></div>
	<div class="col-md-8">
	<table class="table center-block" style="width: 50%">
		<thead>
			<tr>
				<th>Campo</th>
				<th>Valor</th>
				
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td>Nombre</td>
				<td>{{$filterEmployees[0]['name']}}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>{{$filterEmployees[0]['email']}}</td>
			</tr>
			<tr>
				<td>Teléfono</td>
				<td>{{$filterEmployees[0]['phone']}}</td>
			</tr>
			<tr>
				<td>Dirección</td>
				<td>{{$filterEmployees[0]['address']}}</td>
			</tr>
			<tr>
				<td>Posición</td>
				<td>{{$filterEmployees[0]['position']}}</td>
			</tr>
			<tr>
				<td>Salario</td>
				<td>{{$filterEmployees[0]['salary']}}</td>
			</tr>
			<tr>
				<td>Skills</td>
				<td>
					@foreach($filterEmployees[0]['skills'] as $filter)
						{{$filter['skill']}},
					@endforeach
				</td>
			</tr>
			
		</tbody>
	</table>
	</div>
	<div class="col-md-2"></div>
@endsection

@section('script')
   
@endsection