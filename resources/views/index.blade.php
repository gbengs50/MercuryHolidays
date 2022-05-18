<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>Hotel Room</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
	<div class="container mt-2">
	<div class="row">
	<div class="col-lg-12 margin-tb">
	<div class="pull-left">
		<h2>Hotel Rooms</h2>
	</div>
	<div class="pull-right mb-2">
	<a class="btn btn-success" href="{{ route('hotel.create') }}"> Create Hotel Room</a>
	</div>


	<div class="pull-right">
		<h5>Search</h5>
	</div>
	<div class="pull-left mb-2">
	<form action="{{ route('search') }}" method="GET">
	    <input type="text" name="min" placeholder="MIN BUDGET" required/>
	    <input type="text" name="max" placeholder="MAX BUDGET" required/>
	    <button type="submit">Search</button>
	</form>
	</div>


	</div>
	</div>
	@if ($message = Session::get('success'))
	<div class="alert alert-success">
	<p>{{ $message }}</p>
	</div>
	@endif
	<table class="table table-bordered">
	<tr>
	<th>S.No</th>
	<th>Name</th>
	<th>Available</th>
	<th>Floor</th>
	<th>Room Number</th>
	<th>Per Room Price (£)</th>
	<th width="280px">Action</th>
	</tr>
	@foreach ($hotels as $hotel)
	<tr>
	<td>{{ $hotel->id }}</td>
	<td>{{ $hotel->name }}</td>
	<td>{{ $hotel->available }}</td>
	<td>{{ $hotel->floor }}</td>
	<td>{{ $hotel->room_no }}</td>
	<td>{{ $hotel->per_room_price }}</td>
	<td>
	<form action="{{ route('hotel.destroy',$hotel->id) }}" method="Post">
	<a class="btn btn-primary" href="{{ route('hotel.edit',$hotel->id) }}">Edit</a>
	@csrf
	@method('DELETE')
	<button type="submit" class="btn btn-danger">Delete</button>
	</form>
	</td>
	</tr>
	@endforeach
	</table>
	{!! $hotels->links() !!}
</body>
</html>