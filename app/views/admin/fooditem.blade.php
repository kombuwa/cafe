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
	@include('admin.include.app.fooditem')
	
    <div id="wrapper" ng-controller="itemController">
    	
    	
    	<!-- edit Dialog -->
    	<script type="text/ng-template" id="editDialog.html">
        <div class="modal-header">
            <h3 class="modal-title">Edit Item!</h3>
        </div>
        <div class="modal-body">
            
            <b>Name:</b> <a href="#" editable-text="item.name">@{{item.name || 'no data'}}</a><br>
            <b>Category:</b> <a href="#" editable-select="item.fcid" onshow="loadCategory($data)" onaftersave="getCategory()" e-ng-options="category.id as category.name for category in categorys">@{{ categoryname  || 'no data'}}</a><br>
            <b>Provider:</b> <a href="#" editable-select="item.provider" e-ng-options="p.value as p.text for p in providers">@{{item.provider || 'no data'}}</a><br>
            <b>Description:</b> <a href="#" editable-textarea="item.description" e-rows="7" e-cols="40">@{{item.description||'no data'|characters:48}}</a><br>
            <b>Price:</b> <a href="#" editable-text="item.price">@{{item.price || 'no data'}}</a><br>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
	   </script>

       <!-- ing Dialog -->
       <script type="text/ng-template" id="ingDialog.html">
        <div class="modal-header">
            <h3 class="modal-title">Ingredients!</h3>
        </div>
        <div class="modal-body">
            
            <div class="row show-grid">
                <form ng-submit="addIngredient()">
                    <div class="col-xs-12 col-md-8">
                        <select class="form-control" ng-model="newIngredient" ng-options="ingredient.id as ingredient.name for ingredient in ingredients" >
                            <option value="">Choose Ingredient</option>
                        </select><br>
                        <div class="form-group input-group">
                            <span class="input-group-addon">@{{quantity}}</i>
                            </span>
                            <input type="number" placeholder="0.000" min="0.001" step="0.001" ng-model="newQty" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-4" style="height:125px;"><button class="btn btn-default" type="submit">Add Ingredient</button>
                        <i class="fa fa-spinner fa-spin" ng-show="isAdd"></i>
                    </div>
                </form>
            </div>

            <div class="panel panel-default">
                        <div class="panel-heading">
                            
                                <div class="row">
                
                                <div class="col-md-8">Food Category</div>
                                <div class="col-md-4"><input type="search" class="form-control input-sm" placeholder="Search" ng-model="search"></div>
                                
                                </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div>
                    
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="itemingredient in itemingredients | filter:search">
                                            <td>@{{itemingredient.ingredient}}</td>
                                            <td>@{{itemingredient.measurement}} : @{{itemingredient.qty}}</td>
                                            <td><div align="right" >
                                            <a class="btn btn-danger" ng-click="deleteIngredient(itemingredient.id)"><i class="fa fa-trash-o"></i></a>
                                            </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
       </script>

        <!-- Navigation -->
	@include('admin.include.nav')

	<!-- Content Top -->
	@include('admin.include.cont_top')
        
		<div class="panel panel-default">
		<div class="panel-body">
		<form ng-submit="addItem()">
			<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" ng-model="newItemName" required>
                                </div>
                                <div class="form-group">
                                    <label>Food Category</label>
                                    <select class="form-control" ng-model="newItemCategory" ng-options="category.id as category.name for category in categorys" >
                                        <option value="">Choose Category</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Provider</label>
                                    <select class="form-control" ng-model="newItemProvider">
                                    	<option value="">Choose Provider</option>
                                        <option value="kitchen">Kitchen</option>
                                        <option value="bar">Bar</option>
                                    </select>
                                </div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="3" class="form-control" ng-model="newItemDescription"></textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">LKR</i>
                                    </span>
                                    <input type="number" placeholder="0.00" min="0.01" step="0.01" ng-model="newItemPrice" class="form-control">
                                </div>
                                <button class="btn btn-default" type="submit">Add Category</button> <i class="fa fa-spinner fa-spin" ng-show="isAdd"></i>
			</div>
			</div>
		</form>	
		</div>
		</div>
		
		<div class="panel panel-default">
                        <div class="panel-heading">
                            
                            	<div class="row">
				
                                <div class="col-md-8">Food Item</div>
                                <div class="col-md-4"><input type="search" class="form-control input-sm" placeholder="Search" ng-model="search"></div>
                                
                        	</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            	<div>
					
				</div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Catagory</th>
                                            <th>Provider</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in items| filter:search">
                                            <td>@{{item.id}}</td>
                                            <td>@{{item.name}}</td>
                                            <td>@{{item.category}}</td>
                                            <td>@{{item.provider}}</td>
                                            <td>@{{item.description|characters:48}}</td>
                                            <td>@{{item.price}}</td>
                                            <td><div align="right" >
                                            <button class="btn btn-info" ng-click="addIng(item.id)"><i class="fa fa-puzzle-piece"></i></button>
                                            <button class="btn btn-warning" ng-click="edit(item.id)"><i class="fa fa-pencil-square-o"></i></button>
                                            <a class="btn btn-danger" ng-click="deleteItem(item.id)"><i class="fa fa-trash-o"></i></a>
                                            </div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
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
