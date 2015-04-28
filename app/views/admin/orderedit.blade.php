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
							 <a class="btn btn-danger" ng-click="deleteItem(orderitem.id)"><i class="fa fa-trash-o"></i></a> &nbsp; @{{orderitem.item}} &nbsp; <span class="label label-primary">Rs @{{orderitem.price}}</span>
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
						<div class="col-xs-12 col-md-8 text-right">
							 Total:
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							@{{ getTotal() }}

						</div>
					</div>
                    
                    <div >
						<div class="col-xs-12 col-md-8 text-right">
							 Discount:
						</div>
						<div class="col-xs-6 col-md-4 text-right">

							<select ng-model="discount" ng-change="change(order.id)" class="form-control">
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

							<strong>@{{ getTotal() - ((getTotal()/100)*discount)}}</strong>

						</div>
					</div>
                    

				</div>
			</div>
			<div>
				<a ng-href="/order/print/@{{order.id}}" class="btn btn-info">Print</a>
				<a ng-href="/invoice/new/@{{order.id}}" class="btn btn-info">add invoice</a>
                <div class="btn-group">
                  <button class="btn btn-primary" type="button">KOT</button>
                  <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a ng-href="/kot/full/@{{order.id}}">Full</a></li>
                    <li class="divider"></li>
                    <li><a href="/kot/updated/@{{order.id}}">Updated</a></li>
                    <li class="divider"></li>
                    <li><a href="/kot/print/@{{order.id}}">Previous</a></li>
                  </ul>
                </div>
                <div class="btn-group">
                  <button class="btn btn-primary" type="button">BOT</button>
                  <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul role="menu" class="dropdown-menu">
                    <li><a ng-href="/bot/full/@{{order.id}}">Full</a></li>
                    <li class="divider"></li>
                    <li><a href="/bot/updated/@{{order.id}}">Updated</a></li>
                    <li class="divider"></li>
                    <li><a href="/bot/print/@{{order.id}}">Previous</a></li>
                  </ul>
                </div>
            </div>
        </div>
		<div class="col-md-4">
        	<div style="text-align:center;"><br>
			Waiter : @{{order.agent}} &nbsp;|&nbsp;
	        Table: @{{order.location}} &nbsp;|&nbsp;
	        Pax: @{{order.pax}} <br>
	        @{{order.description}} <br>
            </div>
			<accordion close-others="true">
    
		    <accordion-group heading="@{{category.name}}" ng-repeat="category in categorys" ng-click="getFoodItem(category.id)">
				<div class="row">
					<div ng-repeat="item in items" class="col-xs-6 col-uma label label-primary" ng-click="addItem(item.id, order.id);" style="white-space: normal; min-height: 80px; margin: 5px; padding: 10px; cursor:pointer;"  >
						
						  @{{item.name | characters:40}}
						
					</div>
				</div>
		    </accordion-group>

		  	</accordion>

			</br>
			<!--<tabset>
				<tab ng-repeat="category in categorys"
					 heading="@{{category.name}}" select="getFoodItem(category.id)">
					<div >
					<div class="row">
					  <div ng-repeat="item in items" class="col-xs-6 col-md-3 label label-primary" ng-click="addItem(item.id, order.id);" style="white-space: normal; min-height: 60px; margin: 5px;
		padding: 10px; cursor:pointer;" >
						
						  @{{item.name}}
						
					  </div>
					  
					   
				</tab>
			</tabset>-->
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
