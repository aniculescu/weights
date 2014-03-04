var weightsControllers = angular.module('weightsControllers', []);
weightsControllers
    .controller('WeightListCtrl', function ($scope, $http) {
        $scope.userId = 2;
        $scope.showUserWeights = function(){
            var getString = '/weights/php/service.php?service=weightsList&user_id=' + $scope.userId;
            $http.get(getString, {cache: true}).success(function(data){
                $scope.weights = data;
            });
        }
        $scope.showUserWeights();

        $scope.showGraph = function(userId, weightId){
            var getString = '/weights/php/service.php?service=weightHistory&user_id=' + userId + '&weight_id=' + weightId;
            $http.get(getString, {cache: true}).success(function(data){
                // $('#chartContainer').show();
                // Prepare data for chart.js
                var chartLabels = [],
                    chartData = [];
                data.forEach(function(entry){
                    //Fill the empty arrays
                    chartLabels.push(entry.date);
                    chartData.push(entry.weight);
                });

                //Get the context of the canvas element we want to select
                var weightsOptions = {
                    pointDotRadius : 2,
                    pointDotStrokeWidth : 0.8,
                    datasetStrokeWidth : 1,
                    bezierCurve : true
                };
                var weightsData = {
                    labels : chartLabels,
                    datasets : [
                        {
                            fillColor : "rgba(220,220,220,0.5)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            data : chartData
                        }
                    ]
                }
                var ctx = $("#weightsChart")[0].getContext("2d");
                var weightsChart = new Chart(ctx).Line(weightsData, weightsOptions);
                $('#chartContainer').addClass('active');


            });
                
        }
        $('#chartContainer').click(function(){
            $(this).removeClass('active');
        });
    })
    .controller('WeightGraphCtrl', function ($scope, $http, $stateParams, $state) {
        var getString = '/weights/php/service.php?service=weightHistory&user_id=' + $stateParams.userId + '&weight_id=' + $stateParams.weightId;
        $http.get(getString, {cache: true}).success(function(data){
            // Prepare data for chart.js
            var chartLabels = [],
                chartData = [];
            data.forEach(function(entry){
                //Fill the empty arrays
                chartLabels.push(entry.date);
                chartData.push(entry.weight);
            });

            //Get the context of the canvas element we want to select
            var ctx = $("#weightsChart")[0].getContext("2d");
            var weightsOptions = {
                pointDotRadius : 2,
                pointDotStrokeWidth : 0.8,
                datasetStrokeWidth : 1,
                bezierCurve : true
            };
            var weightsData = {
                labels : chartLabels,
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,1)",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        data : chartData
                    }
                ]
            }
            var weightsChart = new Chart(ctx).Line(weightsData, weightsOptions);
        });
    });

var weightsFilters = angular.module('weightsFilters', []);
weightsFilters
    .filter('nospaces', function(){
        // Filter for stripping all spaces from strings
        return function(input){
            return input.replace(/ /g, "");
        }
    });