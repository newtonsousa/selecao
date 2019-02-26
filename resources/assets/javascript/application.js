var application = angular.module('application', ['ngRoute', 'ngResource', 'ngAnimate', 'ngCookies', 'camera','ui.bootstrap', 'ui.mask', 'angular-loading-bar', 'flash']);

application.filter('num', function() {
    return function(input) {
      return parseInt(input, 10);
    };
});

application.filter('cpf', function(){
    return function(cpf){
        return cpf.substr(0, 3) + '.' + cpf.substr(3, 3) + '.' + cpf.substr(6, 3) + '-' + cpf.substr(9,2);
    };
});

application.filter('time', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'dd/M/yyyy HH:mm');
        return _date;
    };
});


application.filter('dia', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'dd/M/yyyy');
        return _date;
    };
});

application.filter('hora', function($filter){
    return function(input) {
        if(input == null){ 
            return ""; 
        } 
        var _date = $filter('date')(new Date(input), 'HH:mm');
        return _date;
    };
});


application.filter('tel', function () {
    return function (tel) {
        if (!tel) { return ''; }

        var value = tel.toString().trim().replace(/^\+/, '');

        if (value.match(/[^0-9]/)) {
            return tel;
        }

        var country, city, number;

        switch (value.length) {
            case 10: // +1PPP####### -> C (PPP) ###-####
                country = 1;
                city = value.slice(0, 2);
                number = value.slice(2);
                break;

            case 11: // +CPPP####### -> CCC (PP) ###-####
               country = 1;
                city = value.slice(0, 2);
                number = value.slice(2);
                break;

            case 12: // +CCCPP####### -> CCC (PP) ###-####
                country = value.slice(0, 2);
                city = value.slice(4, 4);
                number = value.slice(4);
                break;

            default:
                return tel;
        }

        if (country == 1) {
            country = "";
        }

        number = number.slice(0, 4) + '-' + number.slice(4);

        return (country + " (" + city + ") " + number).trim();
    };
});

