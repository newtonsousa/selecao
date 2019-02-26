var application = angular.module('application', ['ngRoute', 'ngResource', 'ngAnimate', 'ngCookies', 'camera','ui.bootstrap', 'ui.mask', 'angular-loading-bar', 'flash']);

application.filter('num', function() {
    return function(input) {
      return parseInt(input, 10);
    };
});

application.filter('cpf', function(){
    return function(cpf){
        return cpf.substr(0, 3) + '.' + cpf.substr(3, 3) + '.' + cpf.substr(6, 3) + '-' + cpf.substr(9,2);
    };
});

application.filter('time', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'dd/M/yyyy HH:mm');
        return _date;
    };
});


application.filter('dia', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'dd/M/yyyy');
        return _date;
    };
});

application.filter('hora', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'HH:mm');
        return _date;
    };
});


application.filter('tel', function () {
    return function (tel) {
        if (!tel) { return ''; }

        var value = tel.toString().trim().replace(/^\+/, '');

        if (value.match(/[^0-9]/)) {
            return tel;
        }

        var country, city, number;

        switch (value.length) {
            case 10: // +1PPP####### -> C (PPP) ###-####
                country = 1;
                city = value.slice(0, 2);
                number = value.slice(2);
                break;

            case 11: // +CPPP####### -> CCC (PP) ###-####
               country = 1;
                city = value.slice(0, 2);
                number = value.slice(2);
                break;

            case 12: // +CCCPP####### -> CCC (PP) ###-####
                country = value.slice(0, 2);
                city = value.slice(4, 4);
                number = value.slice(4);
                break;

            default:
                return tel;
        }

        if (country == 1) {
            country = "";
        }

        number = number.slice(0, 4) + '-' + number.slice(4);

        return (country + " (" + city + ") " + number).trim();
    };
});


