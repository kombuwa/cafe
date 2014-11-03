	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>{{ $title }}</title>
	
	<!-- Bootstrap Core CSS -->
	{{ HTML::style('css/bootstrap.min.css'); }}
	
	<!-- MetisMenu CSS -->
	{{ HTML::style('css/plugins/metisMenu/metisMenu.min.css'); }}
	
	<!-- Custom CSS -->
	{{ HTML::style('css/sb-admin-2.css'); }}
	{{ HTML::style('css/xeditable.css'); }}
	
	<!-- Custom Fonts -->
	{{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css'); }}
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.15/angular.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.15/angular-resource.js"></script>
	{{ HTML::script('js/truncate.js') }}
	{{ HTML::script('js/angularBooter.js') }}
	{{ HTML::script('js/xeditable.min.js') }}
	{{ HTML::script('js/ui-bootstrap-tpls-0.11.2.min.js') }}