;(function (application) {
    'use strict';

    application.controller('RelatorioController', function($scope, $location, RelatorioFactory) {
        
        $scope.relatorios = [];
        RelatorioFactory.query(function(data) {
            $scope.relatorios = data;              
        });
 
        $scope.pdf = function() {     
            window.open('/api/relatorio/pdf', '_blank');                               
        };
               
    });

})(application);
