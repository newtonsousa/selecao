;(function (application) {
    'use strict';

    application.factory('UfFactory', function($resource) {
        return $resource('/api/uf');
    });

})(application);
