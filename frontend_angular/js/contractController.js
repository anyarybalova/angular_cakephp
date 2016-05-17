
function ContractCtrl($scope, $http, $stateParams, $modal, $state, $sce, Pagination){
	$scope.getContractList = function(){
		$scope.contracts = {};

		var url = $scope.url_back+"/contracts";
	        $http.get(url).success(function(respuesta){
	        $scope.contracts = respuesta;
	    });
    };

    $scope.getContractDetail = function(){
    	$scope.contract = {};
    	var url =  $scope.url_back+ "/contracts/view/"+$stateParams.id;
	        $http.get(url).success(function(respuesta){
            if(respuesta.Contract == undefined ){
                $state.go("index.contracts");
                }
	        $scope.contract = respuesta.Contract;
	        });
    };


    $scope.htmlSnippet = function(code) {
        return $sce.trustAsHtml(code);
    };


};
