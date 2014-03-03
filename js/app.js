var weightsApp = angular
    .module('weightsApp', [
        'weightsControllers',
        'weightsFilters',
        'ui.router'
    ]).config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider){
        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'templates/home.php'
            })
            .state('chart', {
                url: '/chart/user/:userId/weight/:weightId',
                templateUrl: 'templates/chart.php'
            })
    }]);