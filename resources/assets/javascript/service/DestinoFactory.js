;(function (application) {
    'use strict';

    application.factory('DestinoFactory', function($resource) {
        return $resource('/api/destino');
    });

})(application);
