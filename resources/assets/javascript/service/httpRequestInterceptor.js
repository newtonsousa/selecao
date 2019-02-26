;(function (application) {
    'use strict';

    application.factory('httpRequestInterceptor', function ($q, $location, $cookies, $rootScope, FlashFactory) {
        
        var responseError = function (rejection) {
            if(rejection.status === 401){
                $rootScope.logado = false;
                $cookies.remove('logado');
                FlashFactory.trigger({'type': 'Danger', 'message' : 'Por favor, efetue o login.'});
                $location.path('/');
            }
            return $q.reject(rejection);
         }
        var response = function (response) {
            
            if(angular.isDefined($cookies.get('logado'))) {
                $rootScope.logado = $cookies.get('logado');
            }
            return response;
         }
        
    return {
        responseError: responseError,
        response: response
     };
});

})(application);
