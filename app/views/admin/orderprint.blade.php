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
        
        <div style="width:260px; text-align:center; font-size:9px; font-family:Verdana, Geneva, sans-serif">
        <h3>Cafe Ceylon</h3>
        ============================================<br>
        Matara Road Kabalana, <br>
        Ahangama, Sri Lanka.<br>
        09 12282729<br>
        E mail : sales@cafeceylon.lk <br>
        ============================================<br>
        Waiter: @{{order.agent}} | Table:@{{order.location}} | Pax:@{{order.location}}<br>
        ============================================<br>
        </div>
        <div style="width:260px; font-size:9px; font-family:Arial, Helvetica, sans-serif">
              <div style="font-size:11px; width:160px; float:left;">
                    Item
              </div>
              <div style="font-size:11px; width:50px; float:left;">
                     Qty		
			  </div>
              <div style="font-size:11px; width:50px; float:left;">
                     Amount 
              </div>
		</div>
        <div ng-repeat="orderitem in orderitems" style="width:260px; font-size:9px; font-family:Arial, Helvetica, sans-serif">
              <div style="font-size:11px; width:160px; float:left;">
                    @{{orderitem.item}} 		
              </div>
              <div style="font-size:11px; width:50px; float:left;">
                     @{{orderitem.qty}} 		
			  </div>
              <div style="font-size:11px; width:50px; float:left;">
                     @{{orderitem.price * orderitem.qty}} 
              </div>
		</div>
        
        <div style="width:215px;">
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
