var application = angular.module('application', ['ngRoute', 'ngResource', 'ngAnimate', 'camera','ui.bootstrap', 'ui.mask', 'angular-loading-bar', 'flash']);

application.filter('num', function() {
    return function(input) {
      return parseInt(input, 10);
    };
});