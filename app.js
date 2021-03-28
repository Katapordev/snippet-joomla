angular.module("Admin", []);
angular.module('Admin').controller('Dashboard', function($scope, $http ,$window) {
$scope.CreateMenu = function(dulieu)
{
	 $http.post("index.php?option=com_kata&task=Kata.CreateMenu&format=raw",{'dulieu':dulieu})  
    .then(function(data) { 
  		console.log(data);
				$.notify(data.data, {type:"success"});	
				location.reload(500);
    });
}	
$scope.CreateTable = function(dulieu)
{
	 $http.post("index.php?option=com_kata&task=Kata.CreateTable&format=raw",{'dulieu':dulieu})  
    .then(function(data) { 
  		console.log(data);
    });
}
$scope.DeleteMenu = function(dulieu)
{
 $http.post("index.php?option=com_kata&task=Kata.DeleteMenu&format=raw",{'dulieu':dulieu})  
    .then(function(data) { 
  		console.log(data);
 					$.notify(data.data, {type:"success"});
						location.reload(500);
    });
	
}
});