
var uri = "../public/api";
var app = angular.module("usuario", ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
  .when('/slider', {
        templateUrl: "slider.html"
    })
    .when('/documentos', {
        templateUrl: "documentos.html"
    })
    $routeProvider.otherwise({
        redirectTo: '/slider'
    });
}]);




