<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset Notification</h2>

		<div>
			{{$givenname}} {{$surname}},
			<br><br>
			You have requsted to reset the login password for {{$username}} account in Cafe Ceylon System.
			Activate the new password by clicking bellow URL.
			<br><br>
			If you did not request to reset the password, Please ignore this email message.
			<br><br>
			Your new Password is:<br>
			<b>{{$password}}</b>
			<br><br>
			Activate the new password uby clicking fullowing link
			<br><br>
			{{$link}}
			<br><br>
			Thanks,
			Cafe Ceylon Administrator
		</div>
	</body>
</html>
