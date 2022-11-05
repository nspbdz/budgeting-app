<?php
// dd($dataDept);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Asset</title>
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
		<h5>Data Asset</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>code Projek</th>
				<th>Nama Projek</th>
				<th>No Kontrak </th>
				<th>Nilai Kontrak </th>
				<th>Master Asset</th>
			</tr>
		</thead>
		<tbody>

			@php $i=1 @endphp
			@foreach($Asset as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->code}}</td>
				<td>{{$p->projectname}}</td>
				<td>{{$p->contractnumber}}</td>
				<td>{{$p->contractvalue}}</td>
				<td>{{$p->masterasset}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>