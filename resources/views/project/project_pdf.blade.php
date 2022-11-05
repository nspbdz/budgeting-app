<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Project</title>
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
		<h5>Data Project</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th> Code</th>
				<th>Nama Inisiatif</th>
				<th>Nama Project</th>
				<th>Alokasi Anggaran</th>
				<!-- <th>Nilai FS</th> -->
           		<!-- <th>Nilai ADP</th> -->
			</tr>
		</thead>
		<tbody>

			@php $i=1 @endphp
			@foreach($project as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->projectcode}}</td>
				<td>{{$p->initiativename}}</td>
				<td>{{$p->projectname}}</td>
				<td>{{$p->budgetallocation}}</td>
				<td>{{$p->name}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>