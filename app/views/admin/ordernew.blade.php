<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Header -->
	@include('admin.include.head')
        <script>
            //Call This At The Top Of Your Layout
            myApp = new AngularBooter('myApp'); // <-- What do you want to call your ng-app?
        </script>

</head>

<body ng-cloak ng-app="myApp">
	<?php 
		$username = Session::get('current_user');
		$user_access = Session::get('user_access');
		$user_id = Session::get('user_id');
	 ?>

     <!-- Angular -->
    @include('admin.include.app.foodstock')

    <div id="wrapper" ng-controller="stockController">

        <!-- Navigation -->
	@include('admin.include.nav')

	<!-- Content Top -->
	@include('admin.include.cont_top')
        
        <div class="row show-grid">
             <?php echo '<form role="form" method="post" action="'.URL::to('/order/new/').'">'; ?>
                <div class="col-xs-12 col-md-8">
                    <input class="form-control" placeholder="Location" required><br>
                    <input class="form-control" placeholder="Description" required><br>
                </div>
                <div class="col-xs-6 col-md-4" style="height:125px;"><button class="btn btn-default" type="submit">Place Order</button>
                    <i class="fa fa-spinner fa-spin" ng-show="isAdd"></i>
                </div>
            </form>
        </div>
                
    	<!-- Content bottom -->
	@include('admin.include.cont_bot')
    
    </div>
    <!-- /#wrapper -->

    
    <!-- Footer -->
	@include('admin.include.foot')
    <script>
    myApp.boot();
    </script>

</body>

</html>
