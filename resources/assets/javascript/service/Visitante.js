;(function (application) {
    'use strict';

    application.factory('Visitante', function($resource) {
        return $resource('/api/visitante/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);
