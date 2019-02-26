;(function (application) {
    'use strict';

    application.factory('TipoDocumentoFactory', function($resource) {
        return $resource('/api/tipoDocumento');
    });

})(application);
