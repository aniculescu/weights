var weightServices = angular.module('weightServices', ['ngResource']);
 
weightServices.factory('Phone', ['$resource',
    function($resource){
        return $resource('phones/:phoneId.json', {}, {
        query: {method:'GET', params:{phoneId:'phones'}, isArray:true}
        });
    }]
);