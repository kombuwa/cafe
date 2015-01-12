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
    @include('admin.include.app.orderedit')

    <div id="wrapper" ng-controller="orderController">

        <!-- Navigation -->
	@include('admin.include.nav')

	<!-- Content Top -->
	@include('admin.include.cont_top')
        <script type="text/javascript">
            var searchId = {{ $searchId }};
        </script>
        Agent: @{{order.agent}} <br>
        Tabel: @{{order.location}} <br>
        @{{order.description}} <br>
        <tabset>
            <tab ng-repeat="category in categorys"
                 heading="@{{category.name}}" select="getFoodItem(category.id)">
                <div >
                    <div>
                        <div ng-repeat="item in items">
                            @{{item.name}}
                        </div>
                    </div>
                </div>     
            </tab>
        </tabset>
        <div class="row show-grid">
            <div class="col-xs-12 col-md-8">
                <div class="col-xs-12 col-md-8">
                    French Onion Soup 
                </div>
                <div class="col-xs-6 col-md-4" style="height:125px;"><button class="btn btn-default" type="submit">+</button><input class="form-control" placeholder="Location" id="location" name="location" type="text" required><button class="btn btn-default" type="submit">-</button>
                </div>
            </div>
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
