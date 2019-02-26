;(function (application) {
    'use strict';

    application.controller('ModalInstanceController', function ($scope, $modalInstance, options) {
        $scope.title = options.title;
        $scope.question = options.question;

        $scope.confirmar = function () {
            $modalInstance.close();
        };

        $scope.cancelar = function () {
            $modalInstance.dismiss('cancel');
        };
    });
})(application);
