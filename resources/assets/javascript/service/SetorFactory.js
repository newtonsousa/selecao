;(function (application) {
    'use strict';

    application.factory('SetorFactory', function($resource) {
        return $resource('/api/setor');
    });

})(application);
