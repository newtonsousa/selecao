;(function (application) {
    'use strict';

    application.factory('CrachaFactory', function($resource) {
        return $resource('/api/cracha/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);
