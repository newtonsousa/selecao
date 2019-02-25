<div >
    <form class="form-horizontal" name="CreateVisitanteForm" id="CreateVisitanteForm" novalidate>
        <fieldset>
            <legend>Visitante</legend>
            <div class="form-group">        
                <label for="STR_NOME" class="col-lg-2 control-label">Nome</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_NOME" type="text" id="STR_NOME" ng-model="visitante.STR_NOME" maxlength="200"  ng-required="false"/>
                </div>
                
                <label for="INT_TELEFONE" class="col-lg-2 control-label">Telefone</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_TELEFONE" type="text" id="INT_TELEFONE" ng-model="visitante.INT_TELEFONE" ui-mask="(99) 99999-999?9"  />
                </div>
            </div>
            
            <div class="form-group">
                <label for="STR_ENDERECO" class="col-lg-2 control-label">Endereço</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_ENDERECO" type="text" id="STR_ENDERECO" ng-model="visitante.STR_ENDERECO" maxlength="200"  />
                </div>
                
                <label for="INT_CELULAR" class="col-lg-2 control-label">Celular</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_CELULAR" type="text" id="INT_CELULAR" ng-model="visitante.INT_CELULAR" ui-mask="(99) 99999-999?9"  />
                </div>
            </div>
            <div class="form-group">
                <label for="STR_EMPRESA_ORGAO" class="col-lg-2 control-label">Órgão</label>
                <div class="col-lg-4">
                    <input class="form-control" name="STR_EMPRESA_ORGAO" type="text" id="STR_EMPRESA_ORGAO" ng-model="visitante.STR_EMPRESA_ORGAO" />
                </div>               
            </div>  
                           
           <div class="form-group">
                <label for="STR_EMPRESA_ORGAO" class="col-lg-2 control-label">Tipo de documento</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_TIPO_DOCUMENTO" type="text" id="INT_TIPO_DOCUMENTO" ng-model="visitante.INT_TIPO_DOCUMENTO" maxlength="25"  />
                </div>
                
                <div ng-if="visitante.INT_TIPO_DOCUMENTO == '3' ">
                    <label for="INT_NUMERO_DOCUMENTO" class="col-lg-1 control-label">Número</label>
                    <div class="col-lg-2">
                        <input class="form-control" name="INT_NUMERO_DOCUMENTO" type="text" id="INT_NUMERO_DOCUMENTO" ng-model="visitante.INT_NUMERO_DOCUMENTO" cpf-validator ui-mask="999-999-999-99" maxlength="15" ng-required="false" />
                        <ul>
                            <li ng-message="cpfInvalid">mnsagem para cpf invalid error</li>
                            <li ng-message="cpfIncomplet">mnsagem para cpf incomplet error</li>
                        </ul>
                    </div>
                </div>
                
                <label for="INT_NUMERO_DOCUMENTO" class="col-lg-1 control-label">Número</label>
                <div class="col-lg-2">
                    <input class="form-control" name="INT_NUMERO_DOCUMENTO" type="number" id="INT_NUMERO_DOCUMENTO" ng-model="visitante.INT_NUMERO_DOCUMENTO" maxlength="15"  />
                </div>
               
                <label for="int_codigouf" class="col-lg-1 control-label">UF</label>
                <div class="col-lg-2">
                    <input class="form-control" name="int_codigouf" type="text" id="int_codigouf" ng-model="visitante.int_codigouf" maxlength="5"  />
                </div>             
            </div>                  
        </fieldset>      
    </form>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary" ng-disabled="CreateVisitanteForm.$invalid" ng-click="create()">Gravar Entrada</button>
            <a href="#/visitante" class="btn btn-default">Voltar</a>
        </div>
    </div>
      
</div>

