/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller("usuarioCtrl", ["$scope", "$http", function ($scope, $http) {
$scope.cerrarSesion = function(){
          sessionStorage.removeItem('session'); 
          window.location.href = "../../index.html";
}

$scope.probarSesion = function(){
          if(sessionStorage.getItem('session'))
          {
              
          }else{
          window.location.href = "../../index.html";
      }
}

}]);

