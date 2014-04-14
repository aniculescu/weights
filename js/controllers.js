var weightsControllers = angular.module('weightsControllers', []);
weightsControllers
    .controller('WeightListCtrl', function ($scope, $http, $filter) {
        var date = new Date();
        $scope.userId = 2;
        $scope.weight = 0;
        $scope.todaysDate = $filter('date')(date, "yyyy-MM-dd");

        $scope.showUserWeights = function(){
            var getString = '/weights/php/service.php?service=weightsList&user_id=' + $scope.userId;
            $http.get(getString, {cache: true}).success(function(data){
                $scope.exercises = data;
            });
        }
        $scope.showUserWeights();

        $scope.showGraph = function(userId, exerciseId){
            var getString = '/weights/php/service.php?service=weightHistory&user_id=' + userId + '&weight_id=' + exerciseId;
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

        $scope.addSingleExercise = function(userId, exerciseId, weight, date){
//            console.log("userId: " + userId);
//            console.log("exerciseId: " + exerciseId);
//            console.log("weight: " + weight);
//            console.log("date: " + date);
            var getString = '/weights/php/service.php?service=addWeight&user_id=' + userId + '&weight_id=' + exerciseId + '&weight=' + weight + '&date=' + date;
//            console.log(getString);
            $http.get(getString, {cache : false}).success(function(data){
//                console.log(data);
//                $scope.showUserWeights();
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