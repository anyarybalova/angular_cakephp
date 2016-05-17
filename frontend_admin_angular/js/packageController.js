function PackageCtrl($scope, $http, $stateParams, $modal, $state, Pagination){
	
	$scope.getPackageList = function(){
        var num_rows =  $scope.PAGER_PACKAGE_ROWS;
        $scope.paginationPackage = Pagination.getNew(num_rows);


		$scope.packages = {};
		var url =  $scope.url_back +"/packages/private_index";
	        $http.get(url).success(function(respuesta){
	        $scope.packages = respuesta;
            $scope.paginationPackage.numPages = Math.ceil($scope.packages.length/$scope.paginationPackage.perPage);
	    });
    };

    $scope.getPackageDetail = function(){
    	$scope.pack = {};
    	var url =  $scope.url_back + "/packages/private_view/"+$stateParams.package_id;
	        $http.get(url).success(function(respuesta){
                if(respuesta.Package == undefined ){
                    $state.go("index.packages");
                }
	        $scope.pack = respuesta;
	    });
    };

    $scope.$on('deletePackage', function(event, obj) {    	
    	var url =  $scope.url_back + "/packages/delete/"+obj.id;
	        $http.get(url).success(function(respuesta){
	    });
    });

    $scope.openModalDelete = function (package_id, package_name) {
    	$scope.name = package_name;
    	$scope.package_id = package_id;

        var modalInstance = $modal.open({
            templateUrl: '/lexstart/lexstart_admin/views/package/deletePackage.html',
            controller: ModalInstanceCtrl,
  			scope: $scope
        });
    };


    $scope.submitFormPackage = function(){
        var Package = {
                name : $scope.name,
                price : $scope.price,
                description : $scope.description
        };
        var data = {Package:Package, listContracts:$scope.listContracts };
        
        var url =  $scope.url_back + "/packages/add";

        $http.post(url, data).success(function(response){
             if(response.success){
                $state.go("index.packages");
            }else{
                $scope.form_errors = response.errors;
                return false;
            }       
        });
    }

    $scope.removeContractFromPack = function($package_id, $contract_id){
        var url =  $scope.url_back+"/packages/"+$package_id+"/delete/"+$contract_id;
            $http.get(url).success(function(respuesta){
        });
    };

    $scope.addContractToPack = function($package_id, $contract_id){
        var url =  $scope.url_back+"/packages/"+$package_id+"/add/"+$contract_id;
            $http.get(url).success(function(respuesta){
        });
    };

    /*EDIT PACKAGE*/
    $scope.getPackageEdit = function(){
        $scope.pack = {};
        $scope.package_id = $stateParams.package_id;
        var url =  $scope.url_back + "/packages/view/"+$stateParams.package_id;
            $http.get(url).success(function(respuesta){
                if(respuesta.Package == undefined ){
                    $state.go("index.packages");
                }
            var pack = respuesta.Package;
            var contracts = respuesta.ContractsPackage;
            $scope.name         = pack.name;
            $scope.description  = pack.description;
            $scope.price        = pack.price;
            var ids = [];
            angular.forEach(contracts, function(contract, index) {
                    ids.push(contract.contract_id);
            });
            $scope.ids = ids;
        });
    };

    $scope.submitPackageEdit = function(package_id){
        var Package = {
                name : $scope.name,
                price : $scope.price,
                description : $scope.description
        };
        var data = {Package:Package};
        
        var url =  $scope.url_back + "/packages/edit/"+package_id;

        $http.post(url, data).success(function(response){
             if(response.success){
                $state.go("index.packages");
            }else{
                $scope.form_errors = response.errors;
                return false;
            }  
        });
    }

};