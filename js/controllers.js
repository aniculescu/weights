var weightsControllers = angular.module('weightsControllers', []);
weightsControllers
    .controller('WeightListCtrl', function ($scope, $http, $filter) {
        var date = new Date();
        $scope.userId = 2;
        $scope.weight = 0;
        $scope.todaysDay = $filter('date')(date, "dd");
        $scope.todaysYear = $filter('date')(date, "yyyy");
        $scope.todaysMonth = $filter('date')(date, "MM");
        $scope.todaysDate = $filter('date')(date, "yyyy-MM-dd");
        
        $scope.showUserWeights = function(){
            var getString = '../php/service.php?service=weightsList&user_id=' + $scope.userId;
            $http.get(getString, {cache: true}).success(function(data){
                $scope.exercises = data;
            });
        }
        $scope.showUserWeights();

        $scope.updateDate = function(){
            $scope.todaysDate = $scope.todaysYear + "-" + $scope.todaysMonth + "-" + $scope.todaysDay;
            console.log($scope.todaysDate);
        }

        $scope.showGraph = function(userId, exerciseId){
            var getString = '../php/service.php?service=weightHistory&user_id=' + userId + '&weight_id=' + exerciseId;
            $http.get(getString, {cache: true}).success(function(data){
                // Prepare data for chart.js
                var chartLabels = [],
                    chartData = [];
                data.forEach(function(entry){
                    //Fill the empty arrays
                    chartLabels.push(entry.date);
                    chartData.push(parseInt(entry.weight));
                });
                console.log(chartLabels);
                console.log(chartData);

                //Get the context of the canvas element we want to select
                $('body').addClass('show-chart');
                $('#chartContainer').highcharts({
                    chart: {
                        type: 'column',
                        inverted: false,
                        events: {
                            click: function(){
                                $('body').removeClass('show-chart');
                            }
                        }
                    },
                    legend: {enabled: false},
                    plotOptions: {
                        column: {
                            dataLabels: {enabled: true },
                            enableMouseTracking: false
                        }
                    },
                    title: {text: 'Weight'},
                    xAxis: {
                        categories: chartLabels
                    },
                    yAxis: {
                        title: {text: 'Pounds'},
                        tickInterval: 5
                    },
                    series: [{
                        name: userId,
                        data: chartData
                    }]
                });
            });
        }

        $scope.addSingleExercise = function(userId, exerciseId, weight, date){
            // Add exercise to db as soon as user chooses weight in dropdown
            var getString = '../php/service.php?service=addWeight&user_id=' + userId + '&weight_id=' + exerciseId + '&weight=' + weight + '&date=' + date;
            $http.get(getString, {cache : false}).success(function(data){});
        }
    });

var weightsFilters = angular.module('weightsFilters', []);
weightsFilters
    .filter('nospaces', function(){
        // Filter for stripping all spaces from strings
        return function(input){
            return input.replace(/ /g, "");
        }
    });