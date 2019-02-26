;(function (application) {
    'use strict';

    application.controller('CrachaController', function($scope, $location, CrachaFactory, HistoricoFactory, FlashFactory) {

        $scope.crachas = [];
        CrachaFactory.query(function(data) {
            $scope.crachas = data;    
        });
          
        $scope.updateHistoricos = function() {
            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });
        };
            
        $scope.updateHistoricos();
        $scope.updateHistoricos = function() {
            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });
        };       
      
        $scope.updateHistoricos();           
        $scope.gravarSaida = function(cracha) {  
            
            var remoteHistorico = HistoricoFactory.get({id : cracha.id }, function(){
                remoteHistorico.$update().then(function(response){
                    $scope.updateHistoricos();  
                    FlashFactory.trigger(response);
                    parent.location.reload();
                });
            });                     
        };
       
    });

})(application);
