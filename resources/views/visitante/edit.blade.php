<div>
    <form class="form-horizontal" name="EditVisitanteForm" id="EditVisitanteForm">
        <fieldset>
            <legend>Edição de Visitante</legend>
            <div class="form-group">
              
                <label for="STR_NOME" class="col-lg-2 control-label">Nome</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_NOME" type="text" id="STR_NOME" ng-model="visitante.STR_NOME"  />
                </div>
                
                <label for="INT_TELEFONE" class="col-lg-2 control-label">Telefone</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_TELEFONE" type="text" id="INT_TELEFONE" ng-model="visitante.INT_TELEFONE" ui-mask="(99) 9999-9999?9"  />
                </div>
            </div>
            
            <div class="form-group">
                <label for="STR_ENDERECO" class="col-lg-2 control-label">Endereço</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_ENDERECO" type="text" id="STR_ENDERECO" ng-model="visitante.STR_ENDERECO" maxlength="200"  />
                </div>
                
                <label for="INT_CELULAR" class="col-lg-2 control-label">Celular</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_CELULAR" type="text" id="INT_CELULAR" ng-model="visitante.INT_CELULAR" ui-mask="(99) 9999-9999?9"  />
                </div>
            </div>
            <div class="form-group">
                <label for="STR_EMPRESA_ORGAO" class="col-lg-2 control-label">Empresa/Órgão</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_EMPRESA_ORGAO" type="text" id="STR_EMPRESA_ORGAO" ng-model="visitante.STR_EMPRESA_ORGAO" />
                </div>
                
                <label for="INT_CRACHA" class="col-lg-2 control-label">Crachá</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_CRACHA" type="text" id="INT_CRACHA" ng-model="visitante.INT_CRACHA"  />
                </div>                
            </div>  
                           
           <div class="form-group">
                <label for="INT_TIPO_DOCUMENTO" class="col-lg-2 control-label">Tipo de documento</label>               
                <div class="col-lg-2">
                    <select
                        class="form-control"
                        name="INT_TIPO_DOCUMENTO"
                        id="INT_TIPO_DOCUMENTO"
                        ng-options="documento.INT_TIPO_DOCUMENTO as documento.STR_TIPO_DOCUMENTO for documento in tipoDocumentos"
                        ng-model="visitante.INT_TIPO_DOCUMENTO">
                    </select>
                </div>

                <div ng-if="visitante.INT_TIPO_DOCUMENTO == '3' ">
                    <label for="INT_NUMERO_DOCUMENTO" class="col-lg-1 control-label">Número</label>
                    <div class="col-lg-2">
                        <input class="form-control" name="INT_NUMERO_DOCUMENTO" type="text" id="INT_NUMERO_DOCUMENTO" ng-model="visitante.INT_NUMERO_DOCUMENTO" ui-mask="999-999-999-99" maxlength="15" ng-required="true" />
                    </div>
                </div>
                
               <div ng-if=" visitante.INT_TIPO_DOCUMENTO != '3' ">
                    <label for="INT_NUMERO_DOCUMENTO" class="col-lg-1 control-label">Número</label>
                    <div class="col-lg-2">
                        <input class="form-control" name="INT_NUMERO_DOCUMENTO" type="text" id="INT_NUMERO_DOCUMENTO" ng-model="visitante.INT_NUMERO_DOCUMENTO" maxlength="15" ng-required="true" />
                    </div>
                </div>
                
                <div ng-if="!(visitante.INT_TIPO_DOCUMENTO == '3' || visitante.INT_TIPO_DOCUMENTO == '6')">
                    <label for="int_codigouf" class="col-lg-1 control-label">UF</label>
                    <div class="col-lg-2">  
                        <select
                            class="form-control"
                            name="int_codigouf"
                            id="int_codigouf"
                            ng-options="uf.int_codigouf|num as uf.str_siglauf for uf in listUfs"
                            ng-model="visitante.int_codigouf">
                        </select>     
                    </div> 
                </div>    
            </div>                  
        </fieldset>
    </form>
        
    <br /><br />
    <!-- inicio da inclusao do historico -->
    <div ng-hide="myVar">
        <form class="form-horizontal" name="GravarHistVisitanteForm" id="GravarHistVisitanteForm">    
            <div>
                <fieldset>
                    <legend>Destino</legend>
                    <label for="STR_NOME" class="col-lg-1 control-label">Pessoa/Destino</label>
                    <div class="col-lg-2">                          
                        <select class="form-control" name="STR_NOME" id="STR_NOME" ng-required="false" ng-model="historico2" ng-change="onSelectedPessoaDestinoChange()" ng-options="pessoa as pessoa.no_user for pessoa in pessoaDestino | orderBy: 'no_user'" >
                        </select>
                    </div>
                    <label for="STR_SETOR" class="col-lg-1 control-label">Setor</label>
                    <div class="col-lg-2">                          
                        <select class="form-control" name="STR_SETOR" id="STR_SETOR" ng-required="false" ng-model="historico.STR_SETOR" ng-change="onSelectedSetorChange(option)">
                            <option ng-repeat="option in pessoaSetor" value="@{{option.no_acronym}}">@{{option.no_acronym}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="STR_EVENTO" class="col-lg-2 control-label">Evento</label>
                        <div class="col-lg-4">
                            <textarea rows="4" cols="50" id="STR_EVENTO" name="STR_EVENTO" ng-model="historico.STR_EVENTO">
                            </textarea> 
                        </div>
                    </div> 
                                
                </fieldset> 
            </div>   
        </form>
    </div>
    <!-- fim da inclusao do historico -->
    <!-- inicio edicao do historico -->    
    <div  ng-show="myVar"> 
        <form class="form-horizontal" name="AlterarHistVisitanteForm" id="AlterarHistVisitanteForm">   
            <div>
                <fieldset>
                    <div class="col-lg-2"> 
                        Pessoa/Destino <br /> @{{historico.STR_NOME}}
                    </div>
                    <!--<div class="col-lg-2">                                                  
                        <select
                            class="form-control"
                            name="STR_NOME"
                            id="STR_NOME"
                            ng-options="pessoa.no_user as pessoa.no_user for pessoa in pessoaDestino"
                            ng-model="historico.STR_NOME">
                        </select>
                    </div> -->
                    <!-- <label for="STR_SETOR" class="col-lg-1 control-label">Setor</label> --> 
                    <div class="col-lg-2">                          
                        <!--<select class="form-control" name="STR_SETOR" id="STR_SETOR" ng-required="false" ng-model="historico.STR_SETOR" ng-change="onSelectedSetorChange(option)">
                            <option ng-repeat="option in pessoaSetor" value="@{{option.no_acronym}}">@{{option.no_acronym}}</option>
                        </select> -->
                        Setor <br /> @{{historico.STR_SETOR}} 
                    </div>
                    <div class="form-group">
                        <label for="STR_EVENTO" class="col-lg-2 control-label">Evento</label>
                        <div class="col-lg-4">
                            <textarea rows="4" cols="50" id="STR_EVENTO" name="STR_EVENTO" ng-model="historico.STR_EVENTO">
                            </textarea>             
                        </div>
                    </div> 
                               
                </fieldset> 
            </div> 
            
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="button" class="btn btn-primary" ng-disabled="AlterarHistVisitanteForm.$invalid" ng-click="saveEditHistorico()">Alterar Histórico</button>
                </div>                
            </div>
        </form>       
         
        <hr />
    </div><br /><br /><br />
    <!-- fim da edicao do historico -->
     
    <div style="float:right; width: 70%; margin-bottom: 80px;">
        <img  src="@{{visitante.IMAGEM}}" height="160" width="200" alt="webcam">
        <input class="form-control" name="IMAGEM" type="hidden" id="IMAGEM" ng-model="vm.picture" value="@{{vm.picture}}"  /> 
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

    <h2>Histórico de Visitas</h2>
    <div id="GravaVisitanteHistForm" name="GravaVisitanteHistForm"> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group ">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" class="form-control" placeholder="Consultar Histórico" ng-model="searchHistorico" />
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped historico">
            <thead>
                <th>Nome</th>
                <th>Destino</th>
                <th>Dt entrada</th>
                <th>Dt saída</th>
                <th>Sala</th>
                <th>Andar</th>
                <th>Ramal</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <tr ng-repeat="historico in historicoVisitante | orderBy: 'STR_NOME' | filter:{STR_NOME : searchHistorico}">
                    <td><span tooltip="@{{historico.STR_NOME}}">@{{historico.STR_NOME}}</span></td>
                    <td>@{{historico.STR_SETOR}}</td>
                    <td>@{{historico.created_at | date:'dd/MM/yyyy hh:mm:ss'}}</td>
                    <td ng-if="historico.dt_saida">@{{historico.dt_saida | date:'dd/MM/yyyy hh:mm:ss' }}</td>
                    <td ng-if="!(historico.dt_saida)"></td>
                    <td>@{{historico.STR_ANDAR}}</td>
                    <td>@{{historico.STR_SALA}}</td>
                    <td>@{{historico.INT_FONE}}</td>
                    <td>
                        <ul class="list-inline actions">    
                            <li ng-if="(historico.dt_saida | date:'dd/MM/yyyy') == (historico.created_at | date:'dd/MM/yyyy') "><button title="Editar Histórico" type="submit" class="btn btn-xs" ng-disabled="" ng-click="showEdit(historico)"><i class="fa fa-pencil-square-o"></i></button></li>
                            <li ng-if="historico.dt_saida < historico.created_at " ><button title="Gravar Saída" class="btn btn-xs" ng-click="gravarSaida(historico)"><i class="fa fa-minus-square-o"></i></button></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br /><br /><br />

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary" ng-disabled="GravarHistVisitanteForm.$invalid" ng-click="createHistorico()">Gravar Entrada</button>
            <button type="submit" class="btn btn-primary" ng-disabled="EditVisitanteForm.$invalid" ng-click="atualizar()">Alterar</button> 
            <a href="#/visitante" class="btn btn-default">Voltar</a>
        </div>                
    </div>

</div>
