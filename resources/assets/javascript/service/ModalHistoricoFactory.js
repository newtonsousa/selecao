;(function (application) {
    'use strict';

    application.factory('ModalHistoricoFactory', function($modal) {

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
