
var uri = "../public/api";
var app = angular.module("app", ['ngRoute']);
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
  .when('/home', {
        templateUrl: "view/home.html"
    })
    .when('/login', {
        templateUrl: "view/login.html"
    })
    $routeProvider.otherwise({
        redirectTo: '/home'
    });
}]);




