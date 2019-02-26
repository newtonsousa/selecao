;(function (application) {
    'use strict';

    application.factory('RelatorioFactory', function($resource) {
        return $resource('/api/relatorio');
    });

})(application);
