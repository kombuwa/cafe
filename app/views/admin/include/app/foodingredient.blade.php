 	<script>
	      myApp.controllers.ingredientController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Ingredient!';
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/ingredients').success(function(ingredients){
	        	$scope.ingredients = ingredients;
	        });
	        
	        $scope.addIngredient = function() {
	        	var ingredient = {
	        		name : $scope.newIngredientName,
	        		provider : $scope.newIngredientMeasurement,
	        		description : $scope.newIngredientDescription,
	        		
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/ingredient', ingredient).success(function(){
		        	$http.get('/api/food/ingredients').success(function(ingredients){
			        	$scope.ingredients = ingredients;
			        	$scope.newIngredientName = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	       
	        $scope.deleteIngredient = function(id) {

	        	$http.delete('/api/food/ingredient/'+id+'/').success(function(){
		        	$http.get('/api/food/ingredients').success(function(ingredients){
			        	$scope.ingredients = ingredients;
			        	$scope.newIngredientName = "";
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