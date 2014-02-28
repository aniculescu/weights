var weightsApp = angular.module('weightsApp', []);

weightsApp.controller('WeightListCtrl', function ($scope, $http) {
    $http.get('/weights/php/getWeights.php').success(function(data){
        $scope.weights = data;
        console.log($scope.weights);
    });
});

setInterval(4000,function(){


    weightsApp.controller('WeightListCtrl', function ($scope, $http) {
            $scope.weights = [
                                {
                                    'name': 'Bench Press',
                                    'reps': '5x5',
                                    'prevWeight': '150'
                                },
                                {
                                    'name': 'Bench Press',
                                    'reps': '5x5',
                                    'prevWeight': '150'
                                }
                            ]
    });

});

/* Attempt sending data via AJAX to MySQL db */
// function getWeights(data,i){
//    var ajaxOptions = {
//         type:'POST',
//         url:'/weights/php/getWeights.php',
//         data: '',
//         timeout : 30000,
//         success : function(response) {
//             // console.log(response);
//             assignControllers(response);
//             weightsApp.controller('WeightListCtrl', function ($scope) {
//                 $scope.weights = [1, 2, 3];
//             });
//         },
//         error:function() {
//             console.log('AJAX ERROR');
//         }
//    };
//    $.ajax(ajaxOptions);
// }
// getWeights();