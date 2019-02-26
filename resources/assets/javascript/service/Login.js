;(function (application) {
    'use strict';

 application.factory('Login', function($http, $location, $rootScope, $cookies, FlashFactory) {

        var login = function(credentials) {
            $http.post('/login', credentials).then(function(response) {
                if(response.data.type === 'success') {
                    $rootScope.autenticacao = response.data.permissoes;
                    $cookies.put('logado', true);
                    FlashFactory.trigger(response.data);
                    $location.path('/visitante');     
                } else {
                    FlashFactory.trigger(response.data);
                }
            });
        },
        logout = function() {
            return $http.get('/login/sair').then(function(response) {
                FlashFactory.trigger(response.data);
                delete $rootScope.autenticacao;
                $location.path('/');
            });
        },
        getAutorizacao  = function() {
            return $http.get('/login/autenticacao');
        };

        return {
            login: login,
            logout: logout,
            getAutorizacao : getAutorizacao
        };
    });


})(application);
