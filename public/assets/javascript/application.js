var application = angular.module('application', ['ngRoute', 'ngResource', 'ngAnimate', 'camera','ui.bootstrap', 'ui.mask', 'angular-loading-bar', 'flash']);

application.filter('num', function() {
    return function(input) {
      return parseInt(input, 10);
    };
});
;(function (application) {
    'use strict';

    application.config(function($routeProvider, $locationProvider) {
            $routeProvider
                .when('/visitante', {
                    templateUrl: 'visitante',
                })
                .when('/visitante/create', {
                    controller: 'VisitanteController',
                    templateUrl: 'visitante/create',
                })
                .when('/visitante/createExit', {
                    controller: 'VisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/visitante/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/historico/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/historicoVisitante/edit/:id', {
                    controller: 'EditVisitanteController',
                    templateUrl: 'visitante/edit',
                })
                .when('/relatorio/show', {
                    controller: 'RelatorioController',
                    templateUrl: 'relatorio/index',
                })   
                .when('/relatorio', {
                    templateUrl: 'relatorio',
                })
                .otherwise({
                    redirectTo: '/'
                });
            $locationProvider.hashPrefix('');
        }
    );
})(application);

;(function (application) {
    'use strict';

    application.factory('DestinoFactory', function($resource) {
        return $resource('/api/destino');
    });

})(application);

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

;(function (application) {
    'use strict';

    application.factory('HistoricoFactory', function($resource) {
        return $resource('/api/historico/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('HistoricoVisitanteFactory', function($resource) {
        return $resource('/api/historicoVisitante/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);
;(function (application) {
    'use strict';

    application.factory('LDAP', function($resource) {
        return $resource('/api/ldap');
    });

})(application);

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

;(function (application) {
    'use strict';

    application.factory('RelatorioFactory', function($resource) {
        return $resource('/api/relatorio');
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('SetorFactory', function($resource) {
        return $resource('/api/setor');
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('TipoDocumentoFactory', function($resource) {
        return $resource('/api/tipoDocumento');
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('UfFactory', function($resource) {
        return $resource('/api/uf');
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('Visitante', function($resource) {
        return $resource('/api/visitante/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);

;(function (application) {
    'use strict';

    application.controller('ApplicationController', function() {
    });

})(application);

;(function (application) {
    'use strict';

    application.controller('DestinoController', function($scope, $location, UfFactory, DestinoFactory, LDAP, FlashFactory, ModalFactory) {
        
 
    });

})(application);

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

;(function (application) {
    'use strict';

    application.controller('SetorController', function($scope, $location, UfFactory, SetorFactory, LDAP, FlashFactory, ModalFactory) {
        
 
    });

})(application);

;(function (application) {
    'use strict';

    application.controller('TipoDocumentoController', function($scope, $location, UfFactory, SetorFactory, LDAP, FlashFactory, ModalFactory) {
        
 
    });

})(application);

;(function (application) {
    'use strict';

    application.controller('UFController', function($scope, $location, UfFactory, LDAP, FlashFactory, ModalFactory) {
        
 
    });

})(application);

;(function (application) {
    'use strict';

    application.controller('VisitanteController', function($scope, $location, Visitante, UfFactory, DestinoFactory, SetorFactory, HistoricoFactory, HistoricoVisitanteFactory, TipoDocumentoFactory, FlashFactory, ModalFactory) {
  
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
                        
            $scope.pessoaDestino = [];
            DestinoFactory.query(function(data) { 
                    $scope.pessoaDestino = data;  
            });
                       
            $scope.pessoaSetor = [];
            SetorFactory.query(function(data) { 
                    $scope.pessoaSetor = data; 
                   // console.log($scope.pessoaSetor);
            });

            $scope.onSelectedUfsChange = function() {
                $scope.SelectedUfs = $scope.visitante.int_codigouf; 
            }
            
            $scope.onSelectedTpDocumentoChange = function() {
                $scope.SelectedTpDocumento = $scope.visitante.INT_TIPO_DOCUMENTO; 
            }
          
            $scope.historico = {};
            $scope.historico2 = {};
            

            $scope.onSelectedPessoaDestinoChange = function( ) {                   
                $scope.historico.STR_NOME = $scope.historico2.no_user;
                $scope.historico.INT_FONE = $scope.historico2.nu_phone;  
                $scope.historico.STR_SALA = $scope.historico2.sala;
                $scope.historico.STR_ANDAR = $scope.historico2.andar;   
            }           
            
            $scope.onSelectedSetorChange = function() {
                $scope.SelectedSetor = $scope.historico.no_acronym; 
            }
            
            $scope.vm.picture = {};
            $scope.getSnapshot = function(  ){
                $scope.visitante.IMAGEM = $scope.vm.picture;
            };
            
              
            $scope.create = function() {
                              
                $scope.visitante.IMAGEM = $scope.vm.picture;
                
                Visitante.save($scope.visitante).$promise.then(function(response){
                    
                    $scope.historico.INT_CODIGO = response.visitante.id;
                       
                   HistoricoFactory.save($scope.historico).$promise.then(function(response){
                    FlashFactory.trigger(response);
                    }, function(response){
                        FlashFactory.trigger(response);
                    });
                }, function(response){
                    FlashFactory.trigger(response);
                });
  
            };
                
            $scope.historicos = [];
            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });  
            
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

                $scope.updateVisitantes = function() {
                    Visitante.query(function(data) {
                        $scope.visitantes = data;
                    });
                };
            }
        }
        
        
    })
    
    .controller('EditVisitanteController', function($scope, $routeParams, UfFactory, DestinoFactory, SetorFactory, HistoricoFactory, HistoricoVisitanteFactory, TipoDocumentoFactory, Visitante, FlashFactory) {
            var idVisitante = $routeParams.id;

            $scope.historico = {};
            $scope.historico2 = {};   
            $scope.listUfs = [];     
            $scope.tipoDocumentos = [];   
            $scope.pessoaDestino = [];
            $scope.pessoaSetor = [];
            $scope.historicoVisitante = [];   
           
            UfFactory.query(function(ufs) {
                $scope.listUfs = ufs;
            });

            TipoDocumentoFactory.query(function(data) {
                $scope.tipoDocumentos = data;  
            });

            DestinoFactory.query(function(data) { 
                $scope.pessoaDestino = data;  
            });

            SetorFactory.query(function(data) { 
                $scope.pessoaSetor = data;  
            });  
           
            Visitante.get({id : idVisitante}, function(visitante) {
                $scope.visitante = visitante;
            });
            
           
            $scope.onSelectedUfsChange = function() {
                $scope.SelectedUfs = $scope.visitante.int_codigouf; 
            }
        
            
            $scope.onSelectedSetorChange = function() {
                $scope.SelectedSetor = $scope.historico.no_acronym; 
            }

            $scope.onSelectedTpDocumentoChange = function() {
                $scope.SelectedTpDocumento = $scope.visitante.INT_TIPO_DOCUMENTO; 
            }

        
            $scope.atualizar = function() {
  
                var toUpdate = {};
                if($scope.EditVisitanteForm.$dirty) {
                        var remoteVisitante = Visitante.get({}, {id : $scope.visitante.id});
                        angular.forEach(['STR_NOME', 'STR_ENDERECO', 'STR_EMPRESA_ORGAO', 'INT_TELEFONE', 'INT_CELULAR', 'INT_CRACHA', 'INT_TIPO_DOCUMENTO', 'INT_NUMERO_DOCUMENTO', 'int_codigouf' ], function(campo) {
                            if($scope.EditVisitanteForm[campo].$dirty) {
                                remoteVisitante[campo] = $scope.visitante[campo];
                            }
                        });
                        remoteVisitante.$update().then(function(response){
                            FlashFactory.trigger(response);
                        });
                }         
            };


            $scope.createHistorico = function() {
 
                $scope.historico.STR_NOME = $scope.historico2.no_user;
                $scope.historico.INT_FONE = $scope.historico2.nu_phone;  
                $scope.historico.STR_SALA = $scope.historico2.sala;
                $scope.historico.STR_ANDAR = $scope.historico2.andar;               
                $scope.historico.INT_CODIGO = idVisitante;
                
                //console.log($scope.historico);
                //return;
                               
                HistoricoFactory.save($scope.historico).$promise.then(function(response){
                    FlashFactory.trigger(response);
                }, function(response){
                    FlashFactory.trigger(response);
                });
                parent.location.reload();
            };
            
            
            
            $scope.historicos = [];
            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });
            
 
            // div para cadastrar novo historico
            $scope.showEdit = function(historico){   
                $scope.myVar = true;
                
                HistoricoFactory.get({id : historico.id}, function() {
                    $scope.historico = historico;      
                });  
                               
            };
            
            
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
            
            
            // div para editar o historico
            $scope.saveEditHistorico = function(){                    
                var remoteHistorico = HistoricoFactory.get({}, {id : $scope.historico.id});

                remoteHistorico.STR_EVENTO = $scope.historico.STR_EVENTO;
                remoteHistorico.$update().then(function(response){
                    $scope.atualizaHistorico();
                    FlashFactory.trigger(response);
                });                  
                parent.location.reload();
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
              
        .controller('CreateHistoricoController', function($scope, $routeParams, UfFactory, DestinoFactory,  SetorFactory, HistoricoFactory, HistoricoVisitanteFactory, TipoDocumentoFactory, Visitante, FlashFactory) {


        });
})(application);
