;(function (application) {
    'use strict';

    application.controller('RelatorioController', function($scope, $location, $filter, Visitante, RelatorioFactory) {
        
        $scope.relatorios = [];
        RelatorioFactory.query(function(data) {
            $scope.relatorios = data;              
        });
 
        $scope.pdf = function() {  
          
         
            RelatorioFactory.query(function(data) {
                $scope.relatorios = data.created_at;
                $scope.relatorios = data.dt_saida;
            });


            var dtIni = $scope.relatorios.created_at = $filter('date')($scope.relatorios.created_at, 'yyyy-MM-dd'); // hh:mm:ss
            var dtFim = $scope.relatorios.dt_saida = $filter('date')($scope.relatorios.dt_saida, 'yyyy-MM-dd'); 
            var dtPeriodo = dtIni+'/'+dtFim;
            
            if( dtIni == undefined && dtFim == undefined ){
                window.open('/api/relatorio/pdf', '_blank');
                //console.log('todos');
                //return false;
            }else 
            if( (dtIni != undefined) && (dtFim != undefined) ){
                window.open('/api/relatorio/pdf/'+dtIni+'/'+dtFim , '_blank' );
                //console.log('periodo'); return false;
            }else if( (dtIni !== null || dtIni !== undefined) && (dtFim === null || dtFim === undefined) ){
                //console.log('data entrada'); return false;
                window.open('/api/relatorio/pdf/'+dtIni );
            }else if( (dtIni === null || dtIni === undefined) && (dtFim !== null || dtFim !== undefined) ){
                //console.log('data saida'); return false;
                window.open('/api/relatorio/pdf/'+dtFim );
            }
            else{
                //window.open('/api/relatorio/pdf/'+todos); 
                //console.log('todos');
                return false;
            }
              //var teste = window.open('/api/relatorio/pdf/teste', '_blank');

        };
        

        $scope.dtInicio = {
            opened: false
        };

        $scope.dtFim = {
            opened: false
        };

        RelatorioFactory.query(function(data) {
            $scope.relatorios = data;
        });

        $scope.openInicio = function($event) {
            $scope.dtInicio.opened = true;
        };

        $scope.openFim = function($event) {
            $scope.dtFim.opened = true;
        };
               
    });

})(application);
