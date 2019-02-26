;(function (application) {
    'use strict';

    application.controller('VisitanteController', function($scope, $location, Visitante, FlashFactory, ModalFactory) {
  
        if($location.path() === '/visitante/create') {
            $scope.visitante = {};
            
            $scope.vm = this;
            $scope.vm.picture = false; // Initial state
          
            $scope.tipoDocumentos = [];
            TipoDocumentoFactory.query(function(data) {
                $scope.tipoDocumentos = data;  
            });

            $scope.listUfs = [];
            UfFactory.query(function(data) {
                $scope.listUfs = data;  
            });
                        
//            $scope.pessoaDestino = [];
//            DestinoFactory.query(function(data) { 
//                    $scope.pessoaDestino = data;  
//            });
//                       
//            $scope.pessoaSetor = [];
//            SetorFactory.query(function(data) { 
//                    $scope.pessoaSetor = data; 
//            });
//
//            $scope.onSelectedUfsChange = function() {
//                $scope.SelectedUfs = $scope.visitante.int_codigouf; 
//            }
//            
//            $scope.onSelectedTpDocumentoChange = function() {
//                $scope.SelectedTpDocumento = $scope.visitante.INT_TIPO_DOCUMENTO; 
//            }
//          
//            $scope.historico = {};
//            $scope.historico2 = {};
            

//            $scope.onSelectedPessoaDestinoChange = function( ) {                   
//                $scope.historico.STR_NOME = $scope.historico2.no_user;
//                $scope.historico.INT_FONE = $scope.historico2.nu_phone;  
//                $scope.historico.STR_SALA = $scope.historico2.sala;
//                $scope.historico.STR_ANDAR = $scope.historico2.andar;               
//                $scope.historico.co_user = $scope.historico2.co_user;
//                $scope.historico.STR_UNIDADE = $scope.historico2.no_acronym;     
//            }           
//            
//            $scope.onSelectedSetorChange = function() {
//                $scope.SelectedSetor = $scope.historico.no_acronym; 
//            }
//            
//            $scope.vm.picture = {};
//            $scope.getSnapshot = function(  ){
//                $scope.visitante.IMAGEM = $scope.vm.picture;
//            };
            
              
            $scope.create = function() {
                              
                //$scope.visitante.IMAGEM = $scope.vm.picture;
                
                Visitante.save($scope.visitante).$promise.then(function(response){
                    
//                   $scope.historico.INT_CODIGO = response.visitante.id;
//                   HistoricoFactory.save($scope.historico).$promise.then(function(response){
                    
                    FlashFactory.trigger(response);
                    $location.path('/visitante/edit/' + response.visitante.id);
                    }, function(response){
                        FlashFactory.trigger(response);
                    });
                        
                }, function(response){
                    FlashFactory.trigger(response);
                });
  
            };
                
//            $scope.historicos = [];
//            HistoricoFactory.query(function(data) {
//                $scope.historicos = data;
//            });  
            
        }
        
        
        $scope.edit = function(visitante) {
            $location.path('/visitante/edit/' + visitante.id);
        };
        
        $scope.editHistorico = function(historico) {
            $location.path('/visitante/edit/' + historico.id);
        };
               
        
        if($location.path() === '/visitante') {
            $scope.visitantes = [];

            Visitante.query(function(data) {
                $scope.visitantes = data;
            });

            $scope.activate = function(visitante) {
                var thereIsOneActivated = false;

                $scope.updateVisitante = function() {
                    Visitante.query(function(data) {
                        $scope.visitantes = data;
                    });
                };
            }
        }
        
        
    })
    
    .controller('EditVisitanteController', function($scope, $routeParams, Visitante, FlashFactory) {
    	$destino = VisitanteModel::find($request->input('id'));

        foreach ($request->input() as $key => $value) {
            if($key !== 'id') {
                $destino->$key = $value;
            }
        }

        $visitante->save();

        dd($visitante);

    };
              
    
            // div para editar o historico
            $scope.onSelectedPessoaDestinoEditChange = function() {
                  
                DestinoFactory.get({id : $scope.historicoEdit.co_user}, function(retornoDestino) {
                   retornoDestino.co_user = ""+retornoDestino.co_user+"";

                    $scope.historico.STR_NOME = retornoDestino.no_user;
                    $scope.historico.INT_FONE = retornoDestino.nu_phone;  
                    $scope.historico.STR_SALA = retornoDestino.sala;
                    $scope.historico.STR_ANDAR = retornoDestino.andar;
                    $scope.historico.co_user = $scope.historicoEdit.co_user;
                    $scope.historico.STR_UNIDADE = retornoDestino.no_acronym; 
                });
                   
            } 
            
            $scope.pessoaDestino = [];
            DestinoFactory.query(function(data) { 
                    $scope.pessoaDestinoEdit = data;  
            });
            
            $scope.saveEditHistorico = function(){      

                var remoteHistorico = HistoricoFactory.get({}, {id : $scope.historico.id});

                remoteHistorico.STR_NOME = $scope.historico.STR_NOME;
                remoteHistorico.INT_FONE = $scope.historico.INT_FONE; 
                remoteHistorico.STR_ANDAR = $scope.historico.STR_ANDAR;
                remoteHistorico.STR_SALA = $scope.historico.STR_SALA;
                remoteHistorico.STR_SETOR = $scope.historico.STR_SETOR;
                remoteHistorico.STR_EVENTO = $scope.historico.STR_EVENTO;               
                remoteHistorico.co_user = $scope.historico.co_user;
                remoteHistorico.STR_UNIDADE = $scope.historico.STR_UNIDADE;
                remoteHistorico.INT_CRACHA = $scope.historico.INT_CRACHA;

                remoteHistorico.$update().then(function(response){
                    $scope.atualizaHistorico();
                    FlashFactory.trigger(response);
                });                  

                $scope.atualizaHistorico();
                $scope.myVar = false;
            };
            
            $scope.updateHistoricos();           
            $scope.gravarSaida = function(historico) {                                 
                var remoteHistorico = HistoricoFactory.get({id : historico.id }, function(){
                    remoteHistorico.$update().then(function(response){
                        $scope.updateHistoricos();  
                        $scope.atualizaHistorico();
                        FlashFactory.trigger(response);
                    });
                });                     
            };
            
         
            $scope.atualizaHistorico = function() {
                HistoricoVisitanteFactory.query({id : idVisitante},function(data) {
                    $scope.historicoVisitante = data;
                });
            };
            $scope.atualizaHistorico();
        })
              
        
})(application);
