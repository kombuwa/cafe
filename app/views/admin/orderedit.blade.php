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
        
		<div class="row">
		<div class="col-xs-6">
			<div class="row show-grid">
				<div class="col-xs-12 col-md-8">

					<div ng-repeat="orderitem in orderitems">
						<div class="col-xs-12 col-md-8">
							 @{{orderitem.item}} <a class="btn btn-danger" ng-click="deleteItem(orderitem.id)"><i class="fa fa-trash-o"></i></a>
						</div>
						<div class="col-xs-6 col-md-4">
							<div class="input-group">
							  <span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number" ng-click="nItem(orderitem.id)" data-type="minus" data-field="quant[1]">
										<span class="glyphicon glyphicon-minus"></span>
									</button>
							  </span>
							  <input type="text" name="quant[1]" class="form-control input-number" ng-model="orderitem.qty" min="1" max="3" >
							  <span class="input-group-btn">
									<button type="button" class="btn btn-default btn-number" ng-click="pItem(orderitem.id)" data-type="plus" data-field="quant[1]">
										<span class="glyphicon glyphicon-plus"></span>
									</button>
							  </span>
							</div>

						</div>
					</div>

					<div >
						<div class="col-xs-12 col-md-8">
							 Total:
						</div>
						<div class="col-xs-6 col-md-4">

							@{{ getTotal() }}

						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-xs-6">
			<tabset>
				<tab ng-repeat="category in categorys"
					 heading="@{{category.name}}" select="getFoodItem(category.id)">
					<div >
						<div style="padding-top:10px;">
							<div ng-repeat="item in items" class="label label-primary" style="margin: 5px;
		padding: 10px; cursor:pointer;" ng-click="addItem(item.id, order.id);" >
								@{{item.name}}
							</div>
						</div>
					</div>     
				</tab>
			</tabset>
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
