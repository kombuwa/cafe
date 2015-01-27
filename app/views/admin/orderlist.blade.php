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
	@include('admin.include.app.orderlist')
	
    <div id="wrapper" ng-controller="categoryController">

        <!-- Navigation -->
	@include('admin.include.nav')

	<!-- Content Top -->
	@include('admin.include.cont_top')
        

			<div class="row show-grid">
				<form ng-submit="addCategory()">
                                <div class="col-xs-12 col-md-8"><input class="form-control" type="text" ng-model="newCategoryName" required></div>
                                <div class="col-xs-6 col-md-4"><button class="btn btn-default" type="submit">Add Category</button>
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
                                            <th>#</th>
                                            <th>Tabel</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="order in orders | filter:search">
                                            <td>@{{order.created_at}}</td>
                                            <td>@{{order.location}}</td>
                                            <td>@{{order.description}}</td>
                                            <td><div align="right" >
                                            <span class="badge" ng-show="category.items" title="Items">@{{order.agent}}</span>
                                            <a class="btn btn-warning" ng-href="/order/edit/@{{order.id}}" ><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger" ng-click="deleteCategory(order.id)"><i class="fa fa-trash-o"></i></a>
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
