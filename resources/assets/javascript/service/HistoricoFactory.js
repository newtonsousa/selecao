;(function (application) {
    'use strict';

    application.factory('HistoricoFactory', function($resource) {
        return $resource('/api/historico/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);
