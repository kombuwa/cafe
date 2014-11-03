<!DOCTYPE html>
<html lang="en">

<head>

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

    <!-- Custom Fonts -->
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css'); }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
    <!-- Flash Message start -->
         @if($errors->any())
           <div class="alert alert-danger alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <ul>
                 {{ implode('', $errors->all('<li>:message</li>')) }}
                 </ul>
            </div>
        @endif
        @if(Session::has('success'))
           <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <ul>
                 {{ Session::get('success') }}
                 </ul>
            </div>
        @endif
         @if(Session::has('danger'))
           <div class="alert alert-danger alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <ul>
                 {{ Session::get('danger') }}
                 </ul>
            </div>
        @endif
    <!-- Flash Message end-->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register for an account</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo '<form role="form" method="post" action="'.URL::to('signup').'">'; ?>
                            <fieldset>
								<div class="form-group">
                                    <input class="form-control" placeholder="First Name" id="givenname" name="givenname" type="text" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Last Name" id="surname" name="surname" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="username" name="username" type="text" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Email Address" id="email" name="email" type="email"  required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Retype Password" id="password_confirmation" name="password_confirmation" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Sign up</button><br>
                            </fieldset>
                            <center>{{ HTML::link('login','Have an account?')}}</center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
