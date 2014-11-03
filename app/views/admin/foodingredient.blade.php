<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Header -->
	@include('admin.include.head')
    

</head>

<body>
	<?php 
		$username = Session::get('current_user');
		$user_access = Session::get('user_access');
		$user_id = Session::get('user_id');
	 ?>
    <div id="wrapper">

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

</body>

</html>
