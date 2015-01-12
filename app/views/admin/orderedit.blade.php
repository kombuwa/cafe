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
                <div class="col-xs-6 col-md-4">
                	<div class="input-group">
			          <span class="input-group-btn">
			              	<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
			                  	<span class="glyphicon glyphicon-minus"></span>
			              	</button>
			          </span>
			          <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
			          <span class="input-group-btn">
			              	<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
			                  	<span class="glyphicon glyphicon-plus"></span>
			              	</button>
			          </span>
				    </div>
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
