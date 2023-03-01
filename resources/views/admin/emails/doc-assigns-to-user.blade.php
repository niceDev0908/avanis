<!DOCTYPE html>
<html>
	<head>
		<title>{{config('app.name')}}</title>
	</head>
	<body>

		<h5>Hey, {{$first_name}} {{$last_name}}</h5>

		<p>Documents are assigned to you by "Site Admin"</p>
		
		<p>Click below button to view details.</p>

		<a href="{{$data['body']}}" class="btn btn-primary">Click Here</a>
	</body>
</html>