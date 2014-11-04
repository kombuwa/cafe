 	<script>
	      myApp.controllers.ingredientController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Category!';
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/ingredients').success(function(ingredients){
	        	$scope.ingredients = ingredients;
	        });

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