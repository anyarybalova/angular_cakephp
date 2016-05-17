
function ContractCtrl($scope, $http, $stateParams, $modal, $state, $sce, Pagination){
	$scope.getContractList = function(){
		$scope.contracts = {};
        var num_rows =  $scope.PAGER_CONTRACT_ROWS;
        $scope.paginationContract = Pagination.getNew(num_rows);

		var url = $scope.url_back+"/contracts/private_list/";
	        $http.get(url).success(function(respuesta){
	        $scope.contracts = respuesta;
            $scope.paginationContract.numPages = Math.ceil($scope.contracts.length/$scope.paginationContract.perPage);
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

    $scope.$on('deleteContract', function(event, obj) {    	
    	var url =  $scope.url_back + "/contracts/delete/"+obj.id;
	        $http.get(url).success(function(respuesta){
	    });
    });

    $scope.openModal = function (contract_id, contract_title) {
    	$scope.title = contract_title;
    	$scope.contract_id = contract_id;

        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_admin/views/contract/deleteContract.html',
            controller: ModalInstanceCtrl,
  			scope: $scope
        });
    };

    $scope.submitFormContract = function(){

		var Contract = {
				title : $scope.title,
				contents : $scope.contents,
				price : $scope.price,
				description : $scope.description
        };
        
        var data = {Contract:Contract};
		
		var url = $scope.url_back + "/contracts/add";
	        $http.post(url, data).success(function(response){
                if(response.success){
                    $state.go("index.contracts");
                }else{
                    $scope.form_errors = response.errors;
                    console.log($scope.form_errors);
                    return false;
                }
            });
        
    };

    $scope.htmlSnippet = function(code) {
        return $sce.trustAsHtml(code);
    };

    /*EDIT COINTRACT*/
    $scope.getContractEdit = function(){
        $scope.contract_id = $stateParams.contract_id;
        $scope.contract = {};
        var url =  $scope.url_back+ "/contracts/view/"+$stateParams.contract_id;
            $http.get(url).success(function(respuesta){
            var contract = respuesta.Contract;
            $scope.title        = contract.title;
            $scope.price        = contract.price;
            $scope.description  = contract.description;
            $scope.contents     = contract.contents; 
        });
    };


    $scope.submitEditContract = function($id){
        var Contract = {
                title : $scope.title,
                contents : $scope.contents,
                price : $scope.price,
                description : $scope.description
        };
        var data = {Contract:Contract};
        
        var url = $scope.url_back + "/contracts/edit/"+$id;
            $http.post(url, data).success(function(response){
                    if(response.success){
                        $state.go('index.contracts', { 'id': $id });
                }else{
                    $scope.form_errors = response.errors;
                    return false;
                }

        });
        
    };
    /*EDIT*/

};
