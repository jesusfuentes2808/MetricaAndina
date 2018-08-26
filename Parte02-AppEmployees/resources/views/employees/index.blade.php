@extends('layout.template')

@section('title', 'Inicio')

@section('content')
    <div class="col-md-2"></div>
	<div class="col-md-8">
	<table class="table" id="tableEmployees">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>Salary</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($employees as $employee)
			<tr>
				<td>{{$employee['name']}}</td>
				<td>{{$employee['email']}}</td>
				<td>{{$employee['position']}}</td>
				<td>{{$employee['salary']}}</td>
				<td><a class="btn btn-info" href="{{route('employee.detalle',['id' => $employee['id']])}}"> Detalle </a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	<div class="col-md-2"></div>
@endsection

@section('script')
    $(window).load(function() {		
		$('#btnBuscador').on('click',function(e){
			e.preventDefault();
			var email = $('#inputBuscador').val();

			$.ajax({
			  method: "GET",
			  url: "{{ route('employee.buscador') }}",
			  data: { email: email }
			})
			.done(function( data ) {
				if(data.length==0){
					alert("No existen resultados con este criterio de búsqueda");
					return false;
				}

				var html = "<thead>"+
								"<tr>"+
									"<th>Name</th>"+
									"<th>Email</th>"+
									"<th>Position</th>"+
									"<th>Salary</th>"+
									"<th></th>"+
								"</tr>"+
							"</thead>"+
							"<tbody>";
				for(var i=0;i<data.length;i++){
					html+="<tr>";
						html+= "<td>"+data[i]['name']+"</td>";
						html+= "<td>"+data[i]['email']+"</td>";
						html+= "<td>"+data[i]['position']+"</td>";
						html+= "<td>"+data[i]['salary']+"</td>";
						html+= "<td><a class='btn btn-info' href='/detalle/"+data[i]['id']+"'> Detalle </a></td>";
					html+="</tr>";
				}
				html+="</tbody>";
				$("#tableEmployees").html(html);
			});
		});
	});
@endsection