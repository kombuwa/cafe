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
    @include('admin.include.app.foodingredient')

    <div id="wrapper" ng-controller="ingredientController">

        <!-- Dialog -->
        <script type="text/ng-template" id="editDialog.html">
        <div class="modal-header">
            <h3 class="modal-title">Edit Ingredient!</h3>
        </div>
        <div class="modal-body">
            
            <b>Name:</b> <a href="#" editable-text="ingredient.name">@{{ingredient.name || 'no data'}}</a><br>
            <b>Provider:</b> <a href="#" editable-select="ingredient.measurement" e-ng-options="m.value as m.text for m in measurement">@{{ingredient.measurement || 'no data'}}</a><br>
            <b>Description:</b> <a href="#" editable-textarea="ingredient.description" e-rows="7" e-cols="40">@{{ingredient.description||'no data'|characters:48}}</a><br>
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
		<form ng-submit="addIngredient()">
			<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" ng-model="newIngredientName" required>
                                </div>
                                <div class="form-group">
                                    <label>Measurement</label>
                                    <select class="form-control" ng-model="newIngredientMeasurement">
                                    	<option value="">Choose Measurement</option>
                                        <option value="Litre">Litre</option>
                                        <option value="Gram">Gram</option>
                                    </select>
                                </div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
                    <label>Description</label>
                    <textarea rows="3" class="form-control" ng-model="newIngredientDescription"></textarea>
                </div>
                <button class="btn btn-default" type="submit">Add Ingredient</button> <i class="fa fa-spinner fa-spin" ng-show="isAdd"></i>
			</div>
			</div>
		</form>	
		</div>
		</div>
		
		<div class="panel panel-default">
                        <div class="panel-heading">
                            
                            	<div class="row">
				
                                <div class="col-md-8">Food Ingredient</div>
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
                                            <th>Description</th>
                                            <th>Measurement</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="ingredient in ingredients| filter:search">
                                            <td>@{{ingredient.id}}</td>
                                            <td>@{{ingredient.name}}</td>
                                            <td>@{{ingredient.description|characters:48}}</td>
                                            <td>@{{ingredient.measurement}}</td>
                                            <td><div align="right" >
                                            <button class="btn btn-warning" ng-click="edit(ingredient.id)"><i class="fa fa-pencil-square-o"></i></button>
                                            <a class="btn btn-danger" ng-click="deleteIngredient(ingredient.id)"><i class="fa fa-trash-o"></i></a>
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
