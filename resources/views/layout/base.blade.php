<!doctype html>
<html class="no-js" lang="application" ng-app="application">
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CadVisitante - Sistema de Cadastro de Visitante do Ministério da Integração Nacional
</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/stylesheet/vendor.css">
    <link rel="stylesheet" href="/assets/stylesheet/application.css">
    <base href="/">
</head>
<body>
    @include('layout.header')
    <div flash-message="5000"></div>
    <div class="container" ng-view>
    </div>

    <script src="/assets/javascript/vendor.js"></script>
    <script src="/assets/javascript/application.js"></script>
</body>
</html>
