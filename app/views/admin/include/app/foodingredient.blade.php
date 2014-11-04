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
	      
	      myApp.controllers.editController = function($scope, $modalInstance, $http, id) {
	      	
	      	$scope.providers = [
		    {value: 'kitchen', text: 'Kitchen'},
		    {value: 'bar', text: 'Bar'}
		  ];
		
		 
	        
	        $scope.loadCategory = function() {
			$http.get('/api/food/categorys').success(function(categorys){
	        		$scope.categorys = categorys;
	        	});
	  	};
	  	
	  	$scope.getCategory = function() {
	  		id = $scope.item.fcid;
	  		$http.get('/api/food/category/'+id+'/').success(function(category){
	        		$scope.categoryname = category.name;
	        		//return category.name;
	        	});
	      
	  	}
  
	      	$http.get('/api/food/item/'+id+'/').success(function(item){
	        	$scope.item = item;
	        	$scope.getCategory();
	        });
	        
	      	$scope.ok = function () {
	    		$modalInstance.close($scope.item);
	  	};
	  	
	  	$scope.cancel = function () {
    			$modalInstance.dismiss('cancel');
  		};
  		
	      }
	
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