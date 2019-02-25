;(function (application) {
    'use strict';

    application.factory('ModalHistoricoFactory', function($modal) {
//        var trigger = function(options) {
//            var modalInstance = $modal.open({
//                animation: true,
//                controller: 'ModalInstanceController',
//                templateUrl: '/visitante/edit-historico',
//                size: 'sm',
//                resolve : {
//                    options : function() {
//                        return options;
//                    }
//                }
//            });
//
//            return modalInstance;
//        };
//
//        return  {
//            trigger : trigger
//        }


$scope.show = function() {
        ModalService.showModal({
            templateUrl: '/visitante/edit-historico',
            controller: "ModalInstanceController"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                $scope.message = "You said " + result;
            });
        });
    };



    });

})(application);
