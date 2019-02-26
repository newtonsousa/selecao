;(function (application) {
    'use strict';

    application.config(function($routeProvider, $locationProvider, $httpProvider) {
            $httpProvider.interceptors.push('httpRequestInterceptor');
        
            $routeProvider
                .when('/visitante', {
                    templateUrl: 'visitante',
                })
                .when('/visitante/create', {
                    controller: 'VisitanteController',
                    templateUrl: 'visitante/create',
                })
                .when('/visitante/createExit', {
                    controller: 'VisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/visitante/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/historico/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/historicoVisitante/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/relatorio/show', {
                    controller: 'RelatorioController',
                    templateUrl: 'relatorio/index',
                })  
                .when('/cracha', {
                    controller: 'CrachaController',
                    templateUrl: 'cracha/index',
                })
                .when('/sair', {
                    controller: 'LogoffController',
                    templateUrl: 'login',
                })
                .when('/relatorio', {
                    templateUrl: 'relatorio',
                })
                .when('/', {
                    controller: 'LoginController',
                    templateUrl: 'login',
                })
                .otherwise({
                    redirectTo: '/'
                });
            $locationProvider.hashPrefix('');
        }
    );
})(application);
