;(function (application) {
    'use strict';

    application.factory('FlashFactory', function($location, Flash) {
        var trigger = function(msgPackage) {
            Flash.create(msgPackage.type, msgPackage.message, 'customAlert');
            console.log(msgPackage);

            if(msgPackage.type === 'success') {
                var regex = /(\/.*?\/)/gi;
                $location.path($location.path().match(regex));
            }
        }

        return  {
            trigger : trigger
        }
    });

})(application);
