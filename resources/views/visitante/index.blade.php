<br /><br />
<div id="contactform">
    <h3>Consultar</h3>
    <div ng-controller="VisitanteController"> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group ">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        <input type="text" class="form-control" placeholder="Consultar" ng-model="searchVisitante" />
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-success" ng-href="/#/visitante/create"></i> Cadastrar</a>
            </div>
        </div>

        <table class="table table-striped visitantes">
            <thead>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Celular</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <tr ng-repeat="visitante in visitantes | orderBy: 'str_nome' | filter:{str_nome : searchVisitante}">
                    <td><span tooltip="@{{visitante.str_nome}}">@{{visitante.str_nome}}</span></td>
                    <td>@{{visitante.int_tipo_documento}}</td>
                    <td>@{{visitante.int_telefone | tel}}</td>
                    <td>@{{visitante.int_celular | tel}}</td>
                    <td>
                        <ul class="list-inline actions">  
                            <li><button class="btn btn-xs" ng-click="edit(visitante)" title="Edit"><i class="fa fa-pencil-square-o"></i></button></li> 
                            <li><button class="btn btn-xs" ng-click="delete(visitante)" ng-model="visitante" title="Delete"><i class="fa fa-power-off"></i></button></li>                      
                        </ul>
                    </td>
                </tr>
            </tbody>       
        </table>

        <div></div>
    </div>
</div>

