;(function (application) {
    'use strict';

    application.run(function($rootScope, $location, $cookies, Autenticacao) {
        $rootScope.$on('$locationChangeStart', function (evento, proxima, atual) {
            $rootScope.autenticacao = $cookies.getObject('autenticacao');

            if( ! $cookies.getObject('autenticacao')) {
                $location.path('login');
            }
        });
    });

})(application);
