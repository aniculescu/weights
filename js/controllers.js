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
                    pointDotRadius : 3,
                    pointDotStrokeWidth : 1,
                    datasetStrokeWidth : 1,
                    bezierCurve : true,
                    scaleGridLineColor : "rgba(0,0,0,0.3)"
                };
                var weightsData = {
                    labels : chartLabels,
                    datasets : [
                        {
                            fillColor : "rgba(151,187,205,0.5)",
                            strokeColor : "rgba(151,187,205,1)",
                            pointColor : "rgba(151,187,205,1)",
                            pointStrokeColor : "#fff",
                            data : chartData
                        }
                    ]
                }
                var ctx = $("#weightsChart")[0].getContext("2d");
                // Force 100% width and height 
                ctx.canvas.width = $('#chartContainer').width() * 0.95;
                ctx.canvas.height = $('#chartContainer').height() * 0.95;
                var weightsChart = new Chart(ctx).Bar(weightsData, weightsOptions);
                $('body').addClass('show-chart');
            });
                
        }
        $('#chartContainer').click(function(){
            $('body').removeClass('show-chart');
        });
    })

var weightsFilters = angular.module('weightsFilters', []);
weightsFilters
    .filter('nospaces', function(){
        // Filter for stripping all spaces from strings
        return function(input){
            return input.replace(/ /g, "");
        }
    });