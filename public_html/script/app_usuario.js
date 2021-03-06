
var uri = "../../../public/api";
var app;

(function(){
 app = angular.module("usuario", ['ngRoute','ui.keypress']);
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

 app.directive('ngEnter', function () {
        return function (scope, elements, attrs) {
            elements.bind('keydown keypress', function (event) {
                if (event.which === 13) {
                    scope.$apply(function () {
                        scope.$eval(attrs.ngEnter);
                    });
                    event.preventDefault();
                }
            });
        };
    });
    app.filter('ifEmpty', function() {
        return function(input, defaultValue) {
            if (angular.isUndefined(input) || input === null || input === '') {
                return defaultValue;
            }
            return input;
        };
    });
    app.directive('uploaderModel',['$parse',function($parse){
        return{
            restrict: 'A',
            link: function(scope,iElement,iAttrs){
                iElement.on('change',function(e)
                {
                    $parse(iAttrs.uploaderModel).assign(scope,iElement[0].files[0]);
                });
            }
        };
    }]);

})();




