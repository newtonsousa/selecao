<br /><br />
<div id="contactform">
    <h3>Consultar crachá</h3>
    <div ng-controller="CrachaController"> 
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group ">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" class="form-control" placeholder="Consultar crachá" ng-model="searchCracha" />
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped crachas">
            <thead>
                <th>Nome Visitante</th>
                <th>Crachá</th>
                <th>Data entrada</th>
                <th>Data saída</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <tr ng-repeat="cracha in crachas | orderBy: 'STR_NOME' | filter:{INT_CRACHA : searchCracha}">
                    <td>@{{cracha.STR_NOME}}</span></td>
                    <td>@{{cracha.INT_CRACHA}}</td>
                    <td>@{{cracha.created_at | time}}</td>
                    <td >
                        <div ng-if="!(cracha.dtsaida == '0000-00-00 00:00:00')">
                            @{{cracha.dt_saida | time}} 
                        </div>
                        <div ng-if="(cracha.dtsaida == '0000-00-00 00:00:00')">    
                        </div>
                    </td>
                    <td>
                        <div ng-if="(cracha.dtsaida == '0000-00-00 00:00:00')">
                            <ul class="list-inline actions">  
                                <li><button title="Dar baixa no crachá" class="btn btn-xs" ng-click="gravarSaida(cracha)" ><i class="fa fa-minus-square-o"></i></button></li>                   
                            </ul>
                        </div>  
                    </td>
                </tr>
            </tbody>       
        </table>

        <div></div>
    </div>
</div>

