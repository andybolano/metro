app.controller("homeCtrl", ["$scope", "$http", function ($scope, $http) {
  
$scope.Documentos = {};
  

$scope.getDocumentos = function(){
     $http.get(uri+"/documentos/get").success(function (data) {
		$scope.Documentos = data;
        });
       
}



}]);


