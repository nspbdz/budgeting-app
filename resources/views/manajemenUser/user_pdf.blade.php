<!DOCTYPE html>
<html>
<head>
	<title>Data User</title>
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
		<h5>Data User</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Nama Depan</th>
				<th>Nama Belakang</th>
				<th>Jabatan</th>
				<th>NIP</th>
				<th>Role</th>
				<!-- <th>Dept.Head</th> -->
				<th>Team Leader</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			
			@foreach($dataRole as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->username}}</td>
				<td>{{$p->namadepan}}</td>
				<td>{{$p->namabelakang}}</td>
				<td>{{$p->jabatan}}</td>
				<td>{{$p->nip}}</td>
				<td>{{$p->nip}}</td>
				<!-- <td>{{$p->getAccess->getRole->name}}</td> -->
				<!-- <td>{{$p->teamlead}}</td> -->
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>