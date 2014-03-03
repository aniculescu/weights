var weightsControllers = angular.module('weightsControllers', []);

weightsControllers.controller('WeightListCtrl', function ($scope, $http) {
    $scope.userId = 2;
    $scope.showUserWeights = function(){
    	var getString = '/weights/php/getWeights.php?user_id=' + $scope.userId;
	    $http.get(getString, {cache: true}).success(function(data){
	        $scope.weights = data;
	    });
    }
    $scope.showUserWeights();
});

// TODO: Create a filter for stripping spaces from strings; can be used for outputting IDs without spaces
// weightsControllers.filter('nospaces', function(text){
//     return text.replace(" ", "");
// });