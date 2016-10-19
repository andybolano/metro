app.controller("loginCtrl", ["$scope", "$http", function ($scope, $http) {
$scope.data = {};

$scope.iniciar = function(){
$http.post(uri+'/autenticar',$scope.data).success(function(data) {
    if(data.message=='OK'){
           sessionStorage.setItem("session",data);  
           window.location.href = "view/usuario/index.html";
      }else{
        toastr["error"]("Datos incorrectos");   
      }
    }).error(function(data) {
        console.log(data)
    });
    }


}]);



