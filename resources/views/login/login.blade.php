
<!DOCTYPE composition PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
</head>
<body><br /><br />

        <form class="form-horizontal" name="LoginForm" id="LoginForm">
            <div id="sign-in" class="borda">

                <div class="content">
                    <h2><strong>Acesso do Usuário</strong></h2>
                    <input id="email" name="email" type="text" value="{{ old('email') }}" ng-model="credencial.email"
                            class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all"
                            role="textbox" aria-disabled="false" aria-readonly="false"
                            aria-multiline="false" placeholder="Usuário">   
                    <input id="loginForm:password" name="password" type="password" ng-model="credencial.senha"
                            class="ui-inputfield ui-password ui-widget ui-state-default ui-corner-all"
                            role="textbox" aria-disabled="false" aria-readonly="false"
                            aria-multiline="false" placeholder="Senha">
                    <div class="wrapperBt">
                        <button id="loginForm:submit" name="submit" ng-disabled="LoginForm.$invalid" ng-click="login()"
                            class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-left"
                            type="submit" role="button" aria-disabled="false">
                            <span class="ui-button-icon-left ui-icon ui-c "></span>
                            <span class="ui-button-text ui-c">Entrar</span>
                        </button>    
                    </div>
                </div>
            </div>
            <div id="" style="width: -900px; height: 790px;"></div>
            <div id="bgFooterLogin">
                <div class="wrapper"> Versao 1.0.0</div>
            </div>
            
	</form>
</body>

</html>
