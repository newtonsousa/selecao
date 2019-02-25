<div ng-controller="HistoricoController">
    <form class="form-horizontal" name="CreateHistoricoForm" id="CreateHistoricoForm" novalidate>
               
        <fieldset>
            <legend>Destino</legend>
            <label for="STR_NOME" class="col-lg-1 control-label">Pessoa/Destino</label>
            <div class="col-lg-2">                          
                    <select class="form-control" name="STR_NOME" id="STR_NOME" ng-required="false" ng-model="historico.STR_NOME" ng-change="onSelectedPessoaDestinoChange(option)">
                            <option ng-repeat="option in pessoaDestino | orderBy: 'no_user'" value="@{{option.no_user}}">@{{option.no_user}}</option>      
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
            
            
            <h2>Histórico de Visitas</h2>
            <div ng-controller="VisitanteController"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group ">
                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                <input type="text" class="form-control" placeholder="Consultar Histórico" ng-model="searchVisitante" />
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped destino">
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
                        <tr ng-repeat="destino in destinos | orderBy: 'STR_NOME' | filter:{STR_NOME : searchVisitante}">
                            <td><span tooltip="@{{visitante.STR_NOME}}">@{{visitante.STR_NOME}}</span></td>
                            <td>@{{visitante.INT_TIPO_DOCUMENTO}}</td>
                            <td>@{{visitante.INT_NUMERO_DOCUMENTO}}</td>
                            <td>@{{visitante.INT_TELEFONE}}</td>
                            <td>@{{visitante.INT_CELULAR}}</td>
                            <td>@{{visitante.INT_CELULAR}}</td>
                            <td>@{{visitante.INT_CELULAR}}</td>
                            <td>
                                <ul class="list-inline actions">  
                                    <li><button class="btn btn-xs" ng-click="edit(visitante)" ng-href="/#/visitante/modal" ><i class="fa fa-pencil-square-o"></i></button></li>
                                    <li><button class="btn btn-xs" ng-click="delete(visitante)" ng-href="/#/visitante/create"><i class="fa fa-times-circle"></i></button></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div></div>
            </div>
                 
            <br /><br /><br /><br /><br />
            
            <!--
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary" ng-disabled="CreateVisitanteForm.$invalid" ng-click="create()">Gravar Entrada</button>
                    <!--<button type="submit" class="btn btn-primary" ng-disabled="CreateVisitanteForm.$invalid" ng-click="createExit()">Gravar Saída</button>
                    <button type="submit" class="btn btn-primary" ng-disabled="CreateVisitanteForm.$invalid" ng-click="edit()">Alterar</button> 
                    <a href="#/visitante" class="btn btn-default">Voltar</a>
                </div> 
            </div> 
            -->
            
        </fieldset>
    </form>
</div>

