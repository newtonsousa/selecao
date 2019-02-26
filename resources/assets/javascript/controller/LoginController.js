;(function (application) {
    'use strict';

    application.controller('LoginController', function($scope, $cookies, $location, Login, FlashFactory) {
  
        $scope.credencial = {};
        $scope.login = function() {
            Login.login($scope.credencial);
        };
        
    }).controller('LogoffController', function($scope, $rootScope, $cookies, $location, Login) {
       
        $rootScope.logado = false;
        $cookies.remove('logado');
        Login.logout();

    })
    
    
})(application);
