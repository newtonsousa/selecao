;(function (application) {
    'use strict';

    application.factory('ModalFactory', function($modal) {
        var trigger = function(options) {
            var modalInstance = $modal.open({
                animation: true,
                controller: 'ModalInstanceController',
                templateUrl: '/layout/modal-with-confirmation',
                size: 'sm',
                resolve : {
                    options : function() {
                        return options;
                    }
                }
            });

            return modalInstance;
        };

        return  {
            trigger : trigger
        }
    });

})(application);
