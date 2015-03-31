 	<script>
	      myApp.controllers.stockController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Stock!';
	        $scope.quantity = 'quantity';
	        $scope.class = "back";
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/ingredients').success(function(ingredients){
	        	$scope.ingredients = ingredients;
	        });
	        
	        $http.get('/api/food/stock').success(function(stocks){
	        	$scope.stocks = stocks;
	        });
	        
	        $scope.addStock = function() {
	        	var stock = {
	        		inid : $scope.newStockIngredient,
	        		name : $scope.newStockName,
	        		type : $scope.newStockType,
	        		cause : $scope.newStockCause,
	        		qty : $scope.newQty,
	        		isauto : 'no',
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/stock', stock).success(function(){
		        	$http.get('/api/food/stock').success(function(stocks){
			        	$scope.stocks = stocks;
			        	$scope.newStockName = "";
			        	$scope.newStockCause = "";
			        	$scope.newStockQuantity = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	       
	        $scope.deleteStock = function(id) {

	        	$http.delete('/api/food/stock/'+id+'/').success(function(){
		        	$http.get('/api/food/stock').success(function(stocks){
			        	$scope.stocks = stocks;
			        	$scope.newStockName = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };


	        $scope.selectingredient = function () {
				if($scope.newStockIngredient!=null){
					//$scope.quantity = $scope.newIngredient.measurement;
					$http.get('/api/food/ingredient/'+$scope.newStockIngredient+'/').success(function(ingredient){
			        	$scope.quantity = ingredient.measurement;
			        });
				}else{
					$scope.quantity = 'Quantity';
				}
			}

			$scope.changeClass = function(){
				//$scope.class = "";
	           	if($scope.class == "back"){
	           		$scope.class = "flipped";
	           	}else{
	           		$scope.class = "back";
	           	}
	        	

	        };
	        
	      };
	
	      myApp.config.push([function() {
	        //Do Awesome Config Stuff As Usual
	      }]);
	
	      //Add A Dependency
	      myApp.dependencies.push('ngResource');
	      myApp.dependencies.push('truncate');
	      myApp.dependencies.push('xeditable');
	      myApp.dependencies.push('ui.bootstrap');
	
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