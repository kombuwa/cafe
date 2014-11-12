 	<script>
	      myApp.controllers.stockController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Stock!';
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/stocks').success(function(stocks){
	        	$scope.stocks = stocks;
	        });
	        
	        $scope.addStock = function() {
	        	var stock = {
	        		name : $scope.newStockName
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/stock', stock).success(function(){
		        	$http.get('/api/food/stocks').success(function(stocks){
			        	$scope.stocks = stocks;
			        	$scope.newStockName = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	       
	        $scope.deleteStock = function(id) {

	        	$http.delete('/api/food/stock/'+id+'/').success(function(){
		        	$http.get('/api/food/stocks').success(function(stocks){
			        	$scope.stocks = stocks;
			        	$scope.newStockName = "";
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