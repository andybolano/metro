app.controller("documentosCtrl", ["$scope", "$http", function ($scope, $http) {
  
$scope.documento = {};
$scope.Documentos = [],
$scope.save = function(){
 
    var formData = new FormData();
     formData.append('titulo', $scope.documento.titulo);
     formData.append('descripcion', $scope.documento.descripcion);
     formData.append('archivo',  $scope.documento.archivo);

     
    $http.post(uri+"/documentos/save",formData,{transformRequest: angular.identity, headers: {'Content-Type': undefined}})
                        .success(function (data) {
			toastr["success"](data.message)
                $scope.getAll();
                $scope.documento="";
        });
       
}

$scope.getAll = function(){
     $http.get(uri+"/documentos/get").success(function (data) {
		$scope.Documentos = data;
        });
       
}

$scope.eliminar = function(item){
    $http.delete(uri+"/documentos/"+item.id).success(function (data) {
                toastr["success"](data.message)
                $scope.getAll();
        });
}


    
}]);


