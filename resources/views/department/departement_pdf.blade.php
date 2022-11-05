<!DOCTYPE html>
<html>
<head>
	<title>Data Department</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
		th {
    background-color: blue;
    color: white;
} 
	</style>
	<center>
		<h5>Data Department</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Department Code</th>
				<th>Nama Department</th>
				<th>Department Head</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($department as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->departementcode}}</td>
				<td>{{$p->name}}</td>
				<td>{{$p->getDeptartmentHead->namadepan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>