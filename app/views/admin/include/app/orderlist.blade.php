 	<script>
	      myApp.controllers.categoryController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Category!';
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('api/orders/').success(function(orders){
	        	$scope.orders = orders;
	        });
	        
	        $scope.addCategory = function() {
	        	var category = {
	        		name : $scope.newCategoryName
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/category', category).success(function(){
		        	$http.get('/api/food/categorys').success(function(categorys){
			        	$scope.categorys = categorys;
			        	$scope.newCategoryName = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	       
	        $scope.deleteCategory = function(id) {

	        	$http.delete('/api/food/category/'+id+'/').success(function(){
		        	$http.get('/api/food/categorys').success(function(categorys){
			        	$scope.categorys = categorys;
			        	$scope.newCategoryName = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	        
	      };
	
	      myApp.config.push([function() {
	        //Do Awesome Config Stuff As Usual
	      }]);
	
	      //Add A Dependency
	      myApp.dependencies.push('ngResource');
	
	      myApp.directives.myDirective = [function() {
	        return function(scope, element, attrs){
	          //Do Awesome Directive Stuff As Usual
	        };
	      }];
	
	      myApp.filters.myFilter = [(function(){
	        return function(input, attribute) {
	          //Do Awesome Filter Stuff As Usual
	        };
	      })];
	
	      myApp.services.myService = [function () {
	        return function() {
	          //Do Awesome Service Stuff As Usual
	        };
	      }];
	
	      //Call This At The Bottom Of Your Layout
	      //myApp.boot();
	</script>