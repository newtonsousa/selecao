;(function (application) {
    'use strict';

    application.factory('LDAP', function($resource) {
        return $resource('/api/ldap');
    });

})(application);
