<h2>Consultar Visitantes</h2>
<div ng-controller="VisitanteController"> 
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="input-group ">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" placeholder="Consultar Visitante" ng-model="searchVisitante" />
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a class="btn btn-primary" ng-href="/#/visitante/create"><i class="fa fa-plus-circle"></i> Cadastrar Visitante</a>
        </div>
    </div>

    <table class="table table-striped visitantes">
        <thead>
            <th>Nome</th>
            <th>Tipo Documento</th>
            <th>Número</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <tr ng-repeat="visitante in visitantes | orderBy: 'STR_NOME' | filter:{STR_NOME : searchVisitante}">
                <td><span tooltip="@{{visitante.STR_NOME}}">@{{visitante.STR_NOME}}</span></td>
                <td>@{{visitante.STR_TIPO_DOCUMENTO}}</td>
                <td>@{{visitante.INT_NUMERO_DOCUMENTO}}</td>
                <td>@{{visitante.INT_TELEFONE}}</td>
                <td>@{{visitante.INT_CELULAR}}</td>
                <td>
                    <ul class="list-inline actions">  
                        <li><button class="btn btn-xs" ng-click="edit(visitante)"><i class="fa fa-pencil-square-o"></i></button></li>                       
                    </ul>
                </td>
            </tr>
        </tbody>       
    </table>

    <div></div>
</div>

