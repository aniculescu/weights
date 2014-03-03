var weightsControllers = angular.module('weightsControllers', ['weightsServices']);

weightsControllers.controller('WeightListCtrl', function ($scope, Weights) {
    // $http.get('/weights/php/getWeights.php').success(function(data){
    //     $scope.weights = data;
    // });

    $scope.userId = 2;
    $scope.weights = Weights.query();
});

weightsApp.filter('nospaces', function(text){
    return text.replace(" ", "");
});