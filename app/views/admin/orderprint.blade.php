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
        
        
		<div class="row">
		<div class="col-md-8">
			<div class="row show-grid">
				<div class="col-xs-12 ">

					<div ng-repeat="orderitem in orderitems">
						<div class="col-xs-12 col-md-8" style="font-size:11px;">
							  &nbsp; @{{orderitem.item}} &nbsp; <span class="label label-primary">Rs @{{orderitem.price}}</span>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="input-group">
							  @{{orderitem.qty}}
							  
							  
							</div>

						</div>
					</div>

					<div >
						<div class="col-xs-12 col-md-8 text-right">
							 Total:
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							@{{ getTotal() }}

						</div>
					</div>
                    <div >
						<div class="col-xs-12 col-md-8 text-right">
							 Tax:
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							@{{ (getTotal()/100)*20 }}

						</div>
					</div>
                    <div >
						<div class="col-xs-12 col-md-8 text-right">
							 Discount:
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							<select ng-model="discount" >
							  <option value="0" selected="selected">None</option>
							  <option value="5">5 %</option>
							  <option value="10">10 %</option>
							  <option value="15">15 %</option>
							  <option value="20">20 %</option>
							</select> 

						</div>
					</div>
                    <div >
						<div class="col-xs-12 col-md-8 text-right">
							 <strong>To Pay:</strong>
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							<strong>@{{ getTotal() + ((getTotal()/100)*20) - ((getTotal()/100)*discount)}}</strong>

						</div>
					</div>
                    

				</div>
			</div>
			<div>
				<a ng-href="/order/print/@{{order.id}}" class="btn btn-info">Print</a>
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
