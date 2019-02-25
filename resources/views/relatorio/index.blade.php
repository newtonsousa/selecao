<h2>Relatório</h2>

<div ng-controller="RelatorioController"> 
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group ">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" placeholder="Data inicial" ng-model="searchDtIni" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group ">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" placeholder="Data final" ng-model="searchRelatorio" />
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" type="button" class="btn btn-primary"  ng-click="pdf()"> Gerar PDF</button> 
        </div>   
    </div>

    <table class="table table-striped relatorio">
        <thead>
            <th>Nome Visitante</th>
            <th>Tipo Documento</th>
            <th>Número</th>
            <th>Local</th>
            <th>Telefone</th>            
            <th>Celular</th>
            <th>Endereço</th>
            <th>Empresa</th>
            <th>Destino</th>
            <th>Andar</th>
            <th>Sala</th>
            <th>Dt entrada</th>
            <th>Dt saída</th>
        </thead>
        <tbody>
            <tr ng-repeat="relatorio in relatorios | orderBy: 'STR_NOME' | filter:{ created_at : searchDtIni, dt_saida : searchRelatorio}">
                <td><span tooltip="@{{relatorio.STR_NOME}}">@{{relatorio.STR_NOME}}</span></td>
                <td>@{{relatorio.STR_TIPO_DOCUMENTO}}</td>
                <td>@{{relatorio.INT_NUMERO_DOCUMENTO}}</td>  
                <td>@{{relatorio.int_codigouf}}</td>
                <td>@{{relatorio.INT_TELEFONE}}</td>
                <td>@{{relatorio.INT_CELULAR}}</td>
                <td>@{{relatorio.STR_ENDERECO}}</td>
                <td>@{{relatorio.STR_EMPRESA_ORGAO}}</td>
                <td>@{{relatorio.str_nome}} - @{{relatorio.STR_SETOR}}</td>
                <td>@{{relatorio.str_andar}}</td>
                <td>@{{relatorio.str_sala}}</td>
                <td>@{{relatorio.created_at | date:'dd/MM/yyyy hh:mm:ss'}}</td>
                <td ng-if="relatorio.dt_saida != '0' ">@{{relatorio.dt_saida | date:'dd/MM/yyyy hh:mm:ss'}}</td>               
            </tr>
        </tbody>       
    </table>
</div>