;(function (application) {
    'use strict';

    application.config(function($routeProvider, $locationProvider, $httpProvider) {
            $httpProvider.interceptors.push('httpRequestInterceptor');
        
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
                .when('/cracha', {
                    controller: 'CrachaController',
                    templateUrl: 'cracha/index',
                })
                .when('/sair', {
                    controller: 'LogoffController',
                    templateUrl: 'login',
                })
                .when('/relatorio', {
                    templateUrl: 'relatorio',
                })
                .when('/', {
                    controller: 'LoginController',
                    templateUrl: 'login',
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

    application.factory('CrachaFactory', function($resource) {
        return $resource('/api/cracha/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
    });

})(application);

;(function (application) {
    'use strict';

    application.factory('DestinoFactory', function($resource) {
        return $resource('/api/destino/:id', { id: '@id' }, {
            update: {
                method: 'PUT'
            }
        });
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
        return $resource('/api/ldap' , {},{
             logar: {
                method: 'POST'
            }
        });
        
    });

})(application);

;(function (application) {
    'use strict';

 application.factory('Login', function($http, $location, $rootScope, $cookies, FlashFactory) {

        var login = function(credentials) {
            $http.post('/login', credentials).then(function(response) {
                if(response.data.type === 'success') {
                    $rootScope.autenticacao = response.data.permissoes;
                    $cookies.put('logado', true);
                    FlashFactory.trigger(response.data);
                    $location.path('/visitante');     
                } else {
                    FlashFactory.trigger(response.data);
                }
            });
        },
        logout = function() {
            return $http.get('/login/sair').then(function(response) {
                FlashFactory.trigger(response.data);
                delete $rootScope.autenticacao;
                $location.path('/');
            });
        },
        getAutorizacao  = function() {
            return $http.get('/login/autenticacao');
        };

        return {
            login: login,
            logout: logout,
            getAutorizacao : getAutorizacao
        };
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

    application.factory('httpRequestInterceptor', function ($q, $location, $cookies, $rootScope, FlashFactory) {
        
        var responseError = function (rejection) {
            if(rejection.status === 401){
                $rootScope.logado = false;
                $cookies.remove('logado');
                FlashFactory.trigger({'type': 'Danger', 'message' : 'Por favor, efetue o login.'});
                $location.path('/');
            }
            return $q.reject(rejection);
         }
        var response = function (response) {
            
            if(angular.isDefined($cookies.get('logado'))) {
                $rootScope.logado = $cookies.get('logado');
            }
            return response;
         }
        
    return {
        responseError: responseError,
        response: response
     };
});

})(application);

;(function (application) {
    'use strict';

    application.controller('ApplicationController', function() {
    });

})(application);

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

    application.controller('LoginController', function($scope, $cookies, $location, Login, FlashFactory) {
  
        $scope.credencial = {};
        $scope.login = function() {
            Login.login($scope.credencial);
        };
        
    }).controller('LogoffController', function($scope, $rootScope, $cookies, $location, Login) {
       
        $rootScope.logado = false;
        $cookies.remove('logado');
        Login.logout();

    })
    
    
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
                $scope.historico.co_user = $scope.historico2.co_user;
                $scope.historico.STR_UNIDADE = $scope.historico2.no_acronym;     
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
                    $location.path('/visitante/edit/' + $scope.historico.INT_CODIGO);
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

                $scope.updateVisitante = function() {
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
            $scope.historicoEdit = {};
            $scope.historicoCreate = {};
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
                        remoteVisitante['INT_NUMERO_DOCUMENTO'] = $scope.visitante['INT_NUMERO_DOCUMENTO'];
                        remoteVisitante['int_codigouf'] = $scope.visitante['int_codigouf'];
                        angular.forEach(['STR_NOME', 'STR_ENDERECO', 'STR_EMPRESA_ORGAO', 'INT_TELEFONE', 'INT_CELULAR', 'INT_TIPO_DOCUMENTO' ], function(campo) {
                            if($scope.EditVisitanteForm[campo].$dirty ) {
                                remoteVisitante[campo] = $scope.visitante[campo];
                            }
                        });
                        
                        remoteVisitante.$update().then(function(response){
                            FlashFactory.trigger(response);
                        });
                }         
            };


            $scope.onSelectedPessoaDestinoCreateChange = function( ) {                   
                $scope.historico.STR_NOME = $scope.historicoCreate.no_user;
                $scope.historico.INT_FONE = $scope.historicoCreate.nu_phone;  
                $scope.historico.STR_SALA = $scope.historicoCreate.sala;
                $scope.historico.STR_ANDAR = $scope.historicoCreate.andar; 
                $scope.historico.co_user = $scope.historicoCreate.co_user;
                $scope.historico.STR_UNIDADE = $scope.historicoCreate.no_acronym;     
            } 


            $scope.createHistorico = function() {
                
            $scope.atualizaHistorico = function() {
                HistoricoVisitanteFactory.query({id : idVisitante},function(data) {
                    $scope.historicoVisitante = data;
                });
            };

            if( $scope.historicoVisitante[0].INT_CRACHA != null ){
                $scope.historico.INT_CRACHA = $scope.historicoVisitante[0].INT_CRACHA;
            }else{
                $scope.historico.INT_CRACHA = $scope.historicoVisitante[1].INT_CRACHA;
            }

   
                $scope.historico.STR_NOME = $scope.historico2.no_user;
                $scope.historico.INT_FONE = $scope.historico2.nu_phone;  
                $scope.historico.STR_SALA = $scope.historico2.sala;
                $scope.historico.STR_ANDAR = $scope.historico2.andar; 
                $scope.historico.co_user = $scope.historico2.co_user;
                $scope.historico.STR_UNIDADE = $scope.historico2.no_acronym;
                $scope.historico.STR_SETOR = $scope.historico.STR_SETOR; 
                $scope.historico.STR_EVENTO = $scope.historico.STR_EVENTO;
                
                $scope.historico.INT_CODIGO = idVisitante;
                               
                var nome = $scope.historico.STR_NOME;
                var setor = $scope.historico.STR_SETOR;
                var evento = $scope.historico.STR_EVENTO;
                
               if( (nome == null) && (setor == null) && (evento == null) ){
                   //FlashFactory.trigger(response);
                   alert('Por favor preencher um dos campos do Destino.');
                   return false;
                   parent.location.reload();
               }
               else if( nome != null && setor != null ){
                   alert('Por favor preencher apenas um dos campos do Destino.');
                   return false; 
                   parent.location.reload();
               }
               else if( setor != null && evento != null ){
                   alert('Por favor preencher apenas um dos campos do Destino.');
                   return false;
                   parent.location.reload();
               }
               else if( nome != null && evento != null ){
                   alert('Por favor preencher apenas um dos campos do Destino.');
                   parent.location.reload();
                   return false;
                   $location.path('/visitante/edit/' + $scope.historico.INT_CODIGO);         
               }
               else{
                   HistoricoFactory.save($scope.historico).$promise.then(function(response){
                        FlashFactory.trigger(response);
                        parent.location.reload();
                    }, function(response){
                        FlashFactory.trigger(response);
                        $scope.atualizaHistorico();
                        parent.location.reload();
                        $location.path('/visitante/edit/' + $scope.historico.INT_CODIGO);
                    });
                    $scope.atualizaHistorico();                   
               }
     
            };
              
            $scope.historicos = [];
            HistoricoFactory.query(function(data) {
                $scope.historicos = data;
            });
            
 
            // div para editar novo historico
            $scope.showEdit = function(historico){
                $scope.myVar = true;
                
                HistoricoFactory.get({id : historico.id}, function(retornoHistorico) {
                    $scope.historico = retornoHistorico;
                    if(retornoHistorico.co_user != null) {
                        DestinoFactory.get({id : retornoHistorico.co_user}, function(retornoDestino) {
                           retornoDestino.co_user = ""+retornoDestino.co_user+"";

                           $scope.historicoEdit = retornoDestino;
                        });
                    }
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
