<div class="nav navbar-default navbar-nav navbar-right subBgBoard2"></div>
<div class="subBgBoardTextura"></div>
<div class="">
<br /><br />
<nav ng-if="logado" class="" role="navigation" style="margin: 1px 15px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Sistema de Cadastro</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" collapse="navCollapsed">
        <ul class="nav navbar-nav">
            <li ng-if="autenticacao.indexOf('visitantes') != -1"><a ng-href="/#/visitante"><i class="fa fa-user"></i> Visitantes</a></li>
            <li ng-if="autenticacao.indexOf('relatorios') != -1"><a ng-href="/#/relatorio"><i class="fa fa-user"></i> Relatórios</a></li>
            <li><a ng-href="/#/sair"><i class="fa fa-user"></i> Sair</a></li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
</div>