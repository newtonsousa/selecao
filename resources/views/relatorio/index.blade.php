<br /><br />
<div id="contactform" style="width:1400px;" class="containerDois">
    <h3><strong>RELATÓRIO</strong></h3><hr>
    <form class="form-horizontal" name="RelatorioForm" id="RelatorioForm">
        <div ng-controller="RelatorioController"> 
            <div class="row">
                <div class="form-group col-lg-3">
                    <label for="created_at" class="control-label">Data de entrada</label>
                    <div class="input-group">
                        <input type="text" name="created_at" id="created_at" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="relatorios.created_at" is-open="dtInicio.opened" ng-required="false" show-button-bar="false" show-weeks="false" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="openInicio($event, 'created_at')"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div> 
                <div class="form-group col-lg-3">
                    <label for="dt_saida" class="control-label">Data de saída</label>
                    <div class="input-group">
                        <input type="text" name="dt_saida" id="dt_saida" class="form-control" datepicker-popup="dd/MM/yyyy" ng-model="relatorios.dt_saida" is-open="dtFim.opened" ng-required="false" min-date="filtro_auditoria.dt_saida" show-button-bar="false" show-weeks="false" />
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="openFim($event)"><i class="fa fa-calendar"></i></button>   
                        </span>
                        &nbsp;&nbsp;&nbsp;
<!--                         <span class="input-group-btn"> -->
<!--                             <button class="btn btn-success" type="submit" class="btn btn-primary" ng-model="relatorios"  ng-click="pdf()"> Gerar PDF</button>  -->
<!--                         </span> -->
                    </div>
                </div>       
            </div>
            <table class="table table-striped relatorio">
                <thead>
                    <th>Nome</th>
                    <th>Telefone</th>            
                    <th>Celular</th>
                    <th>Endereço</th>
                </thead>
                <tbody>
                    <tr ng-repeat="relatorio in relatorios | orderBy: 'str_nome' | filter:{ created_at : searchDtIni, dt_saida : searchDtFim}">
                        <td><span tooltip="@{{relatorio.str_nome}}">@{{relatorio.str_nome}}</span></td>                         
                        <td>@{{relatorio.int_telefone | tel}}</td>
                        <td>@{{relatorio.int_celular | tel}}</td>
                        <td>@{{relatorio.str_endereco}}</td>
                        </td>
                    </tr>
                </tbody>       
            </table>
        </div>
    </form>
</div>

