<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Sistema de Cadastro de Visitante do MI</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" collapse="navCollapsed">
        <ul class="nav navbar-nav">
            <li><a ng-href="/#/visitante"><i class="fa fa-user"></i> Visitantes</a></li>
            <li><a ng-href="/#/relatorio"><i class="fa fa-user"></i> Relatórios</a></li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>