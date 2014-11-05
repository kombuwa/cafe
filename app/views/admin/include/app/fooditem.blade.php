 	<script>
	      myApp.controllers.itemController = function($scope, $modal, $http, $log) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Food Item!';
	        /*$scope.items = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/items').success(function(items){
	        	$scope.items = items;
	        });
	        
	        $http.get('/api/food/categorys').success(function(categorys){
	        	$scope.categorys = categorys;
	        });
	        
	        
	        $scope.addItem = function() {
	        	var item = {
	        		fcid : $scope.newItemCategory,
	        		name : $scope.newItemName,
	        		provider : $scope.newItemProvider,
	        		description : $scope.newItemDescription,
	        		price : $scope.newItemPrice
	        		
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/item', item).success(function(){
		        	$http.get('/api/food/items').success(function(items){
			        	$scope.items = items;
			        	$scope.newItemCategory = "";
			        	$scope.newItemName = "";
			        	$scope.newItemProvider = "";
			        	$scope.newItemDescription = "";
			        	$scope.newItemPrice = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	       
	        $scope.deleteItem = function(id) {

	        	$http.delete('/api/food/item/'+id+'/').success(function(){
		        	$http.get('/api/food/items').success(function(items){
			        	$scope.items = items ;
			        	$scope.isAdd = 0;
			        });
		        });
	        };
	        
	        $scope.edit = function(id) {
			var modalInstance = $modal.open({
				templateUrl: 'editDialog.html',
				controller: 'editController',
				size: 'lg',
				resolve: {
					id: function () {
				          return id;
				        }
				}
			});
			modalInstance.result.then(function (selectedItem) {
				$scope.selected = selectedItem;
				$http.put('/api/food/item/'+id+'/', selectedItem).success(function(){
			        	$http.get('/api/food/items').success(function(items){
				        	$scope.items = items;
				        });
			        });
			}, function () {
				$log.info('Modal dismissed at: ' + new Date());
			});
	        };

	        $scope.addIng = function(id) {
			var modalInstance = $modal.open({
				templateUrl: 'ingDialog.html',
				controller: 'ingController',
				size: 'lg',
				resolve: {
					id: function () {
				          return id;
				        }
				}
			});
			modalInstance.result.then(function (selectedItem) {
				$scope.selected = selectedItem;
				$http.put('/api/food/item/'+id+'/', selectedItem).success(function(){
			        	$http.get('/api/food/items').success(function(items){
				        	$scope.items = items;
				        });
			        });
			}, function () {
				$log.info('Modal dismissed at: ' + new Date());
			});
	        };
	        
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

	       myApp.controllers.ingController = function($scope, $modalInstance, $http, id) {
	       	
	       	$http.get('/api/food/ingredients').success(function(ingredients){
	        	$scope.ingredients = ingredients;
	        });

	        $http.get('/api/food/item_ingredients/'+id+'/').success(function(itemingredients){
	        	$scope.itemingredients = itemingredients;
	        });

	        $scope.addIngredient = function() {
	        	var ingredient = {
	        		inid : $scope.newIngredient,
	        		fiid : id
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/food/item_ingredient', ingredient).success(function(){
		        	$http.get('/api/food/item_ingredients/'+id+'/').success(function(itemingredients){
			        	$scope.itemingredients = itemingredients;
			        	$scope.newIngredient = "";
			        	$scope.isAdd = 0;
			        });
		        });
	        };

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