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
        
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif">
        <h3>Cafe Ceylon</h3>
        ==========================<br>
        Matara Road Kabalana, <br>
        Ahangama, Sri Lanka.<br>
        09 12282729<br>
        E mail : sales@cafeceylon.lk <br>
        ==========================<br>
        Waiter: umavcs | Table:2 | Pax:2<br>
        ==========================<br>
<br>
        </div>
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif">
            <table width="270" border="0">
              <tr>
                <td width="150" align="left">Item</td>
                <td width="40" align="center">Qty</td>
                <td width="60" align="right">Amount</td>
              </tr>
              <tr  ng-repeat="orderitem in orderitems">
                <td align="left">@{{orderitem.item}}</td>
                <td align="center">@{{orderitem.qty}}</td>
                <td align="right">@{{orderitem.price * orderitem.qty}}</td>
              </tr>
              
            </table>
        </div>
        
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif" >
            ==========================<br>
        </div>
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif" class="ng-binding">
            <table width="270" border="0">
              <tr>
                <td align="left">Gross Amount </td>
                <td align="right">@{{ getTotal() }}</td>
              </tr>
              <tr>
                <td align="left">Discounts</td>
                <td align="right">@{{ getTotal() }}</td>
              </tr>
              <tr>
                <td align="left">Net Amount </td>
                <td align="right">@{{ getTotal() + ((getTotal()/100)*20) - ((getTotal()/100)*discount)}}</td>
              </tr>
            </table>
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
