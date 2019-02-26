;(function (application) {
    'use strict';

    application.factory('DestinoFactory', function($resource) {
        return $resource('/api/destino/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);
