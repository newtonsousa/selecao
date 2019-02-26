;(function (application) {
    'use strict';

    application.factory('HistoricoVisitanteFactory', function($resource) {
        return $resource('/api/historicoVisitante/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);