<!doctype html>
<html class="no-js" lang="application" ng-app="application">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">  
    <link type="text/css" rel="stylesheet" href="../assets/img/login/theme.css.seam">
    <link type="text/css" rel="stylesheet" href="../assets/img/login/primefaces.css.seam">
    <link type="text/css" rel="stylesheet" href="../assets/img/login/watermark.css.seam">
    <script type="text/javascript" src="../assets/img/login/primefaces.js.seam"></script>
    <link href="../assets/img/login/login.css" rel="stylesheet" type="text/css"> 
    
    
    <title>Sistema de Cadastro</title>
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
