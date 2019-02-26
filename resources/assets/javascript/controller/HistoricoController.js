;(function (application) {
    'use strict';

    application.controller('HistoricoController', function($scope, $location, Visitante, Historico, UfFactory, DestinoFactory, HistoricoFactory, SetorFactory, FlashFactory, ModalFactory) {
  

        if($location.path() === '/visitante/edit') {
            $scope.historico = {};
            


            $scope.onSelectedPessoaDestinoChange = function() {
                $scope.SelectedPessoaDestino = $scope.historico.no_user; 
            }
            
            $scope.onSelectedSetorChange = function() {
                $scope.SelectedSetor = $scope.historico.no_acronym; 
            }

            $scope.create = function() {
                HistoricoFactory.save($scope.historico).$promise.then(function(response){
                    FlashFactory.trigger(response);
                }, function(response){
                    FlashFactory.trigger(response);
                });
            };
        }

        if($location.path() === '/visitante') {
            $scope.historicos = [];

            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });

            $scope.activate = function(historico) {
                var thereIsOneActivated = false;

                $scope.updateHistoricos = function() {
                    HistoricoFactory.query(function(data) {
                        $scope.historicos = data;
                    });
                };
            }
        }
    });

})(application);
