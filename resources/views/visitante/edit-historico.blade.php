<div>
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
                <div class="col-lg-2">
                    <input class="form-control" name="STR_TELEFONE" type="hidden" id="STR_TELEFONE" ng-model="historico2.nu_phone" maxlength="15"  />
                </div><br />  
            </fieldset> 
        </div>   
    </form>
       
    <div style="float:right; width: 70%; margin-bottom: 80px;">
        <img ng-if="visitante.IMAGEM" src="@{{visitante.IMAGEM}}" height="160" width="200" alt="webcam">
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
                    <td>@{{historico.dt_saida | date:'dd/MM/yyyy hh:mm:ss' }}</td>
                    <td></td>
                    <td></td>
                    <td>@{{historico.INT_FONE}}</td>
                    <td>
                        <ul class="list-inline actions">  
                            <li><button title="Editar Histórico" class="btn btn-xs" ng-click="editHistorico(visitante)"><i class="fa fa-pencil-square-o"></i></button></li>
                            <li><button title="Gravar Saída"     class="btn btn-xs" ng-click="gravarSaida(historico)"><i class="fa fa-minus-square-o"></i></button></li>
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
