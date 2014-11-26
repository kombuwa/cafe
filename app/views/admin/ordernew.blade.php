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
        
                    <div class="panel panel-default">
		<div class="panel-body">
		<form ng-submit="addStock()">
			<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
                    <label>Food Ingredient</label>
                    <select class="form-control" ng-model="newStockIngredient" ng-options="ingredient.id as ingredient.name for ingredient in ingredients" ng-change="selectingredient()">
                        <option value="">Choose Ingredient</option>
                    </select>
                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" ng-model="newStockType">
                                    	<option value="">Choose Type</option>
                                        <option value="in">In</option>
                                        <option value="out">Out</option>
                                    </select>
                                </div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
                    <label>Cause</label>
                    <textarea rows="3" class="form-control" ng-model="newStockCause"></textarea>
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">@{{quantity}}</i>
                    </span>
                    <input type="number" placeholder="0.000" min="0.001" step="0.001" ng-model="newQty" class="form-control">
                </div>
                <button class="btn btn-default" type="submit">Add to Stock</button> <i class="fa fa-spinner fa-spin" ng-show="isAdd"></i>
			</div>
			</div>
		</form>	
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
