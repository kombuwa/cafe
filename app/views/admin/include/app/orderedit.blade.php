 	<script>
	      myApp.controllers.orderController = function($scope, $http) {
	        //Do Awesome Controller Stuff As Usual
	        $scope.message = 'Order Edit!';
	        /*$scope.categorys = [
	        	{ id:1, name :"Soup" },
	        	{ id:2, name :"Juice" },
	        ];*/
	        
	        $http.get('/api/food/categorys').success(function(categorys){
	        	$scope.categorys = categorys;
	        });

	        $http.get('/api/order/details/'+searchId+'').success(function(order){
	        	$scope.order = order;
	        });
	        $http.get('/api/order/items/'+searchId+'').success(function(items){
	        	$scope.orderitems = items;
	        	$scope.isAdd = 0;
	        });
	        
	        $scope.getFoodItem = function(id) {

	        	$http.get('/api/food/itemsbycategory/'+id+'').success(function(items){
		        	$scope.items = items;
		        });
	        };
	        
	        $scope.addItem = function(fiid, orid) {
	        	/*var item = {
	        		fiid : fiid,
	        		orid : orid,
	        		qty : 1,
	        	};
	        	$scope.isAdd = 1;
	        	//$scope.categorys.push(category );
	        	$http.post('/api/order/Item/', item).success(function(){
		        	$http.get('/api/order/items/'+orid+'').success(function(items){
			        	$scope.items = items;
			        	$scope.isAdd = 0;
			        });
		        });*/
 				$http.post('http://system.cafeceylon.lk/api/order/Item?fiid='+fiid+'&orid=2&qty=1').success(function(){
		        	$http.get('/api/order/items/'+orid+'').success(function(items){
			        	$scope.items = items;
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