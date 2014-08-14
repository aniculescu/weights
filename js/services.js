var weightsServices = angular.module('weightsServices', ['ngResource']);
 
weightsServices.factory('Weights', ['$resource',
    function($resource){
    	// console.log($resource);
        return $resource('../php/getWeights.php', {}, {
            query: {
            	method : 'GET',
            	params:{user_id : 2},
            	isArray:true
            }
        });
    }]
);
 
// weightsServices.factory('$http', ['$httpd',
//     function($http){
//     	console.log($http);
//         // return $resource('../php/getWeights.php', {}, {
//         //     query: {
//         //     	method : 'GET',
//         //     	params:{user_id : 2},
//         //     	isArray:true
//         //     }
//         // });
//     }]
// );


